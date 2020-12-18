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
use App\Menu;
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
        

        Session::forget('_vendor_registration_step');
        Session::forget('_vendor_id');
        Session::forget('_vendor_username');
        Session::forget('_vendor_password');
        
        return view('frontend/home',compact('locations','vendors','testimonials'));
    }
    public function locationshops($slug)
    {
      
      return view('frontend/shoplisting',compact('slug'));
    }
}