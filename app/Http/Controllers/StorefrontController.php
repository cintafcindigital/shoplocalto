<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserChangePassword;
use App\Mail\EnquiryReply;
use App\Page;
use App\Vendor;
use App\VendorImage;
use App\VendorCompany;
use App\VendorRating;
use Carbon\Carbon;
use DB;
use App\ContactEnquiryReply;
use App\VendorLocation;
use App\VendorFaq;
use App\VendorPromotion;
use App\VendorDeal;
use App\VendorVideo;
use App\VendorSocialMedia;
use App\VendorTeammember;
use App\VendorEvent;
use View;
use Auth;

class StorefrontController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $deals_count;
    public $photos_count;
    public $videos_count;
  
    public function __construct()
    {
           
       
           
           $id=request()->segment(2);
           $this->deals_count=VendorDeal::join('deal_types','deal_types.id','=','vendor_deals.deal_type_id')
                                          ->select('vendor_deals.id','vendor_deals.name as deal_name','vendor_deals.photo','vendor_deals.status','deal_types.name as type','vendor_deals.expiry_date as end_date')
                                          ->where('vendor_id',$id)->count();
            $this->photos_count = VendorImage::where(['status'=>1,'vendor_id'=>$id])->orderBy('is_logo','asc')->count();
            $this->videos_count=VendorVideo::where('vendor_id',$id)->orderBy('sort_order','asc')->count();

          
             View::share ( 'deals_count', $this->deals_count);
             View::share ( 'photos_count', $this->photos_count);
             View::share ( 'videos_count', $this->videos_count);

    }

      /**
     * View the STOREFRONT page.
     *
     * @return \Illuminate\Http\Response
     */

     public function index($id) {
        $data['meta_data'] = (object)array('meta_title' =>'Wedding Blossoms','meta_keyword'=>'Wedding Blossoms, Wedding Flowers Wedding Blossoms, Wedding Vendors Wedding Blossoms, weddings Wedding Blossoms, wedding Wedding Blossoms, Wedding Flowers Toronto, Wedding Flowers Ontario, weddings Toronto','meta_description'=>'Wedding Blossoms (Wedding Flowers Toronto). Located in Toronto, Ontario, Wedding Blossoms is a company that specializes in creating superior floral designs for perfectwedding' );

       
        //$data['meta_data'] = \App\Page::where('id', 10)->first();
        
        $data['vendor'] = Vendor::with(['image_data','promotion_data','videos','deals','location'=>function($q){

          $q->first();

        }])->where('vendor_id',$id)->first();

       
        $data['vendor_map']=DB::table('vendor_locations')
                              ->join('cities','cities.id','=','vendor_locations.city_id')
                              ->join('states','states.id','=','cities.state_id')
                              ->join('countries','countries.id','=','states.country_id')
                              ->select('vendor_locations.*','cities.name as city','states.name as state','countries.id as country_id','countries.name as country')
                              ->where('vendor_locations.vendor_id',$id)->get();
          
        $vendor_faqs   = VendorFaq::where('vendor_id',$id)->orderBy('question_id','ASC')->get();

        $faq_ans_arr=array();
        foreach ($vendor_faqs as $faq) {


          if($faq->question_id==1){


            $faq_ans_arr['fd_arr'][]=DB::table('faq_floral_designs')->where('status','1')->whereIn('id',explode(",",$faq->answer))->orderBy('sort_order','asc')->get();


          }

          if($faq->question_id==2){

            //$faq_ans_arr['fs_arr'][]=explode(",", $faq->answer);
            $faq_ans_arr['fs_arr'][]=DB::table('faq_floral_services')->select(DB::raw('group_concat(name) as name'))->where('status','1')->whereIn('id',explode(",",$faq->answer))->orderBy('sort_order','asc')->get();
          }

          if($faq->question_id==3){

            //$faq_ans_arr['ta_arr'][]=explode(",", $faq->answer);
            $faq_ans_arr['ta_arr'][]=DB::table('faq_type_arrangements')->select(DB::raw('group_concat(name) as name'))->where('status','1')->whereIn('id',explode(",",$faq->answer))->orderBy('sort_order','asc')->get();
          }

          if($faq->question_id==10){

            //$faq_ans_arr['cost_fd_arr'][]=explode(",", $faq->answer);
            $faq_ans_arr['cost_fd_arr'][]=DB::table('faq_floral_services')->where('status','1')->whereIn('id',explode(",",$faq->answer))->orderBy('sort_order','asc')->get();
          }

          if($faq->question_id==4){

             $faq_ans_arr['price_bridal'][]=number_format(str_replace("$","",$faq->answer),2);
          }

          if($faq->question_id==5){

            $faq_ans_arr['price_bridesmaid'][]=number_format(str_replace("$","",$faq->answer),2);
          }

          if($faq->question_id==6){

            $faq_ans_arr['price_boutonniere'][]=number_format(str_replace("$","",$faq->answer),2);
          }
          if($faq->question_id==7){

            $faq_ans_arr['price_low_tbl'][]=number_format(str_replace("$","",$faq->answer),2);
          }
          if($faq->question_id==8){

            $faq_ans_arr['price_elevated_tbl'][]=number_format(str_replace("$","",$faq->answer),2);
          }
          if($faq->question_id==9){

            $faq_ans_arr['price_customer_expect'][]=number_format(str_replace("$","",$faq->answer),2);
          }
          
        
        }
              
        return view('vendor.vendor_storefront_view', ['data'=>$data,'faq_ans_arr'=>$faq_ans_arr]);
     }


    

    

}
