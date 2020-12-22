<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use View;
use DB;
use File;
use App\Community;
use App\Testimonial;
use App\Vendor;
use App\VendorFeature;

use App\VendorCompany;
use App\Menu;
use App\Banner;
use App\Category;
use App\Tag;
use Session;
class FrontendController extends Controller
{
    protected function home()
    {
        $data = array();
        $datetimeSave = date('Y-m-d H:i:s');
        $sessionId = session()->getId();
        $visiterCount = DB::select("SELECT COUNT(*) AS cnt FROM site_visitor WHERE session_id = '$sessionId' AND DATE_FORMAT(created_at,'%Y-%m-%d') = DATE_FORMAT(STR_TO_DATE('$datetimeSave','%Y-%m-%d %H:%i:%s'),'%Y-%m-%d')")[0]->cnt;
        if($visiterCount <= 0)
            DB::table('site_visitor')->insert(['session_id' => $sessionId,'created_at' => $datetimeSave,'updated_at' => $datetimeSave]);
        
        $locations=Community::where('display_home',1)->get();
        $vendors=Vendor::join('vendor_companies','vendor_companies.vendor_id','=','vendors.vendor_id')->get();
        $testimonials=Testimonial::get();
        $banners=Banner::first();
        $categories=Category::where('show_home','=','1')->get();
        $allcat=Category::where('status','=','1')->get();
        $alllocations=Community::get();


        Session::forget('_vendor_registration_step');
        Session::forget('_vendor_id');
        Session::forget('_vendor_username');
        Session::forget('_vendor_password');
        
        return view('frontend/home',compact('locations','vendors','testimonials','banners','categories','allcat','alllocations'));
    }
    public function locationshops($slug)
    {
      $location=Community::where('slug',$slug)->first();
      $loc=$location->name;
      $shops=Vendor::join('vendor_companies','vendor_companies.vendor_id','=','vendors.vendor_id')->where('vendor_companies.location','like','%'.$slug.'%')->get();
      return view('frontend/shoplisting',compact('shops','loc'));
    }
    public function singleshop($id)
    {
      $shop=Vendor::join('vendor_companies','vendor_companies.vendor_id','=','vendors.vendor_id')->where('vendors.vendor_id',$id)->first();
      $tags=Tag::where('vendor_id',$id)->get();
      $features=VendorFeature::where('vendor_id',$id)->get();
      // print_r($features);
      // die;
      return view('frontend/singleshop',compact('shop','tags'));
    }
}