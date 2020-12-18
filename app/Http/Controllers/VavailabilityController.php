<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserChangePassword;
use App\Mail\EnquiryReply;
use App\Page;
use App\User;
use App\Vendor;
use App\VendorImage;
use App\VendorCompany;
use App\VendorRating;
use App\ReviewRequest;
use Carbon\Carbon;
use App\ContactEnquiryReply;
use App\VendorLocation;
use App\VendorFaq;
use App\VendorPromotion;
use App\VendorDeal;
use App\VendorVideo;
use App\VendorSocialMedia;
use App\VendorTeammember;
use App\VendorEvent;
use App\Category;
use App\AvailabilitySetting;
use App\AvailabilityEvent;
use App\AvailabilityDateStatus;
use DB;
use Auth;
use View;
use Input;
use Illuminate\Contracts\Auth\Guard;

class VavailabilityController extends Controller
{
    public $vendor_img;
    public $deals;
    public $photos;
    public $videos;
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
            $this->vendor_progress_percentage = 10;
            $this->vendor_img = Vendor::with(['image_data'=>function($q) { $q->where(['is_logo'=>1,'status'=>1]); }])->where('vendors.vendor_id',$this->vendor_id)->first();
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
            //// for vendor progress basic info....
            if($this->vendor_img->contact_person != '' && $this->vendor_img->email != '' && $this->vendor_img->step_completed == '4') {
                $this->vendor_progress_basic = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_basic = 'no';
            }
            //// for vendor uploaded pics info....
            if(count($this->vendor_img->image_data) > 4) {
                $this->vendor_progress_images = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_images = 'no';
            }
            //// for vendor high-quality pics info....
            if($this->photos > 9) {
                $this->vendor_progress_tenHDimages = 'yes';
                $this->vendor_progress_percentage += 20;
            } else {
                $this->vendor_progress_tenHDimages = 'no';
            }
            //// for vendor videos info....
            if($this->videos > 0) {
                $this->vendor_progress_videos = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_videos = 'no';
            }
            //// for vendor deal info....
            if($this->deals > 0) {
                $this->vendor_progress_deals = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_deals = 'no';
            }
            //// for vendor faq's info....
            if($vendor_faqs > 0) {
                $this->vendor_progress_faqs = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_faqs = 'no';
            }
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

    public function get_availability(Request $request)
    {
        $year                = Input::get('year', false) ? : date('Y');
        $data['year']        = $year;
        $month               = Input::get('month', false) ? : date('m');
        $data['month']       = $month;
        $tab                 = Input::get('tab', false);
        if(@$tab != '') {
            $data['tab']     = $tab;
        } else {
            $data['tab']     = '1';
        }
        $data['filter']      = Input::get('filter', false) ? : '3';
        $showOnlyWeekendDays = Input::get('showOnlyWeekendDays', false);
        $showOnlyWeekends    = Input::get('showOnlyWeekends', false);
        if($showOnlyWeekendDays == '' || $showOnlyWeekendDays == null){ $showOnlyWeekendDays = '1'; }
        if($showOnlyWeekendDays == 1 && $showOnlyWeekends == ''){ $showOnlyWeekends = '1'; }
        $data['showOnlyWeekendDays'] = $showOnlyWeekendDays;
        $data['showOnlyWeekends']    = $showOnlyWeekends;
        $yrMon = $year.'-'.$month;
        $vendorId = \Auth::user()->vendor_id;
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['category'] = Category::where('status','=','1')->get();
        $data['avlSetting'] = AvailabilitySetting::where('vendor_id',$vendorId)->first();
        $data['avlStatus'] = AvailabilityDateStatus::where('vendor_id',$vendorId)->where('date','>=',$yrMon.'-01')->where('date','<=',$yrMon.'-31')->get();
        $data['avlEvent'] = AvailabilityEvent::leftJoin('categories','categories.id','availability_events.type')->select('availability_events.*','categories.title')->where('availability_events.vendor_id',$vendorId)->get();
        for($dte = 1; $dte <= 31; $dte++) {
            if($dte < 10) {
                $data[$year.''.$month.'0'.$dte] = AvailabilityEvent::where('vendor_id','=',$vendorId)->where('date',$yrMon.'-0'.$dte)->count();
            } else {
                $data[$year.''.$month.''.$dte] = AvailabilityEvent::where('vendor_id','=',$vendorId)->where('date',$yrMon.'-'.$dte)->count();
            }
        }
        $data['yearNum'] = AvailabilityEvent::where('vendor_id','=',$vendorId)->where('date','>=',$year.'-01-01')->where('date','<=',$year.'-12-31')->count();
        $data['monthNum'] = AvailabilityEvent::where('vendor_id','=',$vendorId)->where('date','>=',$year.'-'.$month.'-01')->where('date','<=',$year.'-'.$month.'-31')->count();
        $data['vendorData'] = Vendor::with('company_data', 'category_data', 'image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        if($request->ajax()){
            return view('vendor.availability.ajax_storefront_availability', ['data'=>$data]);
        } else {
            return view('vendor.vendor_storefront_availability', ['data'=>$data]);
        }
    }

