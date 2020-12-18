<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserChangePassword;
use App\Mail\EnquiryReply;
use App\Mail\BlogTipsMail;
use App\Mail\SubmittingBlogMail;
use App\Mail\CommunityGuideLineMail;
use App\Page;
use App\Vendor;
use App\VendorDeal;
use App\VendorVideo;
use App\VendorFaq;
use App\Category;
use App\User;
use App\UserBookedVendor;
use App\UserNewsletter;
use App\VendorImage;
use App\VendorCompany;
use App\VendorRating;
use Carbon\Carbon;
use DB;
use Session;
use Input;
use Auth;
use File;
use App\ContactEnquiryReply;
use App\VendorLocation;
use App\ReviewRequest;
use App\ReviewTemplate;
use App\ReviewReply;
use App\BlogCategory;
use App\BlogPost;
use App\Mail\ReviewRequestMail;
use View;

class VreviewController extends Controller
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
    public function __construct()
    {
        $this->middleware('auth:vendor');
        $this->middleware(function (Request $request, $next) {
            $this->vendor_id = Auth::id(); // you can access user id here
            $this->vendor_progress_percentage = 10;
            $this->vendor_img = Vendor::with(['image_data'=>function($q) { $q->where([/*'is_logo'=>1,*/'status'=>1]); }])->where('vendors.vendor_id',$this->vendor_id)->first();
           $this->deals = VendorDeal::join('deal_types','deal_types.id','=','vendor_deals.deal_type_id')
                                          ->select('vendor_deals.id','vendor_deals.name as deal_name','vendor_deals.photo','vendor_deals.status','deal_types.name as type','vendor_deals.expiry_date as end_date')
                                          ->where('vendor_id',$this->vendor_id)->count();
            $this->photos = VendorImage::where(['status'=>1,'vendor_id'=>$this->vendor_id])->orderBy('is_logo','asc')->count();
            $this->videos = VendorVideo::where('vendor_id',$this->vendor_id)->orderBy('sort_order','asc')->count();
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
            return $next($request);
        });
    }

    /**
    * show dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $vendorId =  \Auth::user()->vendor_id;
        $data['ratingData'] = VendorRating::leftJoin('vendor_review_reply as vrr','vrr.rating_id','=','vendor_ratings.id')
                            ->select('vendor_ratings.*','vrr.reply_text','vrr.status as rStatus','vrr.reply_image','vrr.created_at as createDate')
                            ->where('vendor_ratings.vendor_id',$vendorId)->where('vendor_ratings.status','1')->get();
        $data['userData'] = \Auth::user();
        $data['companyData'] = \App\CompanySetting::select('phone_number')->where('id',1)->first();
        $data['vendorData'] = Vendor::with('company_data', 'category_data', 'image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['review'] = \App\VendorRating::where('vendor_id',$vendorId)->orderBy('id','desc')->get()->toArray();
        $data['bookData'] = UserBookedVendor::select('users.*')->leftJoin('users','users.id','=','user_booked_vendors.user_id')
                    ->where('user_booked_vendors.vendor_id','=',$vendorId)->where('users.status','=','1')
                    ->where('user_booked_vendors.book_status','=',6)->groupBy('user_booked_vendors.user_id')->get();
        $data['reviewTemplate'] = ReviewTemplate::where('vendor_id','=',$vendorId)->get();
        $data['reviewRequest'] = ReviewRequest::where('vendor_id','=',$vendorId)->get();
        $data['pendingRequest'] = ReviewRequest::where('vendor_id','=',$vendorId)->where('request_status','0')->get();
        $data['withoutPicRequest'] = ReviewRequest::where('vendor_id','=',$vendorId)->where('profile_pic','0')->get();
        $data['allData'] = User::where('status','=','1')->get();

        $homeVendors = DB::table('vendors as VE')->select('VC.business_name','VC.business_name_slug',
            DB::raw('(select CASE WHEN CTT.slug IS NULL THEN CT.slug ELSE CONCAT(CTT.slug,"/",CT.slug) END as full_slug from categories AS CT left join categories as CTT ON CT.parent_id = CTT.id where CT.id = VE.cat_id) as full_slug'),
            DB::raw('(select title from categories CT1 where CT1.id = VE.cat_id) as cat'))
        ->leftJoin('vendor_companies as VC','VE.vendor_id','=','VC.vendor_id')
        ->where('VE.status','=','1')
        ->where('VE.vendor_id', '=', $vendorId)->get()->toArray();

        $data['venderPageslug'] = $homeVendors;

        return view('vendor.reviews',['data'=>$data]);
    }

    public function getTemplate($id)
    {
        return $reviewTemplate = ReviewTemplate::where('id',$id)->first();
    }

    public function getSearchNameEmail($search=null)
    {
        $bookData = User::where('status','=','1')->where('name','LIKE','%'.$search.'%')->orWhere('email','LIKE','%'.$search.'%')->get();
        $html = "";
        foreach($bookData as $key => $bVal) {
            $html .= "<li class='name_email' data-value='".$bVal->name.'--'.$bVal->email."'><b>".$bVal->name."</b> ".$bVal->email."</li>";
        }
        return $html;
    }

    public function getSearchClients($search=null)
    {
        $bookData = User::where('status','=','1')->where('name','LIKE','%'.$search.'%')->orWhere('email','LIKE','%'.$search.'%')->orWhere('phone','LIKE','%'.$search.'%')->get();
        $html = "";
        foreach($bookData as $key => $bVal) {
            $html .= "<div class='importBookingRow app-import-booking-row rctChecklistTasks__item pt10 pb10'>
                    <div class='app-checklist-tasks-item-checkBox rctChecklistTasks__checkBox'>
                        <a class='rctChecklistTasks__checkBoxLink' data-name='".$bVal->name."' data-mail='".$bVal->email."'>
                            <i class='icon-tools icon-tools-checkbox-grey'></i>
                        </a>
                    </div>
                    <div class='rctChecklistTasks__description'>
                        <p class='rctChecklistTasks__title'> ".$bVal->name." </p>
                        <span class='rctChecklistTasks__tag'> ".$bVal->email." </span>
                    </div>
                    <div class='importBookingRow__date'> Wedding: ".date('d/m/Y', strtotime($bVal->event_date))." </div>
                </div>";
        }
        return $html;
    }

    public function sendRequestAgain($id=null)
    {
        $vendorId =  \Auth::user()->vendor_id;
        $vendorData = Vendor::where('vendor_id',$vendorId)->first();
        $vendorCompany = VendorCompany::where('vendor_id',$vendorId)->first();
        $vendorImage = VendorImage::where('vendor_id',$vendorId)->where('status','1')->where('is_logo','1')->first();
        $reviewData = ReviewRequest::where('id',$id)->first();
        if($id) {
            $review_cc = $vendorData->email;
            $vendorLogo = url('/public/vendors').'/'.@$vendorImage->vendor_folder.'/'.@$vendorImage->image;
            $vendorName = $vendorData->contact_person;
            $userName = $reviewData->requester_name;
            $messages = nl2br($reviewData->requester_message);
            $reviewLink = $reviewData->vendor_url;
            $baseUrl = url('/');
            $address = $vendorCompany->address.' '.$vendorCompany->city;
            $subject = 'Review '.$vendorData->contact_person;
            $pageName = 'review_request_mail';
            $checkNews = UserNewsletter::where('email_id',$reviewData->requester_email)->where('status',0)->count();
            try {
                if(!$checkNews)
                    Mail::to($reviewData->requester_email)->send(new ReviewRequestMail($review_cc, $vendorLogo, $vendorName, $userName, $messages, $reviewLink, $baseUrl, $address, $subject, $pageName,$reviewData->requester_email));
            } catch (\Exception $e) {}

            ////// Update row after mail......
            $reviewRequest = ReviewRequest::find($id);
            $reviewRequest->created_at    = date('Y-m-d H:i:s');
            $reviewRequest->request_count = ($reviewData->request_count +1);
            $reviewRequest->save();
            if($reviewRequest->id) {
                return 'done';
            }
        }
    }

    public function addProfilePicture(Request $request)
    {
        $vendorId =  \Auth::user()->vendor_id;
        $vendorData = Vendor::where('vendor_id',$vendorId)->first();
        $vendorCompany = VendorCompany::where('vendor_id',$vendorId)->first();
        $vendorImage = VendorImage::where('vendor_id',$vendorId)->where('status','1')->where('is_logo','1')->first();
        $reviewData = ReviewRequest::where('id',$request->id)->first();
        if($request->id) {
            $review_cc = $vendorData->email;
            $vendorLogo = url('/public/vendors').'/'.@$vendorImage->vendor_folder.'/'.@$vendorImage->image;
            $vendorName = $vendorData->contact_person;
            $userName = $reviewData->requester_name;
            $messages = nl2br($request->msgs);
            $reviewLink = url('/')."/login";
            $baseUrl = url('/');
            $address = $vendorCompany->address.' '.$vendorCompany->city;
            $subject = 'Complete your review';
            $pageName = 'review_profile_photo';
            $checkNews = UserNewsletter::where('email_id',$reviewData->requester_email)->where('status',0)->count();
            try {
                if(!$checkNews)
                    Mail::to($reviewData->requester_email)->send(new ReviewRequestMail($review_cc, $vendorLogo, $vendorName, $userName, $messages, $reviewLink, $baseUrl, $address, $subject, $pageName,$reviewData->requester_email));
            } catch (\Exception $e) {}

            ////// Update row after mail......
            $reviewRequest = ReviewRequest::find($request->id);
            $reviewRequest->profile_pic = '1';
            $reviewRequest->save();
            if($reviewRequest->id) {
                return 'done';
            }
        }
    }

    public function view_reviews($id=null)
    {
        $vendorId =  \Auth::user()->vendor_id;
        $ratings = VendorRating::where('request_id',$id)->first();
        $replyCount = ReviewReply::where('rating_id',$ratings->id)->where('request_id',$id)->where('vendor_id',$vendorId)->count();
        $shortName = str_replace(substr($ratings->name, 1),'',$ratings->name);
        $rating = '0%';
        if($ratings->average_rating == 1) {
            $rating = '20%';
        } else
        if($ratings->average_rating == 2) {
            $rating = '40%';
        } else
        if($ratings->average_rating == 3) {
            $rating = '60%';
        } else
        if($ratings->average_rating == 4) {
            $rating = '80%';
        } else
        if($ratings->average_rating == 5) {
            $rating = '100%';
        }
        $srtNam = '"'.strtoupper($shortName).'"';
        $ratNam = '"'.$ratings->name.'"';
        $replyFunc = 'replyOnReview('.$id.','.$ratings->id.','.$srtNam.','.$ratNam.')';
        $rates = "<span class='rating-stars-vendor rating-stars-vendor-bar' style='width: ".$rating."'></span>";
        $htmls = "<div class='adminReviewsContent pure-g'><div class='pure-u-1-9'><div class='adminReviewsItem__avatar'><div class='avatar'><div class='avatar-alias size-avatar-xlarge'><svg class='avatar-generic' version='1.1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200' preserveAspectRatio='xMidYMin slice'><circle fill='#BCB0B5' cx='100' cy='100' r='100'></circle><text transform='translate(100,130)' y='0'><tspan font-size='90' class=' fill='rgba(0,0,0,0.3)' text-anchor='middle'>".strtoupper($shortName)."</tspan></text></svg></div></div></div></div><div class='pure-u-8-9'><span class='adminReviewsItem__name'>".$ratings->name."</span><div class='app-review-rating-container mb15 mt5'><div class='rating-stars-vendor'>".$rates."</div><span class='review__ratio ml5'>".number_format($ratings->average_rating, 1)."</span></div><div class='adminReviewsItem__scroll'><p class='adminReviewsItem__title'><strong>".$ratings->review_title."</strong></p><p class='adminReviewsItem__description adminReviewsItem__description--scroll'>".nl2br($ratings->review_description)."</p></div><time class='adminReviewsItem__send'>Sent on ".date_format(date_create($ratings->created_at),'d/m/Y')."</time></div></div><footer class='adminReviewsItemFooter'><div class='pure-g'><div class='pure-u-1-3'><a class='adminReviewsItemFooter__links' role='button' onclick=''><i class='icon icon-ban icon-left icon-opacity'></i> Dispute </a><div class='adminReviewsItemFooter__links'><div class='adminReviewsItemFooter__social app-admin-reviewShareLayer'><i class='icon icon-share icon-left icon-opacity'></i> Share <ul class='adminReviewsItemFooter__socialLayer'><li><a rel='nofollow' class='icon icon-facebook' role='button' onclick=''> Facebook</a></li><li><a rel='nofollow' class='icon icon-twitter' role='button' onclick=''> Twitter</a></li></ul></div></div></div>";
        if($replyCount == 0) {
            $htmls .= "<div class='pure-u-2-3 text-right'><a class='fright btnFlat btnFlat--primary' role='button' onclick='".$replyFunc."'> Reply </a></div>";
        }
        $htmls .= "</div></footer>";
        return $htmls;
    }

    public function saveReviewReply(Request $request)
    {   
        $vendorData = VendorRating::where('id',$request->rateId)->first();
        $image = $request->file('reply_image');
        $input['image'] = str_random().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/review_reply_images');
        $image->move($destinationPath, $input['image']);

        $reviewReply = new ReviewReply();
        $reviewReply->rating_id     = $request->rateId;
        $reviewReply->request_id    = $request->reqId;
        $reviewReply->vendor_id     = $vendorData->vendor_id;
        $reviewReply->user_id       = $vendorData->user_id;
        $reviewReply->reply_text    = nl2br($request->reply_text);
        $reviewReply->reply_image   = $input['image'];
        $reviewReply->save();
        if($reviewReply->id) {
            return redirect()->back()->with('message', 'Reply sent successfully.');
        }
    }

    /*
    *
    * Review Request sned to User
    *
    */
    public function send_reviews_request(Request $request)
    {
        // print_r($request->all());die;
        $vendorId =  \Auth::user()->vendor_id;
        $vendorData = Vendor::where('vendor_id',$vendorId)->first();
        $vendorCompany = VendorCompany::where('vendor_id',$vendorId)->first();
        $vendorImage = VendorImage::where('vendor_id',$vendorId)->where('status','1')->orderBy('is_logo','DESC')->first();
        foreach($request->nombre as $nm => $rvr) {
            $usersImage = VendorImage::leftJoin('vendors','vendors.vendor_id','=','vendor_images.vendor_id')
                        ->where('vendors.email',$request->mail[$nm])->where('vendor_images.status','1')->where('vendor_images.is_logo','1')->count();
            $reviewRequest = new ReviewRequest();
            $reviewRequest->vendor_id          = $vendorId;
            $reviewRequest->requester_name     = $request->nombre[$nm];
            $reviewRequest->requester_email    = $request->mail[$nm];
            $reviewRequest->requester_message  = $request->review_message;
            $reviewRequest->vendor_url         = $request->reviewrequesturl;
            if($usersImage > 0) {
                $reviewRequest->profile_pic    = '1';
            }
            $reviewRequest->save();
            if($reviewRequest->id) {
                $review_cc = $vendorData->email;
                $vendorLogo = url('/public/vendors').'/'.@$vendorImage->vendor_folder.'/'.@$vendorImage->image;
                $vendorName = $vendorData->contact_person;
                $userName = $request->nombre[$nm];
                $messages = nl2br($request->review_message);
                $reviewLink = $request->reviewrequesturl.'/'.encrypt($reviewRequest->id);
                $baseUrl = url('/');
                $address = $vendorCompany->address.' '.$vendorCompany->city;
                $subject = 'Review '.$vendorData->contact_person;
                $pageName = 'review_request_mail';
                $checkNews = UserNewsletter::where('email_id',$request->mail[$nm])->where('status',0)->count();
                try {
                    if(!$checkNews)
                        Mail::to($request->mail[$nm])->send(new ReviewRequestMail($review_cc, $vendorLogo, $vendorName, $userName, $messages, $reviewLink, $baseUrl, $address, $subject, $pageName,$request->mail[$nm]));
                } catch (\Exception $e) {}
            }
        }
        if($request->saveAsTemplate == 'on' || $request->saveAsTemplate == true) {
            if($request->template_id != '') {
                $reviewTemplate = ReviewTemplate::find($request->template_id);
            } else {
                $reviewTemplate = new ReviewTemplate();
            }
            $reviewTemplate->vendor_id = $vendorId;
            $reviewTemplate->name      = $request->templateName;
            $reviewTemplate->message   = $request->review_message;
            if($request->setAsDefault == 'on' || $request->setAsDefault == true) {
                $reviewTemplate->status = '1';
            }
            $reviewTemplate->save();
        }
        return redirect()->back()->with('message', 'Request sent successfully.');
    }

    /**
    * Delete Review
    *
    * @return \Illuminate\Http\Response
    */
    public function delete_review(Request $request)
    {
        $vendorId =  \Auth::user()->vendor_id;
        $ids = $request->input('inbox_id');
        if(isset($ids) && !empty($ids)) {
            \App\VendorRating::where('vendor_id',$vendorId)->whereIn('id', $ids)->delete();
            return \Redirect()->back()->with('message','<span class="alert alert-success">Review Deleted.</span>');
        }else{
            return \Redirect::back()->with('message','<span class="alert alert-danger">Oops! Something went wrong please try again.</span>');
        }
    }

    public function review_status($id,$status)
    {
        $vendorId =  \Auth::user()->vendor_id;
        // $faqObj = \App\VendorRating::find($id);
        // $faqObj->status = $status;
        // $data = $faqObj->save();
        $data =  \App\VendorRating::where('id', $id)->where('vendor_id',$vendorId)->update(array('status'=>$status));
        if($data) {
            return redirect()->back()->with('message', '<span class="alert alert-success">Review status has been updated.</span>');
        }else{
            return redirect()->back()->with('message', '<span class="alert alert-danger">Something went wrong. Please try again.</span>');
        }
    }

    public function get_reviewlist()
    {
        $search = Input::get('q', false);
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId = \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data', 'category_data', 'image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        if($search != '') {
            $data['searchData'] = $search;
            $data['ratingDatas'] = VendorRating::leftJoin('vendor_review_reply as vrr','vrr.rating_id','=','vendor_ratings.id')
                                ->select('vendor_ratings.*','vrr.reply_text','vrr.status as rStatus','vrr.reply_image','vrr.created_at as createDate')
                                ->where('vendor_ratings.vendor_id',$vendorId)->where('vendor_ratings.status','1')
                                ->where('vendor_ratings.review_title','LIKE', '%'.$search.'%')
                                ->orWhere('vendor_ratings.review_description','LIKE', '%'.$search.'%')->get();
        } else {
            $data['searchData'] = '';
            $data['ratingDatas'] = VendorRating::leftJoin('vendor_review_reply as vrr','vrr.rating_id','=','vendor_ratings.id')
                                ->select('vendor_ratings.*','vrr.reply_text','vrr.status as rStatus','vrr.reply_image','vrr.created_at as createDate')
                                ->where('vendor_ratings.vendor_id',$vendorId)->where('vendor_ratings.status','1')->get();
        }
        $data['ratingData'] = VendorRating::leftJoin('vendor_review_reply as vrr','vrr.rating_id','=','vendor_ratings.id')
                            ->select('vendor_ratings.*','vrr.reply_text','vrr.status as rStatus','vrr.reply_image','vrr.created_at as createDate')
                            ->where('vendor_ratings.vendor_id',$vendorId)->where('vendor_ratings.status','1')->get();
        return view('vendor.vendor_reviews_list', ['data' => $data]);
    }

    public function highlight_reviews($id=null)
    {
        $ratingData = VendorRating::where('id',$id)->first();
        $vRating = VendorRating::find($id);
        if($ratingData->highlights == '1') {
            $vRating->highlights = '0';
        } else {
            $vRating->highlights = '1';
        }
        $vRating->save();
        if($vRating->id) {
            return 'done';
        }
    }

    public function reviewDispute($id=null)
    {
        $id = decrypt($id);
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId = \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data', 'category_data', 'image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $data['ratingData'] = VendorRating::leftJoin('vendor_review_requets as vrr','vrr.id','=','vendor_ratings.request_id')
                            ->select('vendor_ratings.*','vrr.profile_pic','vrr.created_at as createDate')
                            ->where('vendor_ratings.vendor_id',$vendorId)->where('vendor_ratings.id','=',$id)->first();
        return view('vendor.vendor_reviews_dispute', ['data'=>$data]);
    }

    public function saveReviewDispute(Request $request)
    {
        $this->validate($request, [
             'rateId' => 'required',
             'dispute_text' => 'required',
         ],['dispute_text.required'=>'Dispute message is required.']);

        $rateId = $request->rateId;
        $vRating = VendorRating::find($rateId);
        $vRating->dispute_text   = $request->dispute_text;
        $vRating->dispute_status = '1';
        $vRating->highlights     = '0';
        $vRating->status         = '0';
        $vRating->save();
        if($vRating->id) {
            return redirect('reviews-list')->with('message', 'The review was disputed. We will look over the case and contact you as soon as possible. For now, the review is not visible on your Storefront or in your Review Manager.');
        }
    }

    /**
    * Show the Perfect Wedding Sellos page.
    *
    * @return \Illuminate\Http\Response
    */
    public function get_reviewsellos()
    {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId = \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data', 'category_data', 'image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();

        return view('vendor.vendor_perfectweddding_rated', ['data'=>$data]);
    }

    /**
    * Show the Reviews Widget page.
    *
    * @return \Illuminate\Http\Response
    */
    public function get_reviewwidget()
    {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId = \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data', 'category_data', 'image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $countReview=VendorRating::where('vendor_id',$vendorId)->where('dispute_status','0')->count();
        //dd($data['countReview']);
        return view('vendor.vendor_reviews_widget', ['data'=>$data,'countReview'=>$countReview]);
    }

    /**
    * Show the Reviews Templates page.
    *
    * @return \Illuminate\Http\Response
    */
    public function get_reviewtemplate()
    {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId = \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data', 'category_data', 'image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();

        $data['templates'] = ReviewTemplate::where('vendor_id',$vendorId)->get();
        return view('vendor.vendor_review_templates', ['data'=>$data]);
    }

    public function addTemplate(Request $request)
    {
        $vendorId = \Auth::user()->vendor_id;
        $newTemplate = new ReviewTemplate();
        $newTemplate->vendor_id = $vendorId;
        $newTemplate->name      = $request->name;
        $newTemplate->message   = $request->message;
        if($request->setAsDefault == 'on' || $request->setAsDefault == true) {
            $newTemplate->status = '1';
        }
        $newTemplate->save();
        if($newTemplate->id) {
            return 'done';
        }
    }

    public function editTemplate($id=null)
    {
        $tempData = ReviewTemplate::where('id',$id)->first();
        $checkd = '';
        if($tempData->status == 1) {
            $checkd = 'checked';
        }
        $htmls = "<form class='pure-form app-review-collector-templates-create-form' action='javascript:;' id='editTemplateForm' method='post'><div class='pure-g'><div class='pure-u-1'><div class='mb15 pure-control-group'><label class='adminFormLabel'>Template Name</label><input type='hidden' name='tempId' value='".$tempData->id."'><input size='45' maxlength='100' type='text' name='name' value='".$tempData->name."'></div><p class='color-grey'>Hi [Name],</p><div class='mb15 pure-control-group'><textarea class='mt5' rows='10' style='height: 300px;width:100%;' name='message'>".$tempData->message."</textarea></div><input class='btnFlat btnFlat--primary mr10 update_rev_template_btn' type='submit' value='Save Changes'><input class='btnOutline btnOutline--primary app-review-collector-template-cancel cancel_btn' type='button' value='Cancel'><span class='ml10 satasdefaultcls'><div class='icheckbox_minimal ".$checkd."' style='position: relative;'><input type='checkbox' id='SetAsDefault' name='setAsDefault' ".$checkd." class='app-set-as-default reviewCollector__setAsDefault' style='opacity: 0;'></div><label for='SetAsDefault'>Set as default</label></span><a class='fright mt10' onclick='removeTemplate(".$tempData->id.")'><i class='fa fa-trash'></i> Remove template </a></div></div></form>";
        return $htmls;
    }

    public function editTemplateSave(Request $request)
    {
        $vendorId = \Auth::user()->vendor_id;
        $tempId = $request->tempId;
        $preData = ReviewTemplate::where('id','!=',$tempId)->where('vendor_id',$vendorId)->get();
        foreach($preData as $prd) {
            $updTemplate = ReviewTemplate::find($prd->id);
            $updTemplate->status = '0';
            $updTemplate->save();
        }
        $editTemplate = ReviewTemplate::find($tempId);
        $editTemplate->vendor_id  = $vendorId;
        $editTemplate->name       = $request->name;
        $editTemplate->message    = $request->message;
        if($request->setAsDefault == 'on' || $request->setAsDefault == true) {
            $editTemplate->status = '1';
        } else {
            $editTemplate->status = '0';
        }
        $editTemplate->save();
        if($editTemplate->id) {
            return 'done';
        }
    }
    public function blogs()
    {
        $vendorId =  \Auth::user()->vendor_id;
        $data['userData'] = \Auth::user();
        $data['companyData'] = \App\CompanySetting::select('phone_number')->where('id',1)->first();
        $data['vendorData'] = Vendor::with('company_data', 'category_data', 'image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['review'] = \App\VendorRating::where('vendor_id',$vendorId)->orderBy('id','desc')->get()->toArray();
        $data['bookData'] = UserBookedVendor::select('users.*')->leftJoin('users','users.id','=','user_booked_vendors.user_id')
                    ->where('user_booked_vendors.vendor_id','=',$vendorId)->where('users.status','=','1')
                    ->where('user_booked_vendors.book_status','=',6)->groupBy('user_booked_vendors.user_id')->get();
        $data['reviewTemplate'] = ReviewTemplate::where('vendor_id','=',$vendorId)->get();
        $data['reviewRequest'] = ReviewRequest::where('vendor_id','=',$vendorId)->get();
        $data['pendingRequest'] = ReviewRequest::where('vendor_id','=',$vendorId)->where('request_status','0')->get();
        $data['withoutPicRequest'] = ReviewRequest::where('vendor_id','=',$vendorId)->where('profile_pic','0')->get();
        $data['allData'] = User::where('status','=','1')->get();

        $homeVendors = DB::table('vendors as VE')->select('VC.business_name','VC.business_name_slug',
            DB::raw('(select CASE WHEN CTT.slug IS NULL THEN CT.slug ELSE CONCAT(CTT.slug,"/",CT.slug) END as full_slug from categories AS CT left join categories as CTT ON CT.parent_id = CTT.id where CT.id = VE.cat_id) as full_slug'),
            DB::raw('(select title from categories CT1 where CT1.id = VE.cat_id) as cat'))
        ->leftJoin('vendor_companies as VC','VE.vendor_id','=','VC.vendor_id')
        ->where('VE.status','=','0')
        ->where('VE.vendor_id', '=', $vendorId)->get()->toArray();

        $data['venderPageslug'] = $homeVendors;
        $data['blogs'] = BlogPost::with('categories')->where('vendor_id','=',$vendorId)->get();
        return view('vendor.viewcomposts',['data'=>$data]);
    }
    public function addblogs()
    {
        $vendorId =  \Auth::user()->vendor_id;
        $data['userData'] = \Auth::user();
        $data['companyData'] = \App\CompanySetting::select('phone_number')->where('id',1)->first();
        $data['vendorData'] = Vendor::with('company_data', 'category_data', 'image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['allData'] = User::where('status','=','1')->get();
        $data['cats'] = BlogCategory::all();
        
        return view('vendor.addcomposts',['data'=>$data]);
    }
    public function deleteBlog($id)
    {
        $blog = BlogPost::find($id)->delete();
        if($blog)
            return redirect('blogs')->with('success',"Post deleted successfully !!");
        else
            return redirect('blogs')->with('error','Something went wrong. Please try again later !!');
    }
    public function savePost($id = null,Request $request)
    {
        $this->validate($request, [
                'name' => 'required|string',
                // 'picture.*' => '',
                'excerpt' => 'required|string',
                'body' => 'required|string',
                'category_id' => 'required|integer',
            ],
            [ 
                'name.required' => 'Post name or title field is required.',
                // 'picture.required' => 'Picture is required.',
                'excerpt.required' => 'Brief body is required.',
                'body.required' => 'Post body is required.',
                'category_id.required' => 'Category is required.',
            ]
        );
        /*$categories = $request->input('categories');
        if(!is_array($categories) && empty($categories))
            return redirect()->back()->with('error','Atleast one category to be add !!');*/
             $vendorId =  \Auth::user()->vendor_id;
        $sendMail = BlogPost::where('vendor_id',$vendorId)->count() == 0;
        if($id == null)
            $blogPost = new BlogPost;
        else
            $blogPost = BlogPost::find($id);
        if($request->file('picture') != null){
            $image = $request->file('picture');
            $input['image'] = time().'_'.rand(1000,9999).'_content.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/blogs');
            $image->move($destinationPath, $input['image']);
            $blogPost->picture = $input['image'];
        }
        if(!empty($request->input('picture')) && strlen($request->input('picture')) > 6) {
            $featuredImage = $request->input('picture');
            if(preg_match('/data:image/', $featuredImage)) {
                @unlink(public_path() . '/images/blogs/'.@$blogPost->picture);
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time().'_icon_'.rand(1000,9999) . '.png';
                $path = public_path() . '/images/blogs';
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path. '/' . $image_name, $featuredImage);
                $blogPost->picture = $image_name;
            }
        }
        if ($id == null){
            $this->validate($request, [
                'picture' => 'required|min:7']);
        }
        $blogPost->name = $request->name;
        if($id == null)
            $blogPost->slug = $this->createSlug($request->name);
        $detail = $request->body;
        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml('<?xml encoding="utf-8" ?>'.$detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        $featurImgArray = array();
        foreach($images as $k => $img) {
            $data = $img->getattribute('src');
            if(preg_match('/data:image/', $data)) {
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name = time().'_'.$k.'_'.rand(1000,9999).'_myhealthsquad.png';
                $path = public_path() .'/images/blogs/'. $image_name;
                file_put_contents($path, $data);
                $img->removeattribute('src');
                $imagUrl = asset('/images/blogs').'/'.$image_name;
                $img->setattribute('src', $imagUrl);
                array_push($featurImgArray, $image_name);
            } else {
                $imageUrl = $img->getattribute('src');
                array_push($featurImgArray, $imageUrl);
            }
        }
        if($request->file('pdf') != null) {
            $image = $request->file('pdf');
            $input['image'] = time().'_'.rand(100,999).'_mhs_content_pdf.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/blogs');
            $image->move($destinationPath, $input['image']);
	        $blogPost->pdf = $input['image'];
        }
        $blogPost->excerpt = $request->excerpt;
        $blogPost->body = $dom->saveHTML();
        $blogPost->blog_category_id = $request->category_id;
        //$userData = $request->session()->get('adminData')[0];
        $blogPost->vendor_id =  $vendorId;
        $blogPost->published = $request->published;
        $blogPost->approved = 0;
        $data = $blogPost->save();
        $message = $id == null ? 'added' : 'updated';
        if($data){
                $vendor = Vendor::where('vendor_id',$vendorId)->first();
                $checkNews = UserNewsletter::where('email_id',$vendor->email)->where('status',0)->count();
                if(!$checkNews){
                    $blogs = BlogPost::where(function($query) use($vendorId){
                        return $query->where('vendor_id','!=',$vendorId)
                        ->orWhere('vendor_id');
                    })->where('approved',1)->inRandomOrder()->limit(3)->get();
                    // Mail::to($vendor->email)->send(new BlogTipsMail($vendor->username,'','',$blogs,$vendor->email));
                    try {
                        Mail::to($vendor->email)->send(new CommunityGuideLineMail($vendor->email));
                        Mail::to($vendor->email)->send(new SubmittingBlogMail('',$vendor->email));
                    } catch (\Exception $e) {}
                }
            return redirect('blogs')->with('success',"Post $message successfully !!");
        }
        else
            return redirect('blogs')->with('error','Something went wrong. Please try again later !!');
    }
    public function createSlug($name)
    {
        $slug = str_slug($name,'-');
        $post = BlogPost::select(DB::raw("count(*) as cnt"))->where('slug',$slug)->first();
        $slug = $slug.(isset($post->cnt) && $post->cnt > 0 ? "$post->cnt" : "");
        return $slug;
    }
}