<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use View;
use DB;
use File;
use App\District;
use App\Community;

class AdminLocationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // die(Hash::make("ashiq123"));
        $this->middleware('auth:admin');
        
    }
    public function districts()
    {
        $districts=District::get();
        return view('admin/locations/districts',compact('districts'));
    }
    public function communities()
    {
        $communities=Community::select('locations.id','locations.name','districts.name AS district','locations.image')->join('districts','districts.id','locations.district_id')->get();
        return view('admin/locations/communities',compact('communities'));
    }
    public function add_community()
    {
        $districts=District::get();
        return view('admin/locations/add-community',compact('districts'));
    }
    public function save_community(Request $request,$id=null)
    {
       $this->validate($request, [
            'name'   => 'required',
            'description' => 'required',
            
            'district'=>'required',
            'latitude'=>'required',
            'longitude'=>'required'

        ]);
       if($id)
       {
        $locations=Community::findOrFail($id);
        $message="Updated";
        $message1="Updation";
       } 
       else
       {
        $locations=new Community();
        $message="Added";
        $message1="Insertion";
       }
     
     $locations->name=$request->name;
     $locations->slug=str_slug($request->name, '-');
     $locations->description=$request->description;
     $locations->district_id=$request->district;
     $locations->display_home=$request->is_home;
     
     if(!empty($request->input('image')) && strlen($request->input('image')) > 6) {
            $featuredImage = $request->input('image');

            if(preg_match('/data:image/', $featuredImage)) {
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time() . '_location_'.mt_rand(1000,9999) . '.png';
                $path = public_path() . '\locations';
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path.'/'.$image_name, $featuredImage);
            
            }
            if($locations->image)
             {
                unlink('locations/'.$locations->image);
             }
             $locations->image=$image_name;
             
        }
   
     $locations->latitude=$request->latitude;
     $locations->longitude=$request->longitude;
     try
     {
     $locations->save();
     return redirect('admin/communities')->with('success',"Community $message successfully !!");
     }
     catch(\Exception $e)
     {
     return redirect('admin/communities')->with('error',"Error in $message1 !!");
     }


    }
    public function edit_community($id)
    {
        $districts=District::get();
        $communities=Community::where('id',$id)->first();
        
        return view('admin/locations/add-community',compact('districts','communities'));
    }
    public function delete_community($id)
    {
        $locations=Community::findOrFail($id);
        @unlink('locations/'.$locations->image);
        $locations->delete();
        return redirect('admin/communities')->with('success','Community Deleted successfully');

    }
    

}