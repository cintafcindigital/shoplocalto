<?php
 namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Mail;
// use View;
// use DB;
// use File;
// use App\District;
// use App\Community;

class AdminLocationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     // die(Hash::make("ashiq123"));
    //     $this->middleware('auth:admin');
        
    // }
    public function index()
    {
        print_r("hgjghj");
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
            'picture'=>'required',
            'district'=>'required'
        ]);
       if($id)
        $locations=Community::findOrFail($id);
       else
        $locations=new Community();
     $locations->name=$request->name;
     $locations->description=$request->description;
     $locations->district_id=$request->district;
     if(!empty($request->input('picture')) && strlen($request->input('picture')) > 6) {
            $featuredImage = $request->input('picture');
            if(preg_match('/data:image/', $featuredImage)) {
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time() . '_featured_'.mt_rand(1000,9999) . '.png';
                $path = public_path() . '/locations';
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path.'/'.$image_name, $featuredImage);
                $vendorObj->featured_image = $image_name;
            }
             $locations->picture=$image_name;
             if($locations->picture)
             {
                unlink('locations/'.$locations->picture);
             }
        }
    
     $locations->latitude=$request->latitude;
     $locations->longitude=$request->longitude;
     $locations->is_active=$request->is_active;
     $locations->save();
     redirect('admin/districts')->with('status'=>"Successfully location added");

    }
    public function deletecommunity($id)
    {
        $locations=Community::findOrFail($id);
        unlink('locations/'.$locations->image);
        $location->delete();
        redirect('admin/districts')->with('status'=>"Location Deleted successfully");

    }
    
    

}