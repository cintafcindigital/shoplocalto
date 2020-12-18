<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use View;
use DB;
use File;
use App\Banner;

class AdminBannerController extends Controller
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
    public function banner()
    {
        $banners=Banner::get();
        return view('admin/banners',compact('banners'));
    }
    public function savebanner(Request $request,$id=null)
    {
        if($id)
        {
           $this->validate($request, [
            'name'   => 'required',
            'title'=>'required',
            'description'=>'required'
           ]);
       }
       else
       {
        $this->validate($request, [
            'name'   => 'required',
            'image' => 'required',
            'title'=>'required',
            'description'=>'required'
           ]);
       }
       if($id)
       {
        $banners=Banner::findOrFail($id);
        $message="Updated";
        $message1="Updation";
       } 
       else
       {
        $banners=new Banner();
        $message="Added";
        $message1="Insertion";
       }
     
     $banners->name=$request->name;
     $banners->title=$request->title;
     $banners->description=$request->description;
     
     if(!empty($request->input('image')) && strlen($request->input('image')) > 6) {
            $featuredImage = $request->input('image');

            if(preg_match('/data:image/', $featuredImage)) {
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time() . '_banner_'.mt_rand(1000,9999) . '.png';
                $path = public_path() . '\banners';
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path.'/'.$image_name, $featuredImage);
            
            }
            if($banners->image)
             {
                @unlink('banners/'.$banners->image);
             }
             $banners->image=$image_name;
             
        }
        
   
     
     try{
        $banners->save();
        return redirect('admin/add-banner')->with('success',"Banner $message successfully !!");
     }
     catch(\Exception $e)
     {
        return redirect('admin/add-banner')->with('error',"Error in $message1 !!");
     }
     


    }
    public function editbanner($id)
    {
        $bannersedit=Banner::where('id',$id)->first();
        $banners=Banner::get();
        
        return view('admin/banners',compact('banners','bannersedit'));
    }
    public function deletebanner($id)
    {
        $banners=Banner::findOrFail($id);
        @unlink('banners/'.$banners->image);
        try
        {
        $banners->delete();
        return redirect('admin/add-banner')->with('success','Banner Deleted successfully');
        }
        catch(\Exception $e)
        {
        return redirect('admin/add-banner')->with('error','Error in deletion');
        }
        
        

    }
    

}