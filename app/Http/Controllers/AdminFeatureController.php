<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use View;
use DB;
use File;
use App\Feature;

class AdminFeatureController extends Controller
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
    public function features()
    {
        $features=Feature::get();
        return view('admin/features',compact('features'));
    }
    public function savefeatures(Request $request,$id=null)
    {
        if($id)
        {
           $this->validate($request, [
            'name'   => 'required',
            'displayorder' => 'required|integer',
            

           ]);
       }
       else
       {
        $this->validate($request, [
            'name'   => 'required',
            'displayorder' => 'required|integer',
            'icon'=>'required',
            'mobileicon'=>'required',

           ]);
       }
       if($id)
       {
        $features=Feature::findOrFail($id);
        $message="Updated";
        $message1="Updation";
       } 
       else
       {
        $features=new Feature();
        $message="Added";
        $message1="Insertion";
       }
     
     $features->name=$request->name;
     $features->display_order=$request->displayorder;
     
     if(!empty($request->input('icon')) && strlen($request->input('icon')) > 6) {
            $featuredImage = $request->input('icon');

            if(preg_match('/data:image/', $featuredImage)) {
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time() . '_icon_'.mt_rand(1000,9999) . '.png';
                $path = public_path() . '\features';
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path.'/'.$image_name, $featuredImage);
            
            }
            if($features->icon)
             {
                @unlink('features/'.$features->icon);
             }
             $features->icon=$image_name;
             
        }
        if(!empty($request->input('mobileicon')) && strlen($request->input('mobileicon')) > 6) {
            $featuredImage = $request->input('mobileicon');

            if(preg_match('/data:image/', $featuredImage)) {
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time() . '_mobileicon_'.mt_rand(1000,9999) . '.png';
                $path = public_path() . '\features';
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path.'/'.$image_name, $featuredImage);
            
            }
            if($features->mobile_icon)
             {
                @unlink('features/'.$features->mobile_icon);
             }
             $features->mobile_icon=$image_name;
             
        }
   
     
     try{
         $features->save();
         return redirect('admin/add-features')->with('success',"Feature $message successfully !!");
     }
     catch(\Exception $e)
     {
        return redirect()->back()->with('error',"Error in $message1");
     }
    
     


    }
    public function editfeature($id)
    {
        $featuresedit=Feature::where('id',$id)->first();
        $features=Feature::get();
        
        return view('admin/features',compact('features','featuresedit'));
    }
    public function deletefeature($id)
    {
        $features=Feature::findOrFail($id);
        if($features->icon)
        @unlink('features/'.$features->icon);
        if($features->mobileicon)
        @unlink('features/'.$features->mobileicon);
    try{
        $features->delete();
         return redirect('admin/add-features')->with('success','Feature Deleted successfully');
     }
     catch(\Exception $e)
     {
        return redirect()->back()->with('error',"Error in Deletion");
     }
        
        

    }
    

}