    public function fetch_contacts($bDate=null,$search=null)
    {
        $newDate = date_format(date_create($bDate),'Y-m-d');
        if($search == 'nothing' || $search == null) {
            $bookData = User::where('status','=','1')->get();
        } else {
            $bookData = User::where('status','=','1')->where('name','LIKE','%'.$search.'%')->get();
        }
        $html = "<input class='app-client-name' type='hidden'>";
        $html .= "<input class='app-client-mail' type='hidden'>";
        $html .= "<input class='app-client-phone' type='hidden'>";
        $html .= "<input class='app-client-date' type='hidden' value='".$newDate."'>";
        foreach($bookData as $key => $bVal) {
            $html .= "<label class='app-client-container availabilityClientModal__row' data-name='".$bVal->name."' data-mail='".$bVal->email."' data-phone='".$bVal->phone."'><div class='input-group-line input-group-line--noMargin input-group-line--transparent pure-u mr5'><label><input class='app-not-icheck app-client-checkbox' type='radio'><span></span></label></div><span class='availabilityClientModal__name'>".$bVal->name."</span><span class='availabilityClientModal__date'>".$bVal->event_date."</span></label>";
        }
        return $html;
    }

    public function save_events(Request $request)
    {
        $userId = '';
        $vendorId = \Auth::user()->vendor_id;
        $userData = User::where('email',$request->email)->first();
        if(@$userData->id != '') {
            $userId = $userData->id;
        }
        $updateId = $request->updateId;
        $evntDate = date_format(date_create($request->date),'Y-m-d');
        if($updateId != '') {
            $avlEvent = AvailabilityEvent::find($updateId);
        } else {
            $avlEvent = new AvailabilityEvent();
        }
        $avlEvent->vendor_id  = $vendorId;
        $avlEvent->user_id    = $userId;
        $avlEvent->name       = $request->name;
        $avlEvent->surname    = $request->surname;
        $avlEvent->email      = $request->email;
        $avlEvent->phone      = $request->phone;
        $avlEvent->date       = $evntDate;
        $avlEvent->time       = $request->time;
        $avlEvent->city       = $request->city;
        $avlEvent->type       = $request->type;
        $avlEvent->customType = $request->customType;
        $avlEvent->save();
        if($avlEvent->id) {
            $status = '0';
            $avlSetting = AvailabilitySetting::where('vendor_id','=',$vendorId)->first();
            $evntCount = AvailabilityEvent::where('vendor_id',$vendorId)->where('date',$evntDate)->count();
            if($avlSetting->wed_per_day <= $evntCount) {
                $dStatus = AvailabilityDateStatus::where('vendor_id',$vendorId)->where('date',$evntDate)->first();
                if(@$dStatus->id) {
                    $date_status = AvailabilityDateStatus::find($dStatus->id);
                } else {
                    $date_status = new AvailabilityDateStatus();
                }
                $date_status->vendor_id = $vendorId;
                $date_status->date      = $evntDate;
                $date_status->status    = $status;
                $date_status->save();
            }
            echo 'done';
        }
    }

    public function edit_events($id=null)
    {
        $vendorId = \Auth::user()->vendor_id;
        return $eventData = AvailabilityEvent::leftJoin('categories','categories.id','availability_events.type')->select('availability_events.*','categories.title')->where('availability_events.id','=',$id)->where('availability_events.vendor_id','=',$vendorId)->first();
    }

    public function delete_events($id=null)
    {
        $eventData = AvailabilityEvent::where('id',$id)->delete();
        return 'done';
    }

    public function availabilitySetting(Request $request)
    {
        $vendorId = \Auth::user()->vendor_id;
        $availId = $request->availId;
        if($availId != '') {
            $availSetting = AvailabilitySetting::find($availId);
        } else {
            $availSetting = new AvailabilitySetting();
        }
        $availSetting->vendor_id   = $vendorId;
        $availSetting->goal_year1  = date('Y');
        $availSetting->target1     = $request->yearGoal0;
        $availSetting->goal_year2  = date('Y')+1;
        $availSetting->target2     = $request->yearGoal1;
        $availSetting->wed_per_day = $request->wedPerDay;
        $availSetting->monday      = $request->MonDay;
        $availSetting->tuesday     = $request->TueDay;
        $availSetting->wednesday   = $request->WedDay;
        $availSetting->thursday    = $request->ThuDay;
        $availSetting->friday      = $request->FriDay;
        $availSetting->saturday    = $request->SatDay;
        $availSetting->sunday      = $request->SunDay;
        $availSetting->auto_update = $request->auto_update;
        $availSetting->save();
        if($availSetting->id) {
            return $availSetting;
        }
    }

    public function calendar_status($cDate=null,$actClass=null)
    {
        if($actClass == 'false') {
            $status = '1';
        } else if($actClass == 'true') {
            $status = '0';
        }
        $vendorId = \Auth::user()->vendor_id;
        $dStatus = AvailabilityDateStatus::where('vendor_id',$vendorId)->where('date',$cDate)->first();
        if(@$dStatus->id) {
            if($dStatus->status == 0) {
                $status = '1';
            } else if($dStatus->status == 1) {
                $status = '0';
            }
            $date_status = AvailabilityDateStatus::find($dStatus->id);
        } else {
            $date_status = new AvailabilityDateStatus();
        }
        $date_status->vendor_id = $vendorId;
        $date_status->date      = $cDate;
        $date_status->status    = $status;
        $date_status->save();
        if($date_status->id) {
            echo 'done';
        }
    }
}