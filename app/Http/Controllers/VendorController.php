<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use App\Mail\UserChangePassword;
use App\Mail\EnquiryReply;
use App\Mail\VendorMakeChangesMail;
use App\Mail\WelcomeMailToVendor;
use App\Mail\ConditionsOfContractMail;
use App\Page;
use App\UserNewsletter;
use App\Vendor;
use App\VendorImage;
use App\VendorCompany;
use App\VendorRating;
use Carbon\Carbon;
use DB;
use File;
use App\ContactEnquiryReply;
use App\VendorLocation;
use App\VendorFaq;
use App\VendorPromotion;
use App\ReviewRequest;
use App\VendorDeal;
use App\VendorVideo;
use App\VendorSocialMedia;
use App\VendorTeammember;
use App\VendorEvent;
use App\DealTypes;
use App\BusinessInfo;
use App\VendorCategoryRelation;
use App\BusinessSocialMedia;
use App\BusinessHours;
use App\SocialMedia;
use App\Category;
use View;
use Auth;
use Illuminate\Contracts\Auth\Guard;
class VendorController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public $vendor_img;
    public $deals;
    public $photos;
    public $videos;
    public $events;
    public $vendor_id;
    public $vendor_progress_percentage;
    public $vendor_progress_basic;
    public $vendor_progress_images;
    public $vendor_progress_tenHDimages;
    public $vendor_progress_videos;
    public $vendor_progress_deals;
    public $vendor_progress_faqs;
    public $vendor_progress_reviewAsk;
    public $vendor_progress_address;
    public function __construct(Guard $auth)
    {
        $this->middleware('auth:vendor');
        $this->middleware(function (Request $request, $next) {
            $this->vendor_id = Auth::id(); // you can access user id here
            $vendorTeamMembers = VendorTeammember::where(['vendor_id'=>$this->vendor_id ] )->count();
            View::share ( 'vendorTeamMembers', $vendorTeamMembers);
            $this->vendor_progress_percentage = 10;
            $this->vendor_img = Vendor::with(['image_data'=>function($q) { $q->where([/*'is_logo'=>1,*/'status'=>1]); }])->where('vendors.vendor_id',$this->vendor_id)->first();
           $this->deals=VendorDeal::join('deal_types','deal_types.id','=','vendor_deals.deal_type_id')
                                          ->select('vendor_deals.id','vendor_deals.name as deal_name','vendor_deals.photo','vendor_deals.status','deal_types.name as type','vendor_deals.expiry_date as end_date')
                                          ->where('vendor_id',$this->vendor_id)->count();
            $this->photos = VendorImage::where(['status'=>1,'vendor_id'=>$this->vendor_id])->orderBy('is_logo','asc')->count();
            $this->videos=VendorVideo::where('vendor_id',$this->vendor_id)->orderBy('sort_order','asc')->count();
            $this->events=VendorEvent::join('event_types','event_types.id','=','vendor_events.event_type_id')->select('vendor_events.*','event_types.name as event_type')->where('vendor_id',$this->vendor_id)->count();
            $query=Vendor::with(['company_data'])->where('vendors.vendor_id',$this->vendor_id);
            $category_data = $query->with(['category_data'=>function($q) {
                                $q->select('categories.id','categories.slug','cat.slug as parent_slug','cat.title as parent_title','categories.title','categories.parent_id','categories.meta_title','categories.meta_keyword','categories.meta_description')
                                ->join('categories AS cat', 'cat.id', '=', 'categories.parent_id');
                            }])
                        ->first();
            ////// Vendor Progressive Bar Start from here...
            $vendor_faqs = VendorFaq::where('vendor_id',$this->vendor_id)->count();
            $vendor_reviewAsk = ReviewRequest::where('vendor_id',$this->vendor_id)->count();
            //// for vendor first pop-up....
            if($this->vendor_img->first_popup == 0) {
                $firstPopup = Vendor::find($this->vendor_id);
                $firstPopup->first_popup = '1';
                try {
                    Mail::to($firstPopup->email)->send(new WelcomeMailToVendor($firstPopup->username));
                    Mail::to($firstPopup->email)->send(new ConditionsOfContractMail($firstPopup->email));
                } catch (\Exception $e) {}
                $firstPopup->save();
            }
            //// for vendor progress basic info....
            if($this->vendor_img->contact_person != '' && $this->vendor_img->email != '' && $this->vendor_img->step_completed == '4') {
                $this->vendor_progress_basic = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_basic = 'no';
            }
            //// for vendor uploaded pics info....
            if(count($this->vendor_img->image_data) > 3) {
                $this->vendor_progress_images = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_images = 'no';
            }
            //// for vendor high-quality pics info....
            // if($this->photos > 9) {
            /*if($this->photos > 3) {
                $this->vendor_progress_tenHDimages = 'yes';
                $this->vendor_progress_percentage += 20;
            } else {
                $this->vendor_progress_tenHDimages = 'no';
            }*/
            //// for vendor videos info....
            if($this->videos > 0) {
                $this->vendor_progress_videos = 'yes';
                $this->vendor_progress_percentage += 50;
            } else {
                $this->vendor_progress_videos = 'no';
            }
            //// for vendor deal info....
            /*if($this->deals > 0) {
                $this->vendor_progress_deals = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_deals = 'no';
            }*/
            //// for vendor faq's info....
            /*if($vendor_faqs > 0) {
                $this->vendor_progress_faqs = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_faqs = 'no';
            }*/
            //// for vendor faq's info....
            if($vendor_reviewAsk > 0) {
                $this->vendor_progress_reviewAsk = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_reviewAsk = 'no';
            }
            //// for vendor business address info....
            if($category_data->company_data->business_address != '') {
                $this->vendor_progress_address = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_address = 'no';
            }
            View::share ( 'vendor_progress_percentage', $this->vendor_progress_percentage);
            View::share ( 'vendor_progress_basic', $this->vendor_progress_basic);
            View::share ( 'vendor_progress_images', $this->vendor_progress_images);
            View::share ( 'vendor_progress_tenHDimages', $this->vendor_progress_tenHDimages);
            View::share ( 'vendor_progress_videos', $this->vendor_progress_videos);
            View::share ( 'vendor_progress_deals', $this->vendor_progress_deals);
            View::share ( 'vendor_progress_faqs', $this->vendor_progress_faqs);
            View::share ( 'vendor_progress_reviewAsk', $this->vendor_progress_reviewAsk);
            View::share ( 'vendor_progress_address', $this->vendor_progress_address);
            View::share ( 'vendor_img', $this->vendor_img);
            View::share ( 'deals', $this->deals);
            View::share ( 'photos', $this->photos);
            View::share ( 'videos', $this->videos);
            View::share ( 'events', $this->events);
            View::share ( 'vendor_slug', $category_data);
            return $next($request);
        });
    }

    public function vendorChecklist(Request $request)
    {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['vendor'] = Vendor::where('vendor_id',$this->vendor_id)->first();
        // $dateE = Carbon::now(); 
        // $date = Carbon::now(); 
        // $dateS = $date->modify("-12 months"); // Last day 12 months ago
        // $vendorId = $this->vendor_id;
        // $data['companyData'] = \App\CompanySetting::select('phone_number')->where('id',1)->first();
        // $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        // $data['titleData'] = \App\Page::where('id', 10)->first();
        // $data['message'] = \App\ContactEnquiry::with('user','replies')->where('form_data',2)->where('company_id',$data['vendorData'][0]['company_data']['id'])->orderBy('created_at', 'desc')->limit(4)->get();
        // $data['messageCount'] = \App\ContactEnquiry::where('form_data',2)->where('company_id',$data['vendorData'][0]['company_data']['id'])->whereBetween('created_at', array($dateS, $dateE))->count();
        // $data['reviewCount'] = \App\VendorRating::where('vendor_id',$vendorId)->whereBetween('created_at', array($dateS, $dateE))->count();
        // $data['storefrontView'] = \App\VendorView::where('vendor_id',$vendorId)->whereBetween('created_at', array($dateS, $dateE))->count();
        
        // return view('vendor.vendorChecklist',['data'=>$data]);
        return view('vendor.vendorChecklist', ['data'=>$data]);
        //return view('vendor.vendor_storefront', ['data'=>$data]);
    }

    /*
    *
    * Public Function for Sorting data into month views  
    *
    */
    public function monthViewformat($storeMonthview)
    {
        $mArrarycount = array();
        foreach ($storeMonthview as $key => $value) {
            $m = date("M", mktime(0, 0, 0, $value->month, 1));
            $mArrarycount[$key]['name'] = $m.'-'.$value->year;
            $mArrarycount[$key]['count'] = $value->count;
        }
        $monthsArray = array();
        for ($i=11; $i >= 0; $i--) {           
            $monthsArray[] = date('M-Y',strtotime("now - $i month") );
        }
        $mapviewArray = array();
        $j = 0;
        $k = 0;
        while ($j < 12) {
            if( isset($mArrarycount[$k]) && in_array($monthsArray[$j], $mArrarycount[$k])) {
                $a = array(
                    'name' => $mArrarycount[$k]['name'],
                    'count' => $mArrarycount[$k]['count']
                        );
                array_push($mapviewArray, $a);
                $k++;
            }else {
                $a = array(
                    'name' => $monthsArray[$j],
                    'count' => 0
                        );
                array_push($mapviewArray, $a);
            }
            $j++;
        }
        return $mapviewArray;
    }

    /*
    *
    *   Avarage Responce time for lead message function
    *
    */
    public function avarageLeadresponcetime($replyed, $created, $check)
    {
        $lreplyed = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $replyed);
        $lcreated = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $created);
        if($check == 'minute') {
            $diff_in_hours = $lreplyed->diff($lcreated);
            $ht = $diff_in_hours->h;        // Hours
            $hi = $diff_in_hours->i;        // Minute
            $hs = $diff_in_hours->s;        // Secound
            $fh = sprintf("%02d", $ht);
            $fi = sprintf("%02d", $hi);
            $fs = sprintf("%02d", $hs);
            return $fh.':'.$fi.':'.$fs;
        } elseif ($check == 'hours') {
           return $diff_in_hours = $lreplyed->diffInHours($lcreated);
        }
    }

    /**
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dateE = Carbon::now();
        $date = Carbon::now();
        $dateS = $date->modify("-12 months");// Last day 12 months ago
        $vendorId = $this->vendor_id;
        $data['companyData'] = \App\CompanySetting::select('phone_number')->where('id',1)->first();
        $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['message'] = \App\ContactEnquiry::with('user','replies')->where('form_data',2)->where('company_id',$data['vendorData'][0]['company_data']['id'])->orderBy('created_at', 'desc')->limit(4)->get();
        $data['messageCount'] = \App\ContactEnquiry::where('form_data',2)->where('company_id',$data['vendorData'][0]['company_data']['id'])->whereBetween('created_at', array($dateS, $dateE))->count();
        $data['reviewCount'] = \App\VendorRating::where('vendor_id',$vendorId)->whereBetween('created_at', array($dateS, $dateE))->count();
        $data['storefrontView'] = \App\VendorView::where('vendor_id',$vendorId)->whereBetween('created_at', array($dateS, $dateE))->count();
        // StoreFront monthly View Section
            $storeMonthview = \App\VendorView::selectRaw('COUNT(*) as count, YEAR(created_at) year, MONTH(created_at) month')->where('vendor_id',$vendorId)->whereBetween('created_at', array($dateS, $dateE))->groupBy('year', 'month')->get();
            $mapviewArray = $this->monthViewformat($storeMonthview);    // this is custom sort function in month format
            $data['storefrontmonthView'] = $mapviewArray;
        // Lead Message monthly View section
            $leadMonthview = \App\ContactEnquiry::selectRaw('COUNT(*) as count, YEAR(created_at) year, MONTH(created_at) month')->where('form_data',2)->where('company_id',$data['vendorData'][0]['company_data']['id'])->whereBetween('created_at', array($dateS, $dateE))->groupBy('year', 'month')->get();
            $leadMonthviewArray = $this->monthViewformat($leadMonthview);   // this is custom sort function in month format
            $data['leadsmsmonthView'] = $leadMonthviewArray;
        // Avarage responce time calculations
            $dateRE = Carbon::now(); 
            $date = Carbon::now(); 
            $dateRS = $date->modify("-3 months"); // Last day 3 months ago
            $leadObj = \App\ContactEnquiry::where('form_data',2)->where('company_id',$data['vendorData'][0]['company_data']['id'])->whereBetween('created_at', array($dateS, $dateE))->where('reply_status', 1)->get();
              $responceLeadminute = array();
              $responceLeadhours = array();
              
            if(count($leadObj) > 0) {
              $h = 0;
              foreach ($leadObj as $key => $leadObjvalue) {
                  $leadCreatetime = $leadObjvalue->created_at;
                  $leadReplayobj = ContactEnquiryReply::where('enquiry_id', $leadObjvalue->id)->first();
                //   dd($leadReplayobj);
                  if(isset($leadReplayobj->enquiry_id)) {
                    $leadReplytime = $leadReplayobj->created_at;
                    $responceLeadminute[$h] = $this->avarageLeadresponcetime($leadReplytime, $leadCreatetime, 'minute');
                    $responceLeadhours[$h] = $this->avarageLeadresponcetime($leadReplytime, $leadCreatetime, 'hours');
                  }else{
                    $leadReplytime = $leadObjvalue->updated_at;
                    $responceLeadminute[$h] = $this->avarageLeadresponcetime($leadReplytime, $leadCreatetime, 'minute');
                    $responceLeadhours[$h] = $this->avarageLeadresponcetime($leadReplytime, $leadCreatetime, 'hours');
                    // echo $leadReplytime, ",",$leadCreatetime;
                    // dd($this->avarageLeadresponcetime($leadReplytime, $leadCreatetime, 'hours'));
                  }
                  $h++;
              }
              // echo "<pre>"; print_r($responceLeadhours);
              $responceLeadhours = array_filter($responceLeadhours);
              $averageHours = round(array_sum($responceLeadhours)/count($responceLeadhours));
              $averagetimestring = date('H:i:s', array_sum(array_map('strtotime', $responceLeadminute)) / count($responceLeadminute));
              $avarageMinute = explode(":", $averagetimestring);
              $data['avarageResponcetime'] = $averageHours.'h '.$avarageMinute[1].'m';
            } else {
              $data['avarageResponcetime'] = '00h 00m';
            }
            // echo "<pre>"; print_r($data['avarageResponcetime']);
            $data['vendor_deals']=VendorDeal::join('deal_types','deal_types.id','=','vendor_deals.deal_type_id')
                                          ->select('vendor_deals.id','vendor_deals.name as deal_name','vendor_deals.photo','vendor_deals.status','deal_types.name as type','vendor_deals.expiry_date as end_date')
                                          ->where('vendor_id',$vendorId)->get();
            $companyID = $data['vendorData'][0]['company_data']['id'];
            $unmessa = \App\ContactEnquiry::where('form_data',2)->where('company_id', $companyID)->where('read_status', 0)->orderBy('id','desc')->count();
            $data['ratingDatas'] = VendorRating::leftJoin('vendor_review_reply as vrr','vrr.rating_id','=','vendor_ratings.id')
                                ->select('vendor_ratings.*','vrr.reply_text','vrr.status as rStatus','vrr.reply_image','vrr.created_at as createDate')
                                ->where('vendor_ratings.vendor_id',$vendorId)->where('vendor_ratings.status','1')->limit(5)->get();
            $data['ratingDataCount'] = VendorRating::leftJoin('vendor_review_reply as vrr','vrr.rating_id','=','vendor_ratings.id')
                            ->select('vendor_ratings.*','vrr.reply_text','vrr.status as rStatus','vrr.reply_image','vrr.created_at as createDate')
                            ->where('vendor_ratings.vendor_id',$vendorId)->where('vendor_ratings.status','1')->count();
            $data['phoneNumberViews'] = Vendor::where('vendor_id',$this->vendor_id)->first()->phone_number_count;
            return view('vendor.dashboard',['data'=> $data,'unmessa' => $unmessa]);
    }

    public function profile_settings()
    {
        $vendorId =  $this->vendor_id;
        $data['vendor'] = Vendor::with('company_data','image_data','category_data')->where('vendors.vendor_id',$vendorId)->first();
        $data['titleData'] = \App\Page::where('id', 14)->first();
        $data['categories'] = DB::select(DB::raw("SELECT * FROM categories WHERE id in (SELECT parent_id FROM categories WHERE categories.id IN (SELECT category_id FROM vendor_category_relation WHERE vendor_id = $vendorId) GROUP BY categories.parent_id)"));
        // print_r($data['categories']);
        // die();
        $data['edit_category'] = Category::get_vendor_category($vendorId);
        $data['vendorId'] = $vendorId;
        return view('vendor.profile_setting',['data'=>$data]);
    }

    public function save_profile_settings(Request $request)
    {
        $vendorId = $request->vendor_id;
        $vendorObj = Vendor::find($vendorId);
        $this->validate($request, [
            'username' => ['required','min:5','max:30',Rule::unique('vendors')->where('vendor_id','<>',$vendorObj->vendor_id)
            // |unique:vendors,username,vendor_id,\''.$this->vendor_id.'\''
            ],
            'email' => ['required','email',/*Rule::unique('vendors')->where(function($query) use($vendorObj,$request) {
                return $query->where('vendor_id','!=',$vendorObj->vendor_id)->where('email',$request->email);
                
            })*/],
            // 'required|email|unique:vendors,email,vendor_id,\''.$this->vendor_id.'\'',
            'categories' => 'required|array|min:1',
        ]);
        $vendorEmail = $request->email;
        $category = $request->input('categories');
        if(empty($category))
            return redirect()->back()->with('error', 'Categories not selected. Please select atleast one category !!');
        $chkVendor = Vendor::where('vendor_id','!=',$vendorId)->where(function($query) use($vendorEmail,$request){
            $query->where('email',$vendorEmail);
            $query->orwhere('username',$request->username);
        })->count();
        if($chkVendor > 0) {
            return redirect()->back()->with('error', 'Email address or username is already exist! Please check once.');
        } else {
            
            $vendorObj->username = $request->input('username');
            $vendorObj->email = $request->input('email');
            if($request->has('password') && !empty($request->input('password'))) {
                $vendorObj->password = bcrypt($request->input('password'));
                $vendorObj->remember_token = null;
            }
            $data = $vendorObj->save();
            if($data){
                if($request->has('password') && !empty($request->input('password')))
                {
                    $sendData['name'] = $vendorObj->username;
                    Mail::to($vendorObj->email)->send(new UserChangePassword($sendData));
                }
                VendorCategoryRelation::where('vendor_id',$vendorObj->vendor_id)->delete();
                foreach ($category as $key => $value) {
                    $categoryRelation = new VendorCategoryRelation;
                    $categoryRelation->vendor_id = $vendorObj->vendor_id;
                    $categoryRelation->category_id = $value;
                    $data = $categoryRelation->save();
                }
                if($data)
                    return redirect()->back()->with('success', 'Profile Updated Successfully.');
                else
                    return redirect()->back()->with('error', 'Something went wrong! Please try again.');
            }else{
                return redirect()->back()->with('error', 'Something went wrong! Please try again.');
            }
        }
    }

     /**
     * Show the user setting page.
     *
     * @return \Illuminate\Http\Response
     */
    public function vendor_settings()
    {
        $vendorId =  $this->vendor_id;
        $data['userData'] = \Auth::user();
        $data['companyData'] = \App\CompanySetting::where('id',1)->first();
        $data['vendorData'] = Vendor::with('company_data','image_data','category_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $countries = \App\Countries::where('status',1)->get()->toArray();
        $regions = \App\Regions::distinct()->get(['state']);
        $data['titleData'] = \App\Page::where('id', 14)->first();
        return view('vendor.vendor_setting',['data'=>$data,'countries'=>$countries,'regions'=>$regions]);
    }

    /**
     * Save the user setting page.
     *
     * @return \Illuminate\Http\Response
     */
    public function save_vendor_settings(Request $request)
    {
         $this->validate($request, [
          'contact_person' => 'required|string',
          'telephone' => 'required',
          'country' => 'required',
          'province' => 'required',
          'city' => 'required',
          'postal_code' => 'required',
          'address' => 'required',
          'business_name' => 'required',
          'business_address' => 'required',
         ]);
        $vendorId =  \Auth::user()->vendor_id;
        $companyId = $request->input('company_id');
        $vendorObj = Vendor::find($vendorId);
        /*********************************************/
        $vendorObj->contact_person = $request->input('contact_person');
        $vendorObj->telephone = $request->input('telephone');
        $vendorObj->mobile = $request->input('mobile');
        $vendorObj->fax = $request->input('fax');
        $vendorObj->website = $request->input('website');
        $data = $vendorObj->save();
        if($data){
            /*********************************************/
            $vendorCompanyObj = VendorCompany::find($companyId);
            $vendorCompanyObj->country = $request->input('country');
            $vendorCompanyObj->province = $request->input('province');
            $vendorCompanyObj->city = $request->input('city');
            $vendorCompanyObj->postal_code = $request->input('postal_code');
            $vendorCompanyObj->address = $request->input('address');
            $vendorCompanyObj->business_name = $request->input('business_name');
            $vendorCompanyObj->business_name_slug = $this->makeSlugFromTitle($request->input('business_name'));
            $vendorCompanyObj->business_detail = $request->input('business_detail');
            $vendorCompanyObj->business_address = $request->input('business_address');
            $vendorCompanyObj->save();
            $checkNews = UserNewsletter::where('email_id',$vendorObj->email)->where('status',0)->count();
            try {
                if(!$checkNews)
                    Mail::to($vendorObj->email)->send(new VendorMakeChangesMail($vendorObj->username,$vendorObj->email));
            } catch (\Exception $e) {}
            return redirect()->back()->with('success', 'Profile Updated Successfully.');
        }else{
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    /**
    * Save the account setting page.
    *
    * @return \Illuminate\Http\Response
    */

    public function save_account_settings(Request $request)
    {
        $this->validate($request, [
              'current_password' => 'required',
              'password' => 'required|min:6|same:password',
              'password_confirmation' => 'required|min:6|same:password',
        ]);
        $current_password = \Auth::User()->password;
        if(\Hash::check($request->input('current_password'), $current_password))
        {           
            $vendorId =  \Auth::user()->vendor_id;
            $emailAddress =  \Auth::user()->email;
            $sendData['name'] =  \Auth::user()->username;
            $userObj = Vendor::find($vendorId);
            $userObj->password = bcrypt($request->input('password'));
            $response = $userObj->save();
            if($response){
                try {
                    Mail::to($emailAddress)->send(new UserChangePassword($sendData));
                } catch (\Exception $e) {}
               return redirect()->back()->with('success','Password Updated Successfully.');
            }else{
               return redirect()->back()->with('error','Something went wrong! Please try again.');
            }
        }
        else
        {           
           return redirect()->back()->with('error','Please enter correct current password.'); 
        }
       
    }

    /**
     * Show the account setting page.
     *
     * @return \Illuminate\Http\Response
     */

    public function account_settings()
    {
        $vendorId =  \Auth::user()->vendor_id;
        $data['titleData'] = \App\Page::where('id', 15)->first();
        $data['companyData'] = \App\CompanySetting::where('id',1)->first();
        $data['vendorData'] = Vendor::with('image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        return view('vendor.account_setting',['data'=>$data]);
    }

    /*
    * ---------------------------------------------------
    *  Make Slug From Title
    * ---------------------------------------------------
    */

    public function makeSlugFromTitle($title)
    {
        $slug = str_slug($title);
        $count = VendorCompany::whereRaw("business_name_slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }

    /**
     * Show the discount setting page.
     *
     * @return \Illuminate\Http\Response
     */

    public function discount_settings()
    {
        $vendorId =  \Auth::user()->vendor_id;
        $data['companyData'] = \App\CompanySetting::where('id',1)->first();
        $data['vendorData'] = Vendor::with('image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $data['titleData'] = \App\Page::where('id', 14)->first();
        $data['offer'] = \App\VendorPromotion::where('vendor_id',$vendorId)->first();
        /*echo"<pre>";
        print_r($data['offer']->toArray());
        die;*/
        return view('vendor.discount_setting',['data'=>$data]);
    }

    public function save_discount_settings(Request $request){
         $this->validate($request, [
              'promotion_id' => 'required',
        ]);
        $vendorId =  \Auth::user()->vendor_id;
        $offer_wedding = $request->input('offer_wedding') ?? null;
        $promotion_amount = $request->input('promotion_amount');
        $id = $request->input('promotion_id');
        $response = \App\VendorPromotion::where('id', $id)
          ->where('vendor_id', $vendorId)
          ->update(['offer_wedding' => $offer_wedding, 'promotion_amount' => $promotion_amount]);
        if($response){
           return redirect()->back()->with('success','Discount Settings Updated Successfully.');
        }else{
           return redirect()->back()->with('error','Something went wrong! Please try again.');
        }


    }


   /**
     * Show the image setting page.
     *
     * @return \Illuminate\Http\Response
     */

    public function image_settings()
    {
        $vendorId =  \Auth::user()->vendor_id;
        $data['companyData'] = \App\CompanySetting::where('id',1)->first();
        $data['vendorData'] = Vendor::with('company_data','image_data','category_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        //$countries = \App\Countries::where('status',1)->get()->toArray();
        //$regions = \App\Regions::distinct()->get(['state']);
        $data['titleData'] = \App\Page::where('id', 14)->first();
        return view('vendor.image_setting',['data'=>$data]);
    }


    /*
    * ---------------------------------------------------
    *  Set Album Image Via Ajax
    * ---------------------------------------------------
    */

    public function set_as_profile_image(Request $request){
        $this->validate($request, [
                 'id' => 'required',
             ]);
        $vendorId =  \Auth::user()->vendor_id;
        \App\VendorImage::where('vendor_id',$vendorId)->update(array('is_logo'=>'0'));
        $flight = \App\VendorImage::find($request->input('id'));
        $flight->is_logo = '1';
        if($flight->save()){
           return response()->json(array('errorVal'=>false,'msg'=>'Profile image set successfully.'), 200);
        }else{
           return response()->json(array('errorVal'=>true,'msg'=>'Something went wrong! Please try again.'), 422);
         }    
    }
 
   /*
    * ---------------------------------------------------
    *  Delete Album Image Via Ajax
    * ---------------------------------------------------
    */

    public function delete_vendor_images(Request $request){
        $this->validate($request, [
                 'id' => 'required',
             ]);
        $flight = \App\VendorImage::find($request->input('id'));
        if($flight->delete()){
           return response()->json(array('errorVal'=>false,'msg'=>'Image deleted successfully.'), 200);
        }else{
           return response()->json(array('errorVal'=>true,'msg'=>'Image not deleted. Please try again.'), 422);
         }    
    }

     /*
    * ---------------------------------------------------
    *  Upload Vendor Image Via Ajax
    * ---------------------------------------------------
    */

    public function uploadVendorImages(Request $request){
        $vendorId =  \Auth::user()->vendor_id;
        if(isset($vendorId) && $vendorId!=''){
             $this->validate($request, [
                //   'imageVendor' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                  'imageVendor' => 'required|max:2048',
             ]);
             $image = $request->file('imageVendor');
             $input['image'] = time().'.'.$image->getClientOriginalExtension();
             $destinationPath = public_path('/vendors/VENDOR_'.$vendorId);
             if($image->move($destinationPath, $input['image'])){
                 //************************************************//
                    $vendorImageObj = new VendorImage;
                    $vendorImageObj->vendor_id = $vendorId;
                    $vendorImageObj->vendor_folder = 'VENDOR_'.$vendorId;
                    $vendorImageObj->image = $input['image'];
                    if($vendorImageObj->save()){
                      return response()->json(array('errorVal'=>false,'msg'=>'VENDOR_'.$vendorId.'/'.$input['image']), 200);
                    }else{
                      return response()->json(array('errorVal'=>true,'msg'=>'Image not saved. Please try again.'), 200);
                    }
                 //************************************************//
             }else{
                 return response()->json(array('errorVal'=>true,'msg'=>'Image not uploaded. Please try again.'), 200);
             }
        }else{
             return response()->json(array('errorVal'=>true,'msg'=>'Something went wrong! Please try again.'), 200);
        }
    }

    
     /**
     * Show the question setting page.
     *
     * @return \Illuminate\Http\Response
     */

    public function question_settings()
    {
        $data['titleData'] = \App\Page::where('id', 15)->first();
        $data['companyData'] = \App\CompanySetting::where('id',1)->first();
        $vendorId =  \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        ///////////////////////////////////
        $getCatId = Vendor::select('cat_id')->where('vendor_id',$vendorId)->get()->toArray();
        if(isset($getCatId[0]['cat_id']) && $getCatId[0]['cat_id'] !=''){
           $venObj = new Vendor;
           $getAllQuestions = $venObj->getAllQuestions($vendorId,$getCatId[0]['cat_id']);
        }else{
           $getAllQuestions = array();
        }
        /////////////////////////////////////
        $answers = \App\VendorQuestion::where('vendor_id',$vendorId)->get()->toArray();
        if(isset($answers) && !empty($answers)){
             $answers = array_column($answers,'answer','question_id');
        }
        return view('vendor.question_setting',['data'=>$data,'questions'=>$getAllQuestions,'answers'=>$answers]);
    }

    public function update_vendor_questions(Request $request){
          $this->validate($request, [
                 'id' => 'required',
             ]);
         $vendorId =  \Auth::user()->vendor_id;         
         $response = \App\VendorQuestion::where('question_id',$request->input('id'))->where('vendor_id', $vendorId)->update(['answer'=>$request->input('value')]);
         if($response){
            return response()->json(array('errorVal'=>false,'msg'=>'Data updated successfully.'), 200);
         }else{
            return response()->json(array('errorVal'=>true,'msg'=>'Something went wrong! Please try again.'), 200);
         }
    }

     /**
     * Show the STOREFRONT page.
     *
     * @return \Illuminate\Http\Response
     */
     public function get_storefront() {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$this->vendor_id)->get()->toArray();
        $vendorId = $this->vendor_id;
        $data['vendor'] = Vendor::where('vendor_id',$this->vendor_id)->first();
        $data['business_info'] = BusinessInfo::where('vendor_id',$vendorId)->first();
        $data['socials'] = DB::select(DB::raw("SELECT *,social_media.id as main_id FROM social_media LEFT JOIN  business_social_media ON (business_social_media.social_media_id = social_media.id AND business_social_media.vendor_id = '$vendorId')"));
        $data['business_hours'] = BusinessHours::where('vendor_id',$vendorId)->get()->toArray();
        return view('vendor.vendor_storefront', ['data'=>$data]);
     }

      public function saveBusinessInfo(Request $request) {
        $this->validate($request, [
              'contact_person' => 'required',
              'email' => 'required|email',
              'telephone' => 'required|min:10|max:12',
        ]);
        $vendorId =  \Auth::user()->vendor_id;
        /*$social_media = SocialMedia::all();
        BusinessSocialMedia::where('vendor_id',$vendorId)->delete();
        foreach ($social_media as $key => $value) {
            $social = new BusinessSocialMedia;
            $social->vendor_id = $vendorId;
            $social->social_media_id = $value->id;
            $social->link = $request->input($value->slug);
            $social->save();
        }*/
        BusinessHours::where('vendor_id',$vendorId)->delete();
        $businessHours = new BusinessHours();
        $businessHours->vendor_id = $vendorId;
        $businessHours->day = 'SUN';
        $businessHours->open = $request->input('sunday_open');
        $businessHours->close = $request->input('sunday_close');
        $businessHours->save();
        $businessHours = new BusinessHours();
        $businessHours->vendor_id = $vendorId;
        $businessHours->day = 'MON';
        $businessHours->open = $request->input('monday_open');
        $businessHours->close = $request->input('monday_close');
        $businessHours->save();
        $businessHours = new BusinessHours();
        $businessHours->vendor_id = $vendorId;
        $businessHours->day = 'TUE';
        $businessHours->open = $request->input('tue_open');
        $businessHours->close = $request->input('tue_close');
        $businessHours->save();
        $businessHours = new BusinessHours();
        $businessHours->vendor_id = $vendorId;
        $businessHours->day = 'WED';
        $businessHours->open = $request->input('wed_open');
        $businessHours->close = $request->input('wed_close');
        $businessHours->save();
        $businessHours = new BusinessHours();
        $businessHours->vendor_id = $vendorId;
        $businessHours->day = 'THU';
        $businessHours->open = $request->input('thu_open');
        $businessHours->close = $request->input('thu_close');
        $businessHours->save();
        $businessHours = new BusinessHours();
        $businessHours->vendor_id = $vendorId;
        $businessHours->day = 'FRI';
        $businessHours->open = $request->input('fri_open');
        $businessHours->close = $request->input('fri_close');
        $businessHours->save();
        $businessHours = new BusinessHours();
        $businessHours->vendor_id = $vendorId;
        $businessHours->day = 'SAT';
        $businessHours->open = $request->input('sat_open');
        $businessHours->close = $request->input('sat_close');
        $businessHours->save();
        $business_info = BusinessInfo::where('vendor_id',$vendorId)->first();
        $business = isset($business_info->id)?BusinessInfo::find($business_info->id):new BusinessInfo;
        $business->vendor_id = $vendorId;
        $business->free_parking = $request->input('free_parking');
        $business->paid_parking = $request->input('paid_parking');
        $business->indoor_parking = $request->input('indoor_parking');
        $business->no_parking = $request->input('no_parking');
        $business->wheel_chair = $request->input('wheelchair');
        $business->motor_vehicle = $request->input('motor_vehicle');
        $business->health_benefit = $request->input('health_benefit');
        $business->gov_insurance = $request->input('gov_insurance');
        $business->self_pay = $request->input('self_pay');
        $business->personal_cheque = $request->input('personal_cheque');
        $business->finance_available = $request->input('finance_available');
        $business->holiday_special = $request->input('special_message');
        // $business->language_spoke = $request->input('language_spoken');
        $business->language = is_array($request->input('languages')) ? implode(',',$request->input('languages')) : $request->input('languages');
        $business->sign_language = $request->input('sign_language');
        $business->lgbtq = $request->input('lgbtq');
        $business->save();
        // dd($request->all());
        $response = \App\Vendor::where('vendor_id', $this->vendor_id)
                              ->update(['business_description'=>$request->description,
                                    'contact_person' => $request->contact_person,
                                    'email' => $request->email,
                                    'telephone'=>$request->telephone,
                                    'mobile'=>$request->mobile,
                                    'fax'=>$request->fax,
                                    'website'=>$request->website,
                                    'is_business_hours' => $request->has('is_business_hours') && $request->is_business_hours == 1 ? 1 : 0
                                ]);
        $companyData = VendorCompany::where('vendor_id',$this->vendor_id)->update(['business_detail' => $request->description]);
        $vendorObj = Vendor::where('vendor_id',$vendorId)->first();
        if($response){
            try {
                $checkNews = UserNewsletter::where('email_id',$vendorObj->email)->where('status',0)->count();
                if(!$checkNews)
                    Mail::to($vendorObj->email)->send(new VendorMakeChangesMail($vendorObj->username,$vendorObj->email));
            } catch (\Exception $e) {}
           return redirect()->back()->with('success','Saved changes.');
        }else{
           return redirect()->back()->with('error','Something went wrong! Please try again.');
        }

        dd($request->all());

     }

        /**
     * Show the billing page.
     *
     * @return \Illuminate\Http\Response
     */

     public function get_invoices() {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        return view('vendor.vendor_invoices', ['data'=>$data]);
     }

      /**
     * Show the bills page.
     *
     * @return \Illuminate\Http\Response
     */

      public function get_bills() {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        return view('vendor.vendor_bills', ['data'=>$data]);
      }

      /**
     * Show the Payment Method page.
     *
     * @return \Illuminate\Http\Response
     */

      public function get_payment_method() {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        return view('vendor.vendor_payment_method', ['data'=>$data]);
      }


      /**
     * Show the Add Payment Method page.
     *
     * @return \Illuminate\Http\Response
     */

      public function get_add_payment_method() {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        return view('vendor.vendor_add_payment_method', ['data'=>$data]);
      }

       /**
     * Show the Storefront Map page.
     *
     * @return \Illuminate\Http\Response
     */

    public function get_storefrontmap()
    {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['countries']=DB::table('countries')->where('status',1)->get();
        $data['vendor'] = Vendor::where('vendor_id',$this->vendor_id)->first();
        $count = VendorLocation::where('vendor_id',$this->vendor_id)->count();
        //if there is only 1 locatin make it default
        if($count == 1) {
            VendorLocation::where('vendor_id',$this->vendor_id)->update(['is_primary'=>1]);
        }
        $data['location'] = DB::table('vendor_locations')
                            ->join('cities','cities.id','=','vendor_locations.city_id')
                            ->join('states','states.id','=','cities.state_id')
                            ->join('countries','countries.id','=','states.country_id')
                            ->select('vendor_locations.*','cities.name as city','states.name as state','countries.id as country_id','countries.name as country')
                            ->where('vendor_locations.vendor_id',$this->vendor_id)->get();
        $address = VendorCompany::where('vendor_id',$this->vendor_id)->first();
        $regions = \App\Regions::distinct()->get(['state']);
        return view('vendor.storefront_map',['data'=>$data,'address' => $address,'regions' => $regions]);
    }

    public function autocompleteAjax(Request $request)
    {
        $search = $request->get('term');
        $result = DB::table('countries')
                    ->join('states','states.country_id','=','countries.id')
                    ->join('cities','cities.state_id','=','states.id')
                    ->select('cities.name as city','states.name as state','cities.id')
                    ->where('cities.name','LIKE','%'.$search.'%')
                    ->orwhere('states.name','LIKE','%'.$search.'%')->get();
        // print_r($result);
        return response()->json($result);
        die;
        $data = array();
        foreach ($result as $country) {
            $data[]=array('term'=>$country->city.', '.$country->state);
        }
        if(count($data)) {
            return $data;
        } else {
            return ['name'=>'','sortname'=>''];
        }
    }

    public function autocomplete_latlong(Request $request)
    {
        $address = '';
        $evCity = $request->city;
        $evAddress = $request->address;
        if($evAddress != '' && $evCity != '') {
            $address = $evAddress.', '.$evCity;
        } elseif($evCity != '') {
            $address = $evCity;
        }
        $address = urlencode($address);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false&key=".env('GMAP_API_KEY_NEW');
        $resp_json = file_get_contents($url);
        $resp = json_decode($resp_json, true);
        if(count($resp['results']) > 0 && $resp['status'] == 'OK') {
            $lat = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
            $lng = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
            $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
            if($lat && $lng && $formatted_address) {
                $data_arr = array();
                array_push($data_arr,$lat,$lng,$formatted_address);
                return $data_arr;
            } else {
                return false;
            }
        } else {
            echo "<strong>ERROR: {$resp['status']}</strong>";
            return false;
        }
    }

    public function saveAddressInfo(Request $request)
    {
        $vendorId =  $this->vendor_id;
        // echo "$request->action action";
        // return;
        if($request->action == "company"){
            $this->validate($request,[
                "province" => "required",
				"city" => "required",
				"postal_code" => "required",
				"address" => "required",
            ]);
            $vendorCompany = VendorCompany::where('vendor_id',$vendorId)->first();
            $vendorCompany = VendorCompany::find($vendorCompany->id);
            $vendorCompany->province = $request->province;
            $vendorCompany->city = $request->city;
            $vendorCompany->postal_code = $request->postal_code;
            $vendorCompany->address = $request->address;
            if($vendorCompany->save())
                return redirect()->back()->with('success',"Successfully updated address details !!");
            else
                return redirect()->back()->with('error',"Something went wrong. Please try again later !!");
        }
        if($request->action=='update') {
            $is_primary=isset($request->is_primary)?:'';
            if($is_primary) {
                VendorLocation::where('vendor_id',$vendorId)->update(['is_primary'=>0]);
            }
            $update_arr = [
                'address'=>$request->address,
                'postal_code' => $request->postal_code,
                'main_telephone'=>$request->phone_main,
                'extension'=>$request->phone_ext,
                'fax'=>$request->phone_fax,
                'other_telephone'=>$request->phone_other,
                'business_hours'=>$request->business_hours,
                'latitude'=>$request->latitude,
                'longitude'=>$request->longitude,
                'is_primary'=>$is_primary?$is_primary:0
            ];
            if($request->city) {
                $update_arr['city_id']= $request->city;
            }
            $response = VendorLocation::where(['id'=>$request->address_id,'vendor_id'=>$vendorId])->update($update_arr);
            $result_city = DB::table('vendor_locations')->join('cities','cities.id','=','vendor_locations.city_id')
                        ->join('states','states.id','=','cities.state_id')->join('countries','countries.id','=','states.country_id')
                        ->select('cities.name as city','states.name as state','countries.id as country_id','countries.name as country')
                        ->where(['vendor_locations.vendor_id'=>$vendorId,'vendor_locations.id'=>$request->address_id])->first();
            if($result_city) {
                $city_st = $result_city->city.', '.$result_city->state;
            } else {
                $city_st = '';                                                  
            }
            if($response) {
                try {
                    $vendorObj = Vendor::where('vendor_id',$vendorId)->first();
                    $checkNews = UserNewsletter::where('email_id',$vendorObj->email)->where('status',0)->count();
                    if(!$checkNews)
                        Mail::to($vendorObj->email)->send(new VendorMakeChangesMail($vendorObj->username,$vendorObj->email));
                } catch (\Exception $e) {}
                return response()->json(['success'=>'Address saved successfully.','city'=>$city_st]);
            } else {
                return response()->json(['error'=>'Something went wrong. Please try again']);   
            }
        } elseif($request->action == 'elimenate') {
            $deleted = VendorLocation::where(['id'=>$request->address_id,'vendor_id'=>$vendorId])->delete();
            if($deleted) {
                return response()->json(['success'=>'Address eliminated successfully.']);
            } else {
                return response()->json(['error'=>'Something went wrong. Please try again']);
            }
        } elseif($request->action=='update_map') {
            // echo "string";
            $add = '';
            /*if(isset($request->address) && $request->address) {
                $add .= $request->address;
            }
            if(isset($request->city) && $request->city) {
                $add .= ', '.$request->city;
            }
            if(isset($request->postal_code) && $request->postal_code) {
                $add .= ' '.$request->postal_code;
            }*/
            if(isset($request->city) && $request->city != '') {
                $add = $request->city;
            }
            if($add) {
                $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($add).'&sensor=false&key='.env('GMAP_API_KEY_NEW');
                $geo = file_get_contents($url);
                //// We convert the JSON to an array......
                $geo = json_decode($geo, true);
                // echo count($geo['results']); // print_r($geo);
                if (count($geo['results'])>0 && $geo['status'] = 'OK') {
                    $latitude  =  $geo['results'][0]['geometry']['location']['lat'];
                    $longitude = $geo['results'][0]['geometry']['location']['lng'];
                    if(isset($request->address_id) && !empty($request->address_id)){
                        $mapObj = VendorLocation::find($request->address_id);
                        $mapObj->latitude = $latitude;
                        $mapObj->longitude = $longitude;
                        $mapObj->save();
                    }
                    return response()->json(['lat'=> $latitude ,'lng'=>$longitude,'url' => $url]);
                } else {
                    return response()->json(['status'=> $geo['status'],'url' => $url]);  
                }
            }
        } else {
            //dd($request->all());
            $validator = Validator::make($request->all(), [
                'country' => 'required',
                'city' => 'required',
                'postal_code' => 'required|min:6|max:12',
                'address' => 'required',
            ]);
            if ($validator->passes()) {
                $vendor_loc = new VendorLocation();
                $vendor_loc->vendor_id=$vendorId;
                $vendor_loc->address=$request->address;
                $vendor_loc->city_id=$request->city_id;
                $vendor_loc->postal_code=$request->postal_code;
                $vendor_loc->main_telephone=$request->phone_main;
                $vendor_loc->fax=$request->phone_fax;
                $vendor_loc->extension=$request->phone_ext;
                $vendor_loc->other_telephone=$request->phone_other;
                $vendor_loc->business_hours=$request->business_hours;
                $vendor_loc->save();
                return response()->json(['success'=>'Address created successfully.']);
            }
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        /*if($response) {
            return redirect()->back()->with('success','Address created successfully.');
        } else {
            return redirect()->back()->with('error','Something went wrong! Please try again.');
        }*/
    }

      /**
     * Show the Storefront FAQs page.
     *
     * @return \Illuminate\Http\Response
     */

    public function get_storefrontfaqs()
    {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId =  $this->vendor_id;
         $data['vendor'] = Vendor::with(['image_data'=>function($q) {
                        $q->where(['is_logo'=>1,'status'=>1]);
          }])->where('vendors.vendor_id',$vendorId)->first();
        $vendor_faqs   = VendorFaq::where('vendor_id',$vendorId)->orderBy('question_id','ASC')->get();
        $faq_ans_arr = array();
        foreach ($vendor_faqs as $faq) {
          if($faq->question_id==1){
            $faq_ans_arr['fd_arr'][]=explode(",", $faq->answer);
          }
          if($faq->question_id==2){
            $faq_ans_arr['fs_arr'][]=explode(",", $faq->answer);
          }
          if($faq->question_id==3){
            $faq_ans_arr['ta_arr'][]=explode(",", $faq->answer);
          }
          if($faq->question_id==4){
             $faq_ans_arr['price_bridal'][]=str_replace("$","",$faq->answer);
          }
          if($faq->question_id==5){
            $faq_ans_arr['price_bridesmaid'][]=str_replace("$","",$faq->answer);
          }
          if($faq->question_id==6){
            $faq_ans_arr['price_boutonniere'][]=str_replace("$","",$faq->answer);
          }
          if($faq->question_id==7){
            $faq_ans_arr['price_low_tbl'][]=str_replace("$","",$faq->answer);
          }
          if($faq->question_id==8){
            $faq_ans_arr['price_elevated_tbl'][]=str_replace("$","",$faq->answer);
          }
          if($faq->question_id==9){
            $faq_ans_arr['price_customer_expect'][]=str_replace("$","",$faq->answer);
          }
          if($faq->question_id==10){
            $faq_ans_arr['cost_fd_arr'][]=explode(",", $faq->answer);
          }
        }
        //$data['faq_ans_arr']=json_encode($faq_ans_arr);
        //$data['questions']      =   DB::table('vendor_faq_questions')->where('status','1')->orderBy('sort_order','asc')->get();
        $data['floral_designs'] =   DB::table('faq_floral_designs')->where('status','1')->orderBy('sort_order','asc')->get();
        $data['floral_services'] =  DB::table('faq_floral_services')->where('status','1')->orderBy('sort_order','asc')->get();
        $data['type_arrangements'] =DB::table('faq_type_arrangements')->where('status','1')->orderBy('sort_order','asc')->get();

        return view('vendor.vendor_storefront_faqs', ['data'=>$data,'faq_ans_arr'=>$faq_ans_arr]);
    }

        /**
     * Save the Storefront FAQs page.
     *
     * @return \Illuminate\Http\Response
     */
      public function save_storefrontfaqs(Request $request) {

        $vendorId =  \Auth::user()->vendor_id;

        //print_r($request->all());

        VendorFaq::where(['vendor_id'=>$vendorId])->delete();
        $faqs=$request->faqs;

        foreach ($faqs as $key=>$val) {

          if($key>0) {
              $vendor_faq=new VendorFaq();

              $vendor_faq->vendor_id=$vendorId;
              $vendor_faq->question_id=$key;
              $vendor_faq->answer=is_array($val)?implode(",",$val):$val;
              $vendor_faq->save();
          }
        }
       $faqs_ans=VendorFaq::where(['vendor_id'=>$vendorId])->orderBy('question_id','asc')->get();
        return response()->json(['status'=>'success','message'=>'Your changes were saved.','faqs_ans'=>$faqs_ans]);
       }

     /**
     * Show the Storefront Deals page.
     *
     * @return \Illuminate\Http\Response
     */

       public function get_promociones() {

         $data['titleData'] = \App\Page::where('id', 10)->first();
         $vendorId =  \Auth::user()->vendor_id;
         $data['vendor'] = Vendor::with(['image_data'=>function($q) {
                        $q->where(['is_logo'=>1,'status'=>1]);

          }])->where('vendors.vendor_id',$vendorId)->first();
         
         $discount=VendorPromotion::where('vendor_id',$vendorId)->first();
        if(isset($discount)&&!empty($discount)) {
           $data['offer'] = $discount;
        }
        $data['vendor_deals']=VendorDeal::join('deal_types','deal_types.id','=','vendor_deals.deal_type_id')
                                          ->select('vendor_deals.id','vendor_deals.name as deal_name','vendor_deals.photo','vendor_deals.status','deal_types.name as type','vendor_deals.expiry_date as end_date')
                                          ->where('vendor_id',$vendorId)->get();
         $data['vendor_photo'] = VendorImage::where(['status'=>1,'vendor_id'=>$vendorId])->orderBy('is_logo','asc')->get(); 
         $data['vendor_videos']=VendorVideo::where('vendor_id',$vendorId)->orderBy('sort_order','asc')->get(); 
         $data['vendor_events']=VendorEvent::join('event_types','event_types.id','=','vendor_events.event_type_id')->select('vendor_events.*','event_types.name as event_type')->where('vendor_id',$vendorId)->get();
        return view('vendor.vendor_storefront_deals', ['data'=>$data]);
       }

       public function save_promociones(Request $request){
         /*$this->validate($request, [
              'promotion_id' => 'required'
        ]);*/
        $vendorId =  \Auth::user()->vendor_id;
        $offer_wedding = $request->offer_wedding ?? null;
        $promotion_amount = $request->discount;
        $id = $request->promotion_id;
        if($id){
          $response = VendorPromotion::where(['id'=>$id,'vendor_id'=>$vendorId])->update(['offer_wedding'=>$offer_wedding,'promotion_amount' => $promotion_amount]);
        }
        else{
          $discount = new VendorPromotion();

          $discount->offer_type=1;
          $discount->vendor_id=$vendorId;
          $discount->offer_wedding=$offer_wedding;
          $discount->promotion_amount=$promotion_amount;
          $discount->save();
        }
        return response()->json(['status'=>'success','message'=>'Special discount saved successfully.']);
    }

     /**
     * Show the Add Deals page.
     *
     * @return \Illuminate\Http\Response
     */
    
      public function get_promocionesnew() {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId =  $this->vendor_id;
        $data['vendor'] = Vendor::where('vendor_id',$this->vendor_id)->first();
        $data['deal_types'] = DealTypes::where('status','1')->get();
        return view('vendor.vendor_storefront_add_deals', ['data'=>$data]);
       }

     /**
     Save deal
     */  
     public function save_promocionesnew(Request $request) {


       // dd($request->all());
       $vendorId =  \Auth::user()->vendor_id;

       $validator = Validator::make($request->all(), [
              'deal_name' => 'required',
              'deal_type' => 'required',
              'description' => 'required',
              ]
          );

       if ($validator->passes()) {
            
            $expiry_date_arr=explode("/",$request->expiry_date);
            
                                   
              $vendor_deal = new VendorDeal();

              $vendor_deal->vendor_id=$vendorId;
              $vendor_deal->name=$request->deal_name;
              $vendor_deal->deal_type_id=$request->deal_type;
              $vendor_deal->description=$request->description;
              if(isset($request->expiry_date))
                $vendor_deal->expiry_date=$expiry_date_arr[2].'-'.$expiry_date_arr[1].'/'.$expiry_date_arr[0];
              
              if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = uniqid() . '_' . time(). '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/deal_photo/'), $filename);
                $vendor_deal->photo=$filename;
              }
              
              $vendor_deal->status='Pending';
             
              $vendor_deal->save();
                  
              return response()->json(['status'=>'success','message'=>'Promotion created successfully.']);
          }

          return response()->json(['error'=>$validator->errors()->all()]);


     }
     // get edit deal
    
     public function get_promocionesedit($id){

        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId =  $this->vendor_id;
        $data['vendor'] = Vendor::where('vendor_id',$this->vendor_id)->first();
        $data['deal_types'] = DealTypes::where('status','1')->get();
        $data['vendor_deal'] = VendorDeal::where('id',$id)->where('vendor_id',$vendorId)->first();
        return view('vendor.vendor_storefront_edit_deals', ['data'=>$data]);
     }

     public function remove_promo_img($id){
        $vendor_deal_img=VendorDeal::find($id);
        if($vendor_deal_img->photo) {
            unlink(public_path('images/deal_photo/'.$vendor_deal_img->photo));
        }
        $vendor_deal_img->photo='';
        $vendor_deal_img->save();
        return response()->json(['status'=>'success','message'=>'Image removed.']);
     }

     /** Update deals */
     public function update_promociones(Request $request) {

       
       $vendorId = $this->vendor_id;
       $id=$request->id;
       $validator = Validator::make($request->all(), [
              'deal_name' => 'required',
              'deal_type' => 'required',
              'description' => 'required'
          ]
        );
        if ($validator->passes()) {
        
            $vendor_deal=VendorDeal::find($id);
            $expiry_date_arr=explode("/",$request->expiry_date);
            if($request->hasFile('image')){
              
              $image = $request->file('image');
               $filename = uniqid() . '_' . time(). '.' . $image->getClientOriginalExtension();
               $image->move(public_path('images/deal_photo/'), $filename);
               $vendor_deal->photo=$filename;
              
            } 
            $vendor_deal->name=$request->deal_name;
            $vendor_deal->deal_type_id=$request->deal_type;
            $vendor_deal->description=$request->description;
            $vendor_deal->expiry_date=$expiry_date_arr[2].'-'.$expiry_date_arr[1].'/'.$expiry_date_arr[0];
            
            $vendor_deal->save();
            return response()->json(['status'=>'success','message'=>'Promotion updated successfully.']);        
          }
          return response()->json(['error'=>$validator->errors()->all()]);
     }


     public function delete_promo($id){

      
        $vendor_deal=VendorDeal::find($id);
        if($vendor_deal->photo){
            unlink(public_path('/images/deal_photo/'.$vendor_deal->photo));
        }
       
        if($vendor_deal->delete())
          return response()->json(['status'=>'success','message'=>'Promotion deleted successfully.']);
        else
          return response()->json(['status'=>'error','message'=>'Something went wrong, please try lator']);  
     }

     /**
     * Show the Gallery page.
     *
     * @return \Illuminate\Http\Response
     */

     public function get_gallery() {

        $data['titleData'] = \App\Page::where('id', 10)->first();

        $data['vendor'] = Vendor::where('vendor_id',$this->vendor_id)->first();
        $vendor_photo_count = VendorImage::where(['status'=>1,'vendor_id'=>$this->vendor_id])->orderBy('is_logo','asc')->count();
          $data['vendor_photo'] = isset($vendor_photo_count) && $vendor_photo_count?VendorImage::where(['status'=>1,'vendor_id'=>$this->vendor_id])->orderBy('is_logo','asc')->get():[];      
        return view('vendor.vendor_storefront_gallery', ['data'=>$data]);
      }

     /**
      Upload photos   
  
     */
     public function savePhotos(Request $request)  {
      $vendorId =  \Auth::user()->vendor_id;
      if( isset($request->action) && $request->action=='save_gallery') {
          if(count($request->photo_ids_arr)>0)
          {
            for ($i=0;$i<count($request->photo_ids_arr); $i++) {
                $key=$request->photo_ids_arr[$i];
                VendorImage::where(['vendor_id'=>$vendorId,'id'=>$key])->update(["is_logo"=>$request->set_main_img[$key],'img_title'=>$request->img_title[$key] ]);
                try {
                    $vendorObj = Vendor::where('vendor_id',$vendorId)->first();
                    $checkNews = UserNewsletter::where('email_id',$vendorObj->email)->where('status',0)->count();
                    if(!$checkNews)
                        Mail::to($vendorObj->email)->send(new VendorMakeChangesMail($vendorObj->username,$vendorObj->email));
                } catch (\Exception $e) {}
                    
                  //print_r(DB::getQueryLog()); // Show results of log
            }
            return response()->json(['status'=>'success','message'=>'Photo saved successfully.']);
          }

      } else {
      
        $destinationPath = public_path('/vendors/VENDOR_'.$vendorId);
             
         if ($request->hasFile('file')) {
           $file = $request->file('file');
           $vendorImageObj = new VendorImage();
           // foreach($files as $file) {
               $file_name =   time().".".$file->getClientOriginalExtension();
               $file->move($destinationPath , $file_name);
               $vendorImageObj->vendor_id = $vendorId;
               $vendorImageObj->vendor_folder = 'VENDOR_'.$vendorId;
               $vendorImageObj->image = $file_name;
               $vendorImageObj->save();
          //  }
            try {
                $vendorObj = Vendor::where('vendor_id',$vendorId)->first();
                $checkNews = UserNewsletter::where('email_id',$vendorObj->email)->where('status',0)->count();
                if(!$checkNews)
                    Mail::to($vendorObj->email)->send(new VendorMakeChangesMail($vendorObj->username,$vendorObj->email));
            } catch (\Exception $e) {}
        }

        //$data['vendor_photo'] = VendorImage::where(['status'=>1,'vendor_id'=>$vendorId])->orderBy('is_logo','asc')->get();

        //return view('vendor.vendor_storefront_gallery', ['data'=>$data]);
        return response()->json(['status'=>'success','message'=>'Photo saved successfully.']);
      }  

     } 

     public function delete_gallery($id){
        $vendorId =  \Auth::user()->vendor_id;
        $vendor_gallery=VendorImage::find($id);
        if($vendor_gallery->image) {
            @unlink(public_path('/vendors/VENDOR_'.$vendorId.'/'.$vendor_gallery->image));
        }
        if($vendor_gallery->delete()){
            try {
                $vendorObj = Vendor::where('vendor_id',$vendorId)->first();
                $checkNews = UserNewsletter::where('email_id',$vendorObj->email)->where('status',0)->count();
                    if(!$checkNews)
                        Mail::to($vendorObj->email)->send(new VendorMakeChangesMail($vendorObj->username,$vendorObj->email));
            } catch (\Exception $e) {}
          return response()->json(['status'=>'success','message'=>'Photo deleted successfully.']);
        }
        else
          return response()->json(['status'=>'error','message'=>'Something went wrong, please try lator']);  
     }


     /**
     * Show the Video page.
     *
     * @return \Illuminate\Http\Response
     */

      public function get_videos() {

        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId =  \Auth::user()->vendor_id;
        $data['vendor'] = Vendor::where('vendor_id',$this->vendor_id)->first();
       
        $data['vendor_videos']=VendorVideo::where('vendor_id',$vendorId)->orderBy('sort_order','asc')->get();
        return view('vendor.vendor_storefront_videos', ['data'=>$data]);
      }

      /**
      Upload photos   
  
     */
     public function saveVideo(Request $request)  {
   
      $vendorId =  \Auth::user()->vendor_id;
     
      /*$this->validate($request, [
          'file' => 'required',
          // 'pickphotos.*' => 'mimes:jpeg,png,jpg,gif,svg|max:5120'
      ]);*/
       $vendor_video= new VendorVideo();
      $destinationPath = public_path('/vendors/VENDOR_'.$vendorId);
             
         if ($request->hasFile('file')) {
              $file = $request->file('file');
           // foreach($files as $file) {
               $file_name =   time().".".$file->getClientOriginalExtension();
               $file->move($destinationPath , $file_name);
               $vendor_video->vendor_id = $vendorId;
               $vendor_video->vendor_folder = 'VENDOR_'.$vendorId;
               $vendor_video->image = $file_name;
               $vendor_video->video = $file_name;
               $vendor_video->save();
            try {
                $vendorObj = Vendor::where('vendor_id',$vendorId)->first();
                $checkNews = UserNewsletter::where('email_id',$vendorObj->email)->where('status',0)->count();
                if(!$checkNews)
                    Mail::to($vendorObj->email)->send(new VendorMakeChangesMail($vendorObj->username,$vendorObj->email));
            } catch (\Exception $e) {}
          //  }
        }else{
            $this->validate($request, [
              'file' => 'required|url'
            ],
            [
                'file.required' => 'URL field is required !!',
                'file.url' => "Your submitted url is inavlid !!"
            ]);
            $vendor_video->vendor_id = $vendorId;
            $vendor_video->video = $request->file;
            $vendor_video->youtube_id = $this->get_youtube_id_from_url($request->file);
            $vendor_video->status = 'Approved';
            if($vendor_video->save()){
                try {
                    $vendorObj = Vendor::where('vendor_id',$vendorId)->first();
                    $checkNews = UserNewsletter::where('email_id',$vendorObj->email)->where('status',0)->count();
                    if(!$checkNews)
                        Mail::to($vendorObj->email)->send(new VendorMakeChangesMail($vendorObj->username));
                } catch (\Exception $e) {}
                return redirect('videos')->with('success','Successfully added video URL !!');
            }
            else
                return redirect('videos')->with('error','Something went wrong. Please try after some time !!');
        }
        return response()->json(['status'=>'success','message'=>'Video saved successfully.']);
     }
    public function get_youtube_id_from_url($url)
    {
        if (stristr($url,'youtu.be/'))
        {
            preg_match('/(https:|http:|)(\/\/www\.|\/\/|)(.*?)\/(.{11})/i', $url, $final_ID);
            return isset($final_ID[4]) ? $final_ID[4] : '';
        } else {
            @preg_match('/(https:|http:|):(\/\/www\.|\/\/|)(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $IDD);
            return isset($IDD[5]) ? $IDD[5] : '';
        }
    }

     /**
          Edit Video


     */
     public function edit_video($id) {
        $vendorId =  \Auth::user()->vendor_id;
        $video=VendorVideo::where(['id'=>$id,'vendor_id'=>$this->vendor_id ])->first();
        return response()->json(['status'=>'success','video'=>$video]);

     }


     /** Update Video
      
     */
     
     public function update_video(Request $request,$id)  {

        //print_r($request->all());
        //die;
        $vendorId =  \Auth::user()->vendor_id;
        $vendor_video=  VendorVideo::find($id);
        $vendor_video->title=$request->title;
        $vendor_video->description=$request->description;
        $vendor_video->video=$request->video;
        $vendor_video->youtube_id=$this->get_youtube_id_from_url($request->video);
        if($vendor_video->save()){
            try {
                $vendorObj = Vendor::where('vendor_id',$vendorId)->first();
                $checkNews = UserNewsletter::where('email_id',$vendorObj->email)->where('status',0)->count();
                if(!$checkNews)
                    Mail::to($vendorObj->email)->send(new VendorMakeChangesMail($vendorObj->username,$vendorObj->email));
            } catch (\Exception $e) {}
        }
        return response()->json(['status'=>'success','message'=>'Video saved successfully.','video'=>$vendor_video]);



     }  

     public function delete_video($id) {
        $vendorId =  \Auth::user()->vendor_id;
        $vendor_video=VendorVideo::find($id);
        if($vendor_video->video) {
            @unlink(public_path('/vendors/VENDOR_'.$vendorId.'/'.$vendor_video->video));
        }
   
        if($vendor_video->delete()){
            try {
                $vendorObj = Vendor::where('vendor_id',$vendorId)->first();
                $checkNews = UserNewsletter::where('email_id',$vendorObj->email)->where('status',0)->count();
                if(!$checkNews)
                    Mail::to($vendorObj->email)->send(new VendorMakeChangesMail($vendorObj->username));
            } catch (\Exception $e) {}
          return response()->json(['status'=>'success','message'=>'Video deleted successfully.']);
        }
        else
          return response()->json(['status'=>'error','message'=>'Something went wrong, please try lator']);  
     }


     /**
     * Show the Avalibility page.
     *
     * @return \Illuminate\Http\Response
     */
        
      public function get_availability() {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['vendor'] = Vendor::where('vendor_id',$this->vendor_id)->first();      

        return view('vendor.vendor_storefront_availability', ['data'=>$data]);
      }


     /**
     * Show the Events page.
     *
     * @return \Illuminate\Http\Response
     */

     public function get_events() {
      
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId =  \Auth::user()->vendor_id;
        $data['vendor'] = Vendor::where('vendor_id',$this->vendor_id)->first();
       

        $data['vendor_events']=VendorEvent::join('event_types','event_types.id','=','vendor_events.event_type_id')->select('vendor_events.*','event_types.name as event_type')->where('vendor_id',$vendorId)->get();


        return view('vendor.vendor_storefront_events', ['data'=>$data]);
     }


    


     /**
     * Show the Add Events page.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_eventsnew() {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId =  \Auth::user()->vendor_id;
        $data['vendor'] = Vendor::where('vendor_id',$this->vendor_id)->first();
        $event_types=DB::table('event_types')->where('status',1)->get();
        return view('vendor.vendor_storefront_add_events', ['data'=>$data,'event_types'=>$event_types]);
    }

    /**
    Save new event
    */
    public function save_eventsnew(Request $request)
    {
        $vendorId = \Auth::user()->vendor_id;
        $rules = [
            'event_name' => 'required|max:100',
            'event_type'  => 'required',
            'event_start_date'     => 'required',
            'event_start_time'     => 'required',
            'event_end_date'     => 'required',
            'event_end_time'     => 'required',
            'event_description' => 'required',
            /*'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',*/
        ];
        if($request->hasFile('image')) {
            $rules= ['image' => 'max:2048'];
        }
        if($request->event_start_date> $request->event_end_date) {
            $rules= ['event_start_date' => 'Start date should not be greater than end date'];
        }
        $validator = Validator::make($request->all(),$rules);
        if ($validator->passes()) {
            $start_date_arr=explode("/",$request->event_start_date); 
            $end_date_arr=explode("/",$request->event_end_date);        
            $vendor_event = new VendorEvent();
            $vendor_event->vendor_id=$vendorId;
            $vendor_event->event_name=$request->event_name;
            $vendor_event->event_start_date=$start_date_arr[2].'-'.$start_date_arr[1].'/'.$start_date_arr[0];
            $vendor_event->event_end_date=$end_date_arr[2].'-'.$end_date_arr[1].'/'.$end_date_arr[0];
            $vendor_event->event_type_id=$request->event_type;
            $vendor_event->event_start_time=$request->event_start_time;
            $vendor_event->event_end_time=$request->event_end_time;
            $vendor_event->description=$request->event_description;
            $vendor_event->city_id=$request->event_city;
            $vendor_event->address=$request->event_address;
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = uniqid() . '_' . time(). '.' . $image->getClientOriginalExtension();
                $image->move(public_path('vendors/VENDOR_'.$vendorId.'/'), $filename);
                $vendor_event->image=$filename;
            }
            $vendor_event->status='Pending';
            $vendor_event->save();
            try {
                $vendorObj = Vendor::where('vendor_id',$vendorId)->first();
                $checkNews = UserNewsletter::where('email_id',$vendorObj->email)->where('status',0)->count();
                if(!$checkNews)
                    Mail::to($vendorObj->email)->send(new VendorMakeChangesMail($vendorObj->username,$vendorObj->email));
            } catch (\Exception $e) {}
            return response()->json(['status'=>'success','message'=>'Event added successfully.']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function edit_events($id) {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId =  \Auth::user()->vendor_id;
        $data['vendor'] = Vendor::where('vendor_id',$this->vendor_id)->first();
        
        $data['vendor_event']=VendorEvent::join('event_types','event_types.id','=','vendor_events.event_type_id')->leftjoin('cities','cities.id','=','vendor_events.city_id')->leftjoin('states','states.id','=','cities.state_id')->select('vendor_events.*','cities.name as city','states.name as state')->where('vendor_events.id',$id)->where('vendor_id',$vendorId)->first();
          $event_types=DB::table('event_types')->where('status',1)->get(); 

        //  print_r($data['vendor_event']);die;   
        return view('vendor.vendor_storefront_edit_events', ['data'=>$data,'event_types'=>$event_types]);
     }

     /**
     Save new event
     */  
     public function update_eventsnew(Request $request,$id)
     {
       $vendorId =  \Auth::user()->vendor_id;
       $rules=[
              'event_name'         => 'required|max:100',
              'event_type'         => 'required',
              'event_start_date'   => 'required',
              'event_start_time'   => 'required',
              'event_end_date'     => 'required',
              'event_end_time'     => 'required',
              'event_description'  => 'required',
              /*'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',*/
              ];
         if($request->hasFile('image')) {
           
           $rules= ['image' => 'max:2048'];
         }
         if($request->event_start_date> $request->event_end_date) {
           
           $rules= ['event_start_date' => 'Start date should not be greater than end date'];
         } 
         $validator = Validator::make($request->all(),$rules);   
       if ($validator->passes()) {
              $start_date_arr=explode("/",$request->event_start_date); 
              $end_date_arr=explode("/",$request->event_end_date);        
              $vendor_event = VendorEvent::find($id);

              $vendor_event->vendor_id=$vendorId;
              $vendor_event->event_name=$request->event_name;
             
              $vendor_event->event_start_date=$start_date_arr[2].'-'.$start_date_arr[1].'/'.$start_date_arr[0];   
            
              $vendor_event->event_end_date=$end_date_arr[2].'-'.$end_date_arr[1].'/'.$end_date_arr[0];
              $vendor_event->event_type_id=$request->event_type;
              $vendor_event->event_start_time=$request->event_start_time;
              $vendor_event->event_end_time=$request->event_end_time;
              $vendor_event->description=$request->event_description;
              $vendor_event->city_id=$request->event_city;
              $vendor_event->address=$request->event_address;
              if($request->hasFile('image')) {
                if($vendor_event->image) {
                  unlink(public_path('/vendors/VENDOR_'.$vendorId.'/'.$vendor_event->image));
                }
                $image = $request->file('image');
                $filename = uniqid() . '_' . time(). '.' . $image->getClientOriginalExtension();
                $image->move(public_path('vendors/VENDOR_'.$vendorId.'/'), $filename);
                $vendor_event->image=$filename;
              }
              //$vendor_event->status='Pending';
            $vendor_event->save();
            try {
                $vendorObj = Vendor::where('vendor_id',$vendorId)->first();
                $checkNews = UserNewsletter::where('email_id',$vendorObj->email)->where('status',0)->count();
                if(!$checkNews)
                    Mail::to($vendorObj->email)->send(new VendorMakeChangesMail($vendorObj->username,$vendorObj->email));
            } catch (\Exception $e) {}
            return response()->json(['status'=>'success','message'=>'Event saved successfully.']);
          }
          return response()->json(['error'=>$validator->errors()->all()]);
     }

     public function event_remove_img($id) {
        $vendorId =  \Auth::user()->vendor_id;
        $vendor_event=VendorEvent::find($id);
        if($vendor_event->image) {
            unlink(public_path('/vendors/VENDOR_'.$vendorId.'/'.$vendor_event->image));
        }
        $vendor_event->image='';
        $vendor_event->save();
        return response()->json(['status'=>'success','message'=>'Image removed.']);
     }

     public function event_delete($id)
     {
        $vendorId = \Auth::user()->vendor_id;
        $vendor_event = VendorEvent::find($id);
        if($vendor_event->image) {
            unlink(public_path('/vendors/VENDOR_'.$vendorId.'/'.$vendor_event->image));
        }
        $vendor_event->image = '';
        $vendor_event->delete();
        try {
            $vendorObj = Vendor::where('vendor_id',$vendorId)->first();
            $checkNews = UserNewsletter::where('email_id',$vendorObj->email)->where('status',0)->count();
            if(!$checkNews)
                Mail::to($vendorObj->email)->send(new VendorMakeChangesMail($vendorObj->username,$vendorObj->email));
        } catch (\Exception $e) {}
        return response()->json(['status'=>'success','message'=>'Event deleted successfully.']);
     }

     /**
     * Show the Owner page.
     *
     * @return \Illuminate\Http\Response
     */
     public function get_owners() {

        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['vendor'] = Vendor::where('vendor_id',$this->vendor_id)->first();
        $data['team_members']=VendorTeammember::where(['vendor_id'=>$this->vendor_id ] )->get();

        return view('vendor.vendor_storefront_owners', ['data'=>$data]);
     }

     /**
     * Show the Add New Team Member page.
     *
     * @return \Illuminate\Http\Response
     */

     public function get_ownersnew() {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['vendor'] = Vendor::where('vendor_id',$this->vendor_id)->first();
              
        return view('vendor.vendor_storefront_add_owners', ['data'=>$data]);
     }

     public function edit_owner($id) {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId =  \Auth::user()->vendor_id;
        $data['vendor'] = Vendor::where('vendor_id',$vendorId)->first();
        
        $data['vendor_tm']=VendorTeammember::where(['id'=>$id ] )->first();
       
        return view('vendor.vendor_storefront_edit_owners', ['data'=>$data]);
     }

     /**
     Save new team member 
     */  
     public function save_ownersnew(Request $request) {


       // dd($request->all());
       $vendorId =  \Auth::user()->vendor_id;
        $str = (
            strip_tags(
                preg_replace(
                    '/\s+/', 
                    '', 
                    str_replace('&nbsp;',"", $request->biography)
                )
            )
        );
        $request->merge(['biography_content' => $str]);
       $validator = Validator::make($request->all(), [
              'firstname' => 'required',
              'position'  => 'required',
              'email'     => 'email',
            //   'biography' => 'required',
              'image' => 'required',
              'biography_content' => 'nullable|max:500',
              ]
          );

       if ($validator->passes()) {
                       
                                   
              $vendor_teammember = new VendorTeammember();

              $vendor_teammember->vendor_id=$vendorId;
              $vendor_teammember->firstname=$request->firstname;
              $vendor_teammember->lastname=$request->lastname;
              $vendor_teammember->position=$request->position;
              $vendor_teammember->email=$request->email;
              $vendor_teammember->biography=$request->biography;
              
              
              if($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = uniqid() . '_' . time(). '.' . $image->getClientOriginalExtension();
                $image->move(public_path('vendors/VENDOR_'.$vendorId.'/'), $filename);
                $vendor_teammember->photo=$filename;
              }
            if(!empty($request->input('image')) && strlen($request->input('image')) > 6) {
                $featuredImage = $request->input('image');
                if(preg_match('/data:image/', $featuredImage)) {
                    list($type, $featuredImage) = explode(';', $featuredImage);
                    list(, $featuredImage)      = explode(',', $featuredImage);
                    $featuredImage = base64_decode($featuredImage);
                    $image_name = uniqid() . '_' . time(). '.' . '.png';
                    $path = public_path('vendors/VENDOR_'.$vendorId);
                    if (!File::exists($path)){
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }
                    file_put_contents($path. '/' . $image_name, $featuredImage);
                    $input['image'] = $image_name;
                    $vendor_teammember->photo = $input['image'];
                }
            }
              
              $vendor_teammember->status='Pending';
             
              $vendor_teammember->save();
            try {
                $vendorObj = Vendor::where('vendor_id',$vendorId)->first();
                $checkNews = UserNewsletter::where('email_id',$vendorObj->email)->where('status',0)->count();
                if(!$checkNews)
                    Mail::to($vendorObj->email)->send(new VendorMakeChangesMail($vendorObj->username,$vendorObj->email));
            } catch (\Exception $e) {}
            return response()->json(['status'=>'success','message' => 'Team member added successfully.']);
          }

          return response()->json(['error' => $validator->errors()->all()]);


     }


      /**
          Update team member 
     */  
     public function update_owner(Request $request,$id) {

        $str = (
            strip_tags(
                preg_replace(
                    '/\s+/', 
                    '', 
                    str_replace('&nbsp;',"", $request->biography)
                )
            )
        );
        $request->merge(['biography_content' => $str]);
       // dd($request->all());
       $vendorId =  \Auth::user()->vendor_id;
       $rules=[
              'firstname' => 'required',
              'position'  => 'required',
              'email'     => 'email',
            //   'biography' => 'required',
              'biography_content' => 'nullable|max:500'
              /*'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',*/
              ];
         /*if($request->hasFile('image')) {
           
           $rules= ['image' => 'max:2048'];
         }*/
       $validator = Validator::make($request->all(),$rules);
       
       if ($validator->passes()) {
            
                                             
              $vendor_teammember = VendorTeammember::find($id);
      
              $vendor_teammember->vendor_id=$vendorId;
              $vendor_teammember->firstname=$request->firstname;
              $vendor_teammember->lastname=$request->lastname;
              $vendor_teammember->position=$request->position;
              $vendor_teammember->email=$request->email;
              $vendor_teammember->biography=$request->biography;
              
              
              if($request->hasFile('image')) {
                unlink(public_path('/vendors/VENDOR_'.$vendorId.'/'.$vendor_teammember->photo));
                $image = $request->file('image');
                $filename = uniqid() . '_' . time(). '.' . $image->getClientOriginalExtension();
                $image->move(public_path('vendors/VENDOR_'.$vendorId.'/'), $filename);
                $vendor_teammember->photo=$filename;
              }
            if(!empty($request->input('image')) && strlen($request->input('image')) > 6) {
                $featuredImage = $request->input('image');
                if(preg_match('/data:image/', $featuredImage)) {
                    list($type, $featuredImage) = explode(';', $featuredImage);
                    list(, $featuredImage)      = explode(',', $featuredImage);
                    $featuredImage = base64_decode($featuredImage);
                    $image_name = uniqid() . '_' . time(). '.' . '.png';
                    $path = public_path('vendors/VENDOR_'.$vendorId);
                    if (!File::exists($path)){
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }
                    file_put_contents($path. '/' . $image_name, $featuredImage);
                    $input['image'] = $image_name;
                    $vendor_teammember->photo = $input['image'];
                }
            }
                                         
              $vendor_teammember->save();
            try {
                $vendorObj = Vendor::where('vendor_id',$vendorId)->first();
                $checkNews = UserNewsletter::where('email_id',$vendorObj->email)->where('status',0)->count();
                if(!$checkNews)
                    Mail::to($vendorObj->email)->send(new VendorMakeChangesMail($vendorObj->username,$vendorObj->email));
            } catch (\Exception $e) {}
              return response()->json(['status'=>'success','message'=>'Team member saved successfully.']);
          } else {          

            return response()->json(['error'=>$validator->errors()->all()]);

          }
  
     }


     public function delete_owner($id) {
       
        $vendorId =  \Auth::user()->vendor_id;
        $vendor_tm=VendorTeammember::find($id);
        if($vendor_tm->photo) {
            unlink(public_path('/vendors/VENDOR_'.$vendorId.'/'.$vendor_tm->photo));
        }

        $vendor_tm->delete();
        try {
            $vendorObj = Vendor::where('vendor_id',$vendorId)->first();
            $checkNews = UserNewsletter::where('email_id',$vendorObj->email)->where('status',0)->count();
            if(!$checkNews)
                Mail::to($vendorObj->email)->send(new VendorMakeChangesMail($vendorObj->username));
        } catch (\Exception $e) {}
        if($vendor_tm)
          return response()->json(['status'=>'success','message'=>'Team member deleted successfully.']);
        else
          return response()->json(['status'=>'error','message'=>'Something went wrong, please try lator']);  
     }


     /**
     * Show the Social Media page.
     *
     * @return \Illuminate\Http\Response
     */

     public function get_sociales() {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId =  \Auth::user()->vendor_id;
        $data['vendor'] = Vendor::where('vendor_id',$this->vendor_id)->first();

       
        $data['sm']=VendorSocialMedia::where([ 'status'=>1,'vendor_id'=>$vendorId ] )->first();
        $data['social'] = DB::select(DB::raw("SELECT *,social_media.id as main_id FROM social_media LEFT JOIN  business_social_media ON (business_social_media.social_media_id = social_media.id AND business_social_media.vendor_id = '$vendorId')"));
        // dd($data['social']);
        return view('vendor.vendor_storefront_socialmedia', ['data'=>$data]);
     }

     public function update_social_media(Request $request)
     {
        $vendorId =  \Auth::user()->vendor_id;
        $social_media = SocialMedia::all();
        BusinessSocialMedia::where('vendor_id',$vendorId)->delete();
        $status = true;
        foreach ($social_media as $key => $value) {
            $this->validate($request, [
                   $value->slug => 'nullable|url'
            ]);
            $social = new BusinessSocialMedia;
            $social->vendor_id = $vendorId;
            $social->social_media_id = $value->id;
            $social->link = $request->input($value->slug);
            $status = $social->save();
            if(!$status) break;
        }
        if($status){
            try {
                $vendorObj = Vendor::where('vendor_id',$vendorId)->first();
                $checkNews = UserNewsletter::where('email_id',$vendorObj->email)->where('status',0)->count();
                if(!$checkNews)
                    Mail::to($vendorObj->email)->send(new VendorMakeChangesMail($vendorObj->username,$vendorObj->email));
            } catch (\Exception $e) {}
          return redirect()->back()->with('success','Successfully updated social links !!');
        }
        else
          return redirect()->back()->with('error','Something went wrong. Please try again later !!');
     }


     public function save_social_media(Request $request) {

       
        $vendorId =  \Auth::user()->vendor_id;
        if(isset($request->update_sm_id) && $request->has('update_sm_id')){
          $vendor_sm=VendorSocialMedia::find($request->update_sm_id);
        }else{
          $vendor_sm=new VendorSocialMedia();

        }
        
        $vendor_sm->vendor_id=$vendorId;
        $vendor_sm->facebook_url=$request->facebook_url;
        $vendor_sm->instagram_url=$request->instagram_url;
        $vendor_sm->twitter_url=$request->twitter_url;
        $vendor_sm->pinterest_url=$request->pinterest_url;
        $vendor_sm->status=1;
        $vendor_sm->save();

        if($vendor_sm)
          return response()->json(['status'=>'success','message'=>'Social media saved successfully.','sm'=>$vendor_sm]);
        else
          return response()->json(['status'=>'error','message'=>'Something went wrong, please try lator']);  


      //Your social media information is now up to date
     }
    public function imagesForVendor(Request $request)
    {
        $vendorObj = Vendor::where('vendor_id',$this->vendor_id)->first();
        if(!empty($request->input('image')) && strlen($request->input('image')) > 6) {
            $featuredImage = $request->input('image');
            if(preg_match('/data:image/', $featuredImage)) {
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time() . '_profile_'.mt_rand(1000,9999) . '.png';
                $path = public_path() . '/vendors/VENDOR_' . $vendorObj->vendor_id;
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path. '/' . $image_name, $featuredImage);
                $vendorImageObj = new VendorImage;
                $vendorImageObj->vendor_id = $vendorObj->vendor_id;
                $vendorImageObj->vendor_folder = 'VENDOR_'.$vendorObj->vendor_id;
                $vendorImageObj->image = $image_name;
                $vendorImageObj->save();
                return response()->json(['message' => 'Successfully uploaded your image !'],200);
            }
            else
                return response()->json(['message' => 'This is not an image'],404);
        } else
            return response()->json(['message' => 'Image not found in your request !'],404);
    }
}
