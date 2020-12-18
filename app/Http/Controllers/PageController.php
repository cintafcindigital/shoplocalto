<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Slider;
use App\Signup;
use App\Page;
use App\PromoCode;
use App\Testimonial;
use App\Vendor;
use App\Category;
use App\CategoryImages;
use App\ContactEnquiry;
use App\UserNewsletter;
use App\VendorVisitsCount;
use App\VendorCompany;
use App\VendorDeal;
use App\VendorPromotion;
use App\VendorImage;
use App\VendorEvent;
use App\VendorVideo;
use App\VendorFaq;
use App\VendorTeammember;
use App\VendorRating;
use App\VendorLocation;
use App\GuestsList;
use App\VendorCategoryRelation;
use DB;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestEnquirySent;
use App\Mail\GuestUserVerifyLink;
use App\Mail\PaymentSuccessMail;
use App\Mail\VendorMailToAdmin;
use App\Mail\PaymentFailedVendor;
use App\Mail\VendorAfterPayment;
use App\Mail\ProfessionalTipsMail;
use App\Mail\ProfessionalTipsLeadMail;
use App\Mail\VendorMakeChangesMail;
use App\Mail\WhoIsSiteMail;
use App\Mail\WelcomeMailToVendor;
use App\Mail\PatientAutoResponderMail;
use App\VendorView;
use App\ReviewRequest;
use App\User;
use App\Countries;
use App\UserPartners;
use App\PlanningToolsPages;
use Event;
use App\Events\UserCreated;
use Illuminate\Contracts\Auth\Guard; 
use Illuminate\Contracts\Auth\Authenticatable;
use App\CommunityGroup;
use App\WeddingideasPost;
use App\CommunityDiscussion;
use App\WeddingideasCategory;
use App\Regions;
use App\UserBookedVendor;
use App\TodoList;
use App\Subscription;
use App\PaymentMethod;
use App\VendorInvoice;
use App\VendorBill;
use App\BusinessHours;
use App\BusinessInfo;
use App\BlogPost;
use App\BusinessSocialMedia;
use App\Library\Moneris\mpgTransaction;
use App\Library\Moneris\CofInfo;
use App\Library\Moneris\mpgRequest;
use App\Library\Moneris\mpgHttpsPost;
use Session;


class PageController extends Controller
{
    /*
    *
    * Display the Home page.
    *
    */
    // public function __construct(Guard $auth)
    // {   
    //     $this->middleware('auth');
    // }

    protected function home()
    {
        $data = array();
        $datetimeSave = date('Y-m-d H:i:s');
        $sessionId = session()->getId();
        $visiterCount = DB::select("SELECT COUNT(*) AS cnt FROM site_visitor WHERE session_id = '$sessionId' AND DATE_FORMAT(created_at,'%Y-%m-%d') = DATE_FORMAT(STR_TO_DATE('$datetimeSave','%Y-%m-%d %H:%i:%s'),'%Y-%m-%d')")[0]->cnt;
        if($visiterCount <= 0)
            DB::table('site_visitor')->insert(['session_id' => $sessionId,'created_at' => $datetimeSave,'updated_at' => $datetimeSave]);
        // echo $sessionId;
        // if(Auth::check()){
        //     echo '<pre>'; print_r(Auth::user()); die;
        // }
        $page = Page::where('id', 1)->first();
        // $page['hot_deals'] = Page::get_hot_deals();
        // $page['categories'] = Category::getCategory();
        /*$page['locations'] = DB::table('regions')->groupBy('state')->where('status','=','1')->pluck('state');
        $page['stateRegions'] = Regions::get()->toArray();
        $search = array();
        foreach ($page['locations'] as $locationValue) {
            $i = 0;
            foreach($page['stateRegions'] as $element) {
                if($locationValue == $element['state']) {
                   $search[$locationValue][$i] = $element;
                   $i++;
                }
            }
        }
        $page['stateSearchRegions'] = $search;*/
        $page['vendors'] = Page::home_vendors();
        // dd($page['vendors']);
        // echo "<pre>"; print_r($page['vendors']); die;
        // $page['top_locations'] = Page::top_locations();
        // $page['stories'] = Page::get_wedding_stories();
        $page['communitygroup'] = CommunityGroup::where('status', 1)->limit(5)->get();
        $page['weddingideasPost'] = WeddingideasPost::with('parentCategory','subCategory')->where('status','1')->orderBy('id','DESC')->inRandomOrder()->limit(3)->get();
        // $page['groupDiscussion'] = CommunityDiscussion::with('userinfo')->orderBy('created_at', 'desc')->get()->random(3);
        $page['groupDiscussion'] = CommunityDiscussion::with('userinfo')->orderBy('created_at', 'desc')->get();
        //  echo"<pre>"; print_r($page['stories']); die;
        //$data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',Auth::user()->vendor_id)->get()->toArray();
        $userId = @\Auth::user()->id;
        $user_partner = array();
        $user_vendors = array();
        if($userId) {
            $user_partner = UserPartners::where('user_id',$userId)->get()->toArray();
            ////// for vendors......
            $user_total_vendors = UserBookedVendor::where('user_id',$userId)->count();
            $user_reserve_vendors = UserBookedVendor::where('user_id',$userId)->where('book_status','6')->count();
            $user_vendors['total_vendr'] = $user_total_vendors;
            $user_vendors['total_hire'] = $user_reserve_vendors;
            ////// for to-do-list......
            $user_total_task = TodoList::where('user_id',$userId)->count();
            $user_compl_task = TodoList::where('user_id',$userId)->where('status','1')->count();
            $user_vendors['total_task'] = $user_total_task;
            $user_vendors['compl_task'] = $user_compl_task;
            ////// for Guest list......
            $user_total_guest = GuestsList::where('user_id',$userId)->count();
            $user_compl_guest = GuestsList::where('user_id',$userId)->where('attendance','confirmed')->count();
            $user_vendors['total_guest'] = $user_total_guest;
            $user_vendors['compl_guest'] = $user_compl_guest;
            ////// for Budget Calculation......
            $user_total_budget = \App\userTotalEstimateBudget::where('user_id',$userId)->first();
            $user_compl_budget = \App\userBudget::select(DB::raw("SUM(paid) as paidsum"))->where('user_id',$userId)->first();
            $user_vendors['total_budget'] = $user_total_budget->total_estimate;
            $user_vendors['compl_budget'] = $user_compl_budget->paidsum;
            // print_r($userId);
        }
        $sliders = Slider::orderBy('created_at', 'asc')->get();
        $blogs = BlogPost::with('categories')->where('vendor_id')->latest()->limit(3)->get();
        

        Session::forget('_vendor_registration_step');
        Session::forget('_vendor_id');
        Session::forget('_vendor_username');
        Session::forget('_vendor_password');
         return view('pages/home',['pageData'=>$page,'sliders'=>$sliders,'user_partner'=>$user_partner,'user_vendors'=>$user_vendors,'data'=>$data,'blogs' => $blogs]);

        
    }

    public function search_listing($searchKey=null)
    {
        if($searchKey) {
            $searchData = VendorCompany::select('vendor_companies.*','VE.cat_id','CT.title','CT.slug','CTP.slug as parent_slug')
                ->leftJoin('vendors as VE','vendor_companies.vendor_id','=','VE.vendor_id')
                ->leftJoin('categories as CT','VE.cat_id','=','CT.id')->leftJoin('categories as CTP','CT.parent_id','=','CTP.id')
                ->where('vendor_companies.business_name','like',$searchKey.'%')
                ->orWhere('CT.title','LIKE','%'.$searchKey.'%')
                ->orWhere('CTP.title','LIKE','%'.$searchKey.'%')->take(20)->get()->toArray();
            return response()->json($searchData);
        } else {
            return response()->json(array());
        }
    }

    public function get_search_listing($searchKey=null)
    {
        $pageData = Page::where('id',25)->first();
        if($searchKey) {
            $searchData = VendorCompany::select('vendor_companies.*','VE.cat_id','CT.title','CT.slug','CTP.slug as parent_slug')
                ->leftJoin('vendors as VE','vendor_companies.vendor_id','=','VE.vendor_id')
                ->leftJoin('categories as CT','VE.cat_id','=','CT.id')->leftJoin('categories as CTP','CT.parent_id','=','CTP.id')
                ->where('vendor_companies.business_name','like',$searchKey.'%')
                ->orWhere('CT.title','LIKE','%'.$searchKey.'%')->orWhere('CTP.title','LIKE','%'.$searchKey.'%')->paginate(12);
            foreach($searchData as $key => $vls) {
                $searchData[$key]['image_data'] = VendorImage::where('vendor_id',$vls->vendor_id)->get();
                $searchData[$key]['category_images'] = CategoryImages::where('cat_id',$vls->cat_id)->get();
            }
            return view('pages.payment_vendor_search',['pageData'=>$pageData,'searchKey'=>$searchKey,'searchData'=>$searchData]);
        } else {
            return view('pages.payment_vendor_search',['pageData'=>$pageData,'searchKey'=>$searchKey,'searchData'=>array()]);
        }
    }

    public function payment_lead_details($vendor_id=null)
    {
        if($vendor_id) {
            Session::put('session_payType','lead');
            Session::put('session_vendorId', $vendor_id);
            return redirect('/activate-now');
        } else {
            return redirect('/');
        }
    }
    public function payment_freelisting_details($vendor_id=null)
    {
        if($vendor_id) {
            Session::put('session_payType','freelisting');
            Session::put('session_vendorId', $vendor_id);
            return redirect('/join-now');
        } else {
            return redirect('/');
        }
    }

    public function payment_details()
    {
        $page = Page::where('id', 25)->first();
        $session_vendorId = Session::get('session_vendorId');
        if($session_vendorId) {
            $vendors = Vendor::with('company_data')->where('vendors.vendor_id',$session_vendorId)->first();
            $vendors = Vendor::find($session_vendorId);
            Mail::to($vendors->email)->send(new PaymentFailedVendor($username));
        } else {
            $vendors = array();
        }
        Session::forget('session_vendorId');
        Session::forget('_vendor_registration_step');
        Session::forget('_vendor_id');
        Session::forget('_vendor_username');
        Session::forget('_vendor_password');
        return redirect('/');
        return view('pages.payment_details',['pageData' => $page,'vendors' => $vendors]);
    }

    public function payment_packages()
    {
        $session_payType = Session::get('session_payType');
        $session_vendorId = Session::get('session_vendorId');
        if($session_vendorId) {
            $page = Page::where('id', 25)->first();
            $subscription = Subscription::get();
            $vendors = Vendor::with('company_data')->where('vendors.vendor_id',$session_vendorId)->first();
            $username = Session::get('_vendor_username');
            $password = Session::get('_vendor_password');
            $vendor = Vendor::where('vendor_id',$session_vendorId)->first();
            /*Session::forget('_vendor_registration_step');
            Session::forget('_vendor_id');
            Session::forget('_vendor_username');
            Session::forget('_vendor_password');
            Session::forget('session_vendorId');*/
            // Auth::guard('vendor')->attempt(['username' => $username,'password' => $passwords]);
            // return redirect('emp-vendor/reviews-sellos');
            return view('pages.payment_packages',['pageData'=>$page,'subscription'=>$subscription,'vendors'=>$vendors]);
        } else {
            if($session_payType == 'lead') {
                return redirect('activate-now');
            } elseif($session_payType == 'freelisting') {
                return redirect('join-now');
            } else {
                return redirect('search?search=all');
            }
        }
    }

    public function payment_page($subs_id=null)
    {
        if($subs_id) {
            Session::put('session_subsId', $subs_id);
        }
        $session_subsId = Session::get('session_subsId');
        $session_vendorId = Session::get('session_vendorId');
        if($subs_id && $session_vendorId) {
            return redirect('/payment-page');
        } else if(!$session_subsId || !$session_vendorId) {
            return redirect('payment-packages');
        }
        $page = Page::where('id',25)->first();
        $vendrData = Vendor::where('vendor_id',$session_vendorId)->where('freelisting','Yes')->count();
        if($vendrData > 0) {
            $vendors = Vendor::where('vendor_id',$session_vendorId)->first();
            $subscription = Subscription::where('id',$session_subsId)->first();
            return view('pages.payment_page',['pageData'=>$page,'subscription'=>$subscription,'vendors'=>$vendors]);
        } else {
            return view('pages.payment_page',['pageData'=>$page,'subscription'=>array(),'vendors'=>array()]);
        }
    }

    public function store_payment_method(Request $request)
    {
        $vendorId = $request->vendor_id;
        if($vendorId) {
            if($request->username && $request->password) {
                $vendors = Vendor::find($vendorId);
                $vendors->username = $request->username;
                $vendors->password = bcrypt($request->password);
                $vendors->save();
            }
            $paymnt = new PaymentMethod();
            $paymnt->vendor_id       = $vendorId;
            $paymnt->cardholder_name = $request->cardholder_name;
            $paymnt->card_type       = $request->cardType;
            $paymnt->card_number     = $request->card_number;
            $paymnt->card_cvc        = $request->card_cvc;
            $paymnt->exp_month       = $request->exp_month;
            $paymnt->exp_year        = $request->exp_year;
            $paymnt->pay_type        = $request->pay_type;
            $paymnt->subscription_id = $request->subscription_id;
            $paymnt->save();
            if($paymnt->id) {
                //// Mail to Admin......
                $subject = "Vendor Payment Details"; //cesario@indigitalgroup.ca
                // Mail::to('citstestdev@gmail.com')->send(new VendorMailToAdmin($vendors,'',$subject,'pending'));
                $vendors = Vendor::where('vendor_id',$vendorId)->first();
                $vendorCompany = VendorCompany::where('vendor_id','!=',$vendorId)->inRandomOrder()->limit(3)->get();
                // Mail::to($vendors->email)->send(new VendorAfterPayment($vendors->username));
                // Mail::to($vendors->email)->send(new ProfessionalTipsMail($vendors->username,'','',$vendorCompany,$vendors->email));
                // Mail::to($vendors->email)->send(new ProfessionalTipsLeadMail($vendors->username,'','',$vendors->email));
                echo 'done';
            } else {
                echo 'some error occured !';
            }
        } else {
            echo 'some error occured !';
        }
    }

    public function save_payment_method(Request $request)
    {
        $vendorId = $request->vendor_id;
        if($vendorId) {
            if($request->username && $request->password) {
                $vendorsUpd = Vendor::find($vendorId);
                $vendorsUpd->username = $request->username;
                $vendorsUpd->password = bcrypt($request->password);
                $vendorsUpd->save();
            }
            //// Make payment......
            $paymnt = new PaymentMethod();
            $paymnt->vendor_id       = $vendorId;
            $paymnt->cardholder_name = $request->cardholder_name;
            $paymnt->card_type       = $request->cardType;
            $paymnt->card_number     = $request->card_number;
            $paymnt->card_cvc        = $request->card_cvc;
            $paymnt->exp_month       = $request->exp_month;
            $paymnt->exp_year        = $request->exp_year;
            $paymnt->pay_type        = $request->pay_type;
            $paymnt->save();
            if($paymnt->id) {
                $subscription = Subscription::where('id',$request->subscription_id)->first();
                $due_date = date('Y-m-d');
                $numLoops = 0;
                if($subscription->duration == '3 Months') {
                    $numLoops = 3;
                    $due_date = date('Y-m-d', strtotime("+3 months", strtotime($due_date)));
                } elseif($subscription->duration == '6 Months') {
                    $numLoops = 6;
                    $due_date = date('Y-m-d', strtotime("+6 months", strtotime($due_date)));
                } elseif($subscription->duration == '1 Year') {
                    $numLoops = 12;
                    $due_date = date('Y-m-d', strtotime("+12 months", strtotime($due_date)));
                }
                $subsAmount = $subscription->amount;
                if($request->pay_type == 'monthly') {
                    $subsAmount = round($subscription->amount / $numLoops, 2);
                }
                ////// live site data key from https://www.dolcechocolateco.com......
                // $store_id='monca93210';
                // $api_token='3yAtOzMUMmOqZU0oFKIN';
                ////// for testing of credit card put this request in url.....
                // if(($request->has('cardtest') && $request->cardtest == 'yes') || $_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
                    $store_id = 'store5';
                    $api_token = 'yesguy';
                // }
                $txnArray = array(
                    'type'               => 'purchase',
                    'order_id'           => time().rand(000,999),
                    'cust_id'            => $request->cardholder_name,
                    'amount'             => number_format($subsAmount,2,".",""),
                    'pan'                => $request->card_number,
                    'expdate'            => substr($request->exp_year,2,2).sprintf("%02d",$request->exp_month),
                    'crypt_type'         => '7',
                    'dynamic_descriptor' => 'Perfect Wedding Day'
                );
                $mpgTxn = new mpgTransaction($txnArray);
                $mpgRequest = new mpgRequest($mpgTxn);
                $mpgRequest->setProcCountryCode("CA");
                // if(($request->has('cardtest') && $request->cardtest == 'yes') || $_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
                    $mpgRequest->setTestMode(true);
                // }
                $mpgHttpPost  = new mpgHttpsPost($store_id,$api_token,$mpgRequest);
                $mpgResponse = $mpgHttpPost->getMpgResponse();

                $refNum = $mpgResponse->getReferenceNum();
                $txnNum = $mpgResponse->getTxnNumber();
                $resCod = $mpgResponse->getResponseCode();
                if($mpgResponse->getResponseCode() < 50 && strlen($refNum) > 5 && strlen($txnNum) > 5 && is_numeric($resCod)) {
                    $vendorInvoice = new VendorInvoice;
                    $vendorInvoice->invoice_id          = 'PWDVND'.$vendorId;
                    $vendorInvoice->vendor_id           = $vendorId;
                    $vendorInvoice->subscription_id     = $request->subscription_id;
                    $vendorInvoice->subscription_date   = date('Y-m-d');
                    $vendorInvoice->due_date            = $due_date;
                    $vendorInvoice->subscription_amount = $subscription->amount;
                    $vendorInvoice->status              = '1';
                    $vendorInvoice->save();
                    if($vendorInvoice->id) {
                        $counter = 0;
                        for($vbn = 0; $vbn < $numLoops; $vbn++) {
                            $vendorBill = new VendorBill;
                            $vendorBill->vendor_id       = $vendorId;
                            $vendorBill->subscription_id = $request->subscription_id;
                            $vendorBill->invoice_id      = $vendorInvoice->id;
                            $vendorBill->invoice_number  = 'PWDVND'.$vendorId.(date('m',strtotime("+$vbn months",strtotime(date('Y-m-d')))));
                            $vendorBill->due_date        = date('Y-m-d', strtotime("+$vbn months", strtotime(date('Y-m-d'))));
                            $vendorBill->paid_amount     = round($subscription->amount / $numLoops, 2);
                            $vendorBill->paid_date       = date('Y-m-d');
                            $vendorBill->card_id         = $paymnt->id;
                            if($request->pay_type == 'monthly') {
                                if($vbn == 0) {
                                    $vendorBill->status  = '1';
                                } else {
                                    $vendorBill->status  = '0';
                                }
                            } elseif($request->pay_type == 'full') {
                                $vendorBill->status      = '1';
                            }
                            $vendorBill->save();
                            $counter++;
                        }
                        if($counter > 0) {
                            $vendors = Vendor::find($vendorId);
                            $vendors->status = 1;
                            $vendors->pay_status = 1;
                            $vendors->freelisting = 'No';
                            $vendors->save();
                            //// Mail to vendor......
                            $updLink = url('/register')."?vendorId=".$vendorId;
                            $vendorData = Vendor::where('vendor_id',$vendorId)->first();
                            Mail::to($vendorData->email)->send(new PaymentSuccessMail($vendorData,$vendorInvoice,$subsAmount,$updLink,'payment_success'));
                            //// Mail to Admin......
                            $subject = "Vendor Payment Details"; //cesario@indigitalgroup.ca
                            Mail::to('citstestdev@gmail.com')->send(new VendorMailToAdmin($vendorData,$subsAmount,$subject,'done'));
                            Mail::to('cesario@perfectweddingday.ca')->send(new VendorMailToAdmin($vendorData,$subsAmount,$subject,'done'));
                            echo 'done';
                        }
                    }
                } else {
                    echo $mpgResponse->getMessage();
                }
            }
        } else {
            echo 'some error occured !';
        }
    }

    public function payment_thankyou()
    {
        $session_payType = Session::get('session_payType');
        $session_vendorId = Session::get('session_vendorId');
        if($session_vendorId) {
            //// Send Thank-You mail......
            if($session_payType == 'lead' || $session_payType == 'freelisting') {
                $vendorData = Vendor::where('vendor_id',$session_vendorId)->first();
                $updLink = url('login').'?verification='.encrypt($vendorData->username);
                Mail::to($vendorData->email)->send(new PaymentSuccessMail($vendorData,array(),'',$updLink,'payment_thankyou'));
            }
            //// Mail to Admin......
            Session::forget('_vendor_registration_step');
            Session::forget('_vendor_id');
            Session::forget('_vendor_username');
            Session::forget('_vendor_password');
            $vendorData = Vendor::where('vendor_id',$session_vendorId)->first();
            $subject = "New Vendor Registered on MHS"; //cesario@indigitalgroup.ca
            Mail::to('citstestdev@gmail.com')->send(new VendorMailToAdmin($vendorData,'',$subject,'thankyou'));
            Mail::to('cesario@perfectweddingday.ca')->send(new VendorMailToAdmin($vendorData,'',$subject,'thankyou'));
            $page = Page::where('id', 25)->first();
            $paymentMethod = PaymentMethod::where('vendor_id',$session_vendorId)->first();
            // print_r($paymentMethod);die;
            $subscription = Subscription::where('id',$paymentMethod->subscription_id)->first();
            $vendors = Vendor::with(['company_data','category_data'])->where('vendors.vendor_id',$session_vendorId)->first();
            return view('pages.payment_thankyou',['pageData'=>$page,'subscription'=>$subscription,'vendors'=>$vendors]);
        } else {
            return redirect('/');
        }
    }
    
    public function planning_tools_pages($slug=null)
    {
        $page = Page::where('id', 1)->first();
        $planTool = PlanningToolsPages::where('slug',$slug)->where('status','1')->first();
        return view('pages/planning-tools',['pageData' => $page, 'data' => $planTool]);
    }

     /*
     *
     * Display the Testimonial page and showing all testimonial.
     *
     */
    protected function testimonial(){
         $page = Page::where('id', 2)->first();
         $testimonials = Testimonial::where('status',1)->latest()->paginate(10);
         return view('pages/testimonial',['pageData'=>$page,'testimonials'=>$testimonials]);
    }
    
    public function testimonialAdd()
    {
        $page = Page::where('id', 2)->first();
        return view('pages/testimonial-add',['pageData'=>$page]);
    }
    
    public function testimonialAddSave(Request $request)
    {
        $secret = '6Lfst80ZAAAAAPTWQ9HRsMWqS_uwvob6egLpXdyQ';
        $captchaId = $request->input('g-recaptcha-response');
    
        $responseCaptcha = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captchaId));
        if($responseCaptcha->success) {
            $this->validate($request,[
                'name' => 'required',
                'description' => 'required',
                'image' => 'required|max:2048',
                ]);
            // dd($request->all());
            $testimonials = new Testimonial;
            if($request->hasFile('image')){
                $image = $request->file('image');
                $imageName = 'testimonial_'.mt_rand(10000,99999).'_'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/testimonials');
                $image->move($destinationPath, $imageName);
                $testimonials->image = $imageName;
            }

            $testimonials->name = $request->name;
            $testimonials->description = $request->description;
            $testimonials->status = 0;
            $testimonials->added_by=Auth::user()->name;
            return $testimonials->save() ? redirect()->back()->with('success','<div class="alert alert-success">Successfully submitted your request !!</div>') : redirect()->back()->with('success','<div class="alert alert-danger">Something went wrong. Please try again later !!!</div>');
        } else
            die('Invalid submission!');
    }

     /*
     *
     * Display the Terms Police page.
     *
     */

    protected function terms(){
         $page = Page::where('id', 11)->first();
    	 return view('pages/terms',['pageData'=>$page]);
    }

    /*
     *
     * Display venue search page.
     *
     */
     
    public function search(Request $request) {
        
        $search     = $request->search;
        $category   = $request->category;
        $location   = $request->location;
        $cat_slug   = $request->search;
        
        if(!empty($category)){
            $catData =  DB::table('categories AS C')->select('C.*','CC.slug as parent_slug')
                    ->leftJoin('categories AS CC', 'C.parent_id', '=', 'CC.id')->orWhere('C.title','like','%'.$category.'%')->orWhere('C.slug','like','%'.$category.'%')->first();
            $catData = (array) $catData;
            $categories = Category::where('status', 1)->where('slug', $category)->first();
            if($categories->parent_id == 0 || $categories->parent_id == null){
                $categories = Category::where('status', 1)->where('parent_id', $categories->id)->get()->toArray();
                $categories = array_map(function($result){
                    return $result['id'];
                },$categories);
            }else{
                $categories = $categories->id;
            }
        }

        if(isset($catData['title'])){
            $existing = DB::table('searches')->where('name',$catData['title'])->count();
            if($existing < 1) {
                DB::table('searches')->insert(['name' => $catData['title'],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);
            }
        }
        
        $query = Vendor::select("*",DB::raw("(SELECT count(vendor_ratings.vendor_id) FROM vendor_ratings WHERE vendor_ratings.vendor_id = vendors.vendor_id AND vendor_ratings.dispute_status = '0') AS rating_data_count"))->join("vendor_companies","vendor_companies.vendor_id","=","vendors.vendor_id");
        $query2 = Vendor::select("*",DB::raw("(SELECT count(vendor_ratings.vendor_id) FROM vendor_ratings WHERE vendor_ratings.vendor_id = vendors.vendor_id AND vendor_ratings.dispute_status = '0') AS rating_data_count"))->join("vendor_companies","vendor_companies.vendor_id","=","vendors.vendor_id");
        $query->where('vendors.status',1);
        $query->where('vendors.verified',1);
        $query->where('vendors.step_completed',4);
        $query2->where('vendors.status',1);
        $query2->where('vendors.verified',1);
        $query2->where('vendors.step_completed',4);
        if(isset($categories)){
            $query->join('vendor_category_relation','vendor_category_relation.vendor_id','=','vendors.vendor_id');
            $query->groupBy('vendor_category_relation.vendor_id');
            if(is_array($categories)){
                // dd($categories);
                $query->whereIn('vendor_category_relation.category_id',$categories);
            }
            else{
                $query->where('vendor_category_relation.category_id',$categories);
            }
        }
        /*if(isset($catData['slug']) && $catData['slug']!='' && $catData['is_parent'] != 1){
            $query->whereRaw(DB::raw("vendors.vendor_id IN (SELECT vendor_category_relation.vendor_id FROM vendor_category_relation JOIN categories ON categories.id = vendor_category_relation.category_id WHERE categories.id = ?)"),[$catData['id']]);
            $query2->whereRaw(DB::raw("vendors.vendor_id IN (SELECT vendor_category_relation.vendor_id FROM vendor_category_relation JOIN categories ON categories.id = vendor_category_relation.category_id WHERE categories.id = ?)"),[$catData['id']]);
        }elseif(isset($catData['slug'])){
            // parent id 1 for venues 
            $catIds = Category::select(DB::raw('group_concat(id) as ids'))->where('parent_id',$catData['id'])->first();
            // dd($catIds->ids);
            if(isset($catIds) && !empty($catIds)){
                $query->whereRaw(DB::raw("vendors.vendor_id IN (SELECT vendor_category_relation.vendor_id FROM vendor_category_relation JOIN categories ON categories.id = vendor_category_relation.category_id WHERE categories.id IN (?))"),[$catIds->ids]);
                $query2->whereRaw(DB::raw("vendors.vendor_id IN (SELECT vendor_category_relation.vendor_id FROM vendor_category_relation JOIN categories ON categories.id = vendor_category_relation.category_id WHERE categories.id IN (?))"),[$catIds->ids]);
            }
        }*/
        
        if(isset($location) && $location != '' && !empty($location)){
            $locationStr = ucwords(str_replace('-', ' ', trim($location)));
            $query->where(function($query) use ($locationStr) {
                $query->where('vendor_companies.province', $locationStr);
            });
        }
        if(!empty($search)){
            $query->where(function($subquery) use ($search) {
                $subquery->whereRaw(DB::raw("MATCH(business_name,business_detail,business_name_slug) AGAINST ('+\"$search\"')"),[$search]);
                $subquery->orWhereRaw(DB::raw("vendors.vendor_id IN (SELECT vendor_category_relation.vendor_id FROM vendor_category_relation JOIN categories ON categories.id = vendor_category_relation.category_id WHERE MATCH(categories.title,categories.description,categories.search_keywords) AGAINST ('+\"$search\"'))"),[$search]);
            });
            $query2->where(function($subquery) use ($search) {
                $subquery->whereRaw(DB::raw("MATCH(business_name,business_detail,business_name_slug) AGAINST ('+\"$search\"')"),[$search]);
                $subquery->orWhereRaw(DB::raw("vendors.vendor_id IN (SELECT vendor_category_relation.vendor_id FROM vendor_category_relation JOIN categories ON categories.id = vendor_category_relation.category_id WHERE MATCH(categories.title,categories.description,categories.search_keywords) AGAINST ('+\"$search\"'))"),[$search]);
            });
        }
       
        $query->orderBy('vendor_companies.business_name', 'asc');
        $vendorOptions = $query;
        $vendorData = $query->paginate(12)->appends(\Input::except('page'));
        
        foreach($vendorData as $key => $vls) {
            if(!empty($vls->vendor_id)){
                $cats = DB::select("SELECT parent_id FROM categories WHERE id IN (SELECT vendor_category_relation.category_id FROM vendor_category_relation WHERE vendor_category_relation.vendor_id = ".$vls->vendor_id.")");
                $cats = array_map(function($element){return $element->parent_id;},$cats);
                if(!empty($cats))
                    $vendorData[$key]['category_images'] = CategoryImages::whereIn('cat_id',(array) $cats)->limit(1)->get();
                else 
                    $vendorData[$key]['category_images'] = [];
            }else
                $vendorData[$key]['category_images'] = [];
        }
        
        $sideBarCat = Category::select('categories.id','categories.slug','categories.title',DB::raw('(select group_concat(id) from categories CAT1 where CAT1.parent_id = categories.id ) as child_group'))->where('is_parent',1)->where('status',1)->get()->toArray();
        if(isset($sideBarCat) && !empty($sideBarCat)){
            foreach($sideBarCat as $k=>$side){
                if(!empty($side['child_group'])){
                  $data = DB::select("select count(*) as total from vendors JOIN vendor_category_relation ON vendor_category_relation.vendor_id = vendors.vendor_id where vendor_category_relation.category_id IN(".$side['child_group'].") and step_completed = 4 and verified = 1 and status = 1");
                  $sideBarCat[$k]['total'] = $data[0]->total;
              }else
                  $sideBarCat[$k]['total'] = 0;
          }
        }
        if(isset($catData) && isset($catData['slug']) && $catData['slug']!='' && isset($catData['is_parent']) && $catData['is_parent'] != 1){
          $venueCat = Category::select('categories.id','categories.slug','categories.title','categories.id as child_group')->where('id',$catData['id'])->first()->toArray();
        }elseif(isset($catData['id'])){
          $venueCat = Category::select('categories.id','categories.slug','categories.title',DB::raw('(select group_concat(id) from categories CAT1 where CAT1.parent_id = categories.id ) as child_group'))->where('id',$catData['id'])->first()->toArray();
        }else{
            $venueCat = Category::select('categories.id','categories.slug','categories.title',DB::raw('(select group_concat(id) from categories CAT1 where CAT1.parent_id = categories.id ) as child_group'))->where('categories.status',1)->first()->toArray();
        }
        
        $locationData = DB::table('vendor_companies')
            ->join('vendors', 'vendor_companies.vendor_id', '=', 'vendors.vendor_id')
            ->select(DB::raw('count(vendor_companies.province) as location_count,vendor_companies.province'))
            ->groupBy('vendor_companies.province')
            ->where('vendors.status',1)
            ->where('vendors.verified',1)
            ->where('vendors.step_completed',4)
            ->get()->toArray();
        
        if(isset($catData['id'])){
            $parentId = $catData['parent_id'] ?? $catData['id'];
            $serviceType = Category::where('parent_id',$parentId)->get()->toArray();
            if(isset($serviceType) && !empty($serviceType)){
                foreach($serviceType as $k=>$side){
                  $serviceType[$k]['parent_slug'] = $catData['parent_slug'] ?? $catData['slug'];
                  $newCount = DB::select("select count(*) as total from vendors where cat_id = ".$side['id']." and step_completed = 4 and verified = 1 and status = 1");
                  $serviceType[$k]['total'] = $newCount[0]->total;
                  $serviceType[$k]['total'] = 0;
                }
            }
        } else $serviceType = [];
        
        $pageId = 3;
        $page = Page::where('id', $pageId)->first();
        $wishLists = $this->getWishLists();
        
        $cats_data = Category::where('slug',$cat_slug)->first();
        $page['search_category'] = isset($catData['title'])?$catData['title']:'';
        $page['search_province'] = '';
        $page['search_province_slug'] = '';
        $page['search_region'] = '';
        if(isset($location)) {
            $locs_data = Regions::where('region','LIKE','%'.$location.'%')->first();
            if(isset($locs_data)) {
                $page['search_province'] = $locs_data->state;
                $page['search_province_slug'] = strtolower($locs_data->state);
                $page['search_region'] = $locs_data->region;
            } else {
                $page['search_province'] = ucfirst($location);
                $page['search_province_slug'] = strtolower($location);
            }
        }
        $page['search_cat_slug'] = $cat_slug;
        $page['search_location'] = '';
        $page['categories'] = Category::getCategory();
        $page['hot_deals'] = Page::get_hot_deals();
        $page['locations'] = DB::table('regions')->groupBy('state')->where('status','=','1')->pluck('state');
        $locationCountData = $query2;
        return view('pages/wedding-venues',['pageData'=>$page,'vendorLists'=>$vendorData,'sideBarCat'=>$sideBarCat,'locationData'=>$locationData,'serviceType'=>$serviceType,'wishLists'=>$wishLists,'searchData' => $search,'locationDataString' => $location,'locationCountData' => @$locationCountData]);
    }
     
    public function search_old(Request $request) {
        
        $search = $request->search;
        $category = $request->category;
        $location = $request->location;
        $cat_slug = $request->search;
        if(!empty($category)){
            $catData =  DB::table('categories AS C')->select('C.*','CC.slug as parent_slug')
                    ->leftJoin('categories AS CC', 'C.parent_id', '=', 'CC.id')->orWhere('C.title','like','%'.$category.'%')->orWhere('C.slug','like','%'.$category.'%')->first();
            $catData = (array) $catData;
        }
        
        /*dd(DB::table('categories AS C')->select('C.*','CC.slug as parent_slug')
                    ->leftJoin('categories AS CC', 'C.parent_id', '=', 'CC.id')->orWhere('C.title','like','%'.$search.'%')->orWhere('C.slug','like','%'.$search.'%')->orwhere('C.search_keywords','like','%'.$search.'%')->get());*/
        
        // if(isset($catData) && !empty($catData)){
            //DB::enableQueryLog();
            if(isset($catData['title'])){
                $existing = DB::table('searches')->where('name',$catData['title'])->count();
                if($existing < 1) {
                    DB::table('searches')->insert(['name'=>$catData['title'],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);
                }
            }
            $query = Vendor::select('vendors.vendor_id','email','cat_id','freelisting');
            if(isset($catData['slug']) && $catData['slug']!='' && $catData['is_parent'] != 1){
                $query->whereHas('categories',function($query) use ($catData) {
                    $query->select(DB::raw("categories.*,(CASE WHEN categories.parent_id IS NULL OR categories.parent_id = 0 THEN (SELECT categories_images.images FROM categories_images WHERE categories_images.cat_id = categories.id LIMIT 1) ELSE (SELECT categories_images.images FROM categories_images WHERE categories_images.cat_id = categories.parent_id LIMIT 1) END) AS categoryImage"));
                    $query->where('category_id',$catData['id']);
                });
            }elseif(isset($catData['slug'])){
                // parent id 1 for venues 
                $catIds = Category::select(DB::raw('group_concat(id) as ids'))->where('parent_id',$catData['id'])->first();
                if(isset($catIds) && !empty($catIds)){
                    $query->whereHas('categories',function($query) use ($catIds) {
                        $query->whereIn('category_id',explode(',',$catIds->ids));
                        // echo $catIds->ids;
                    });
                }
            }
            $query->where('vendors.status',1);
            $query->where('vendors.verified',1);
            $query->where('vendors.step_completed',4);
            if(!empty($search)){
                $query->whereHas('company_data',function($query) use($search){
                    // $query->select(DB::raw("*,MATCH(business_name,business_name_slug,business_detail) as searched"));
                    /*$query->where('business_name','like','%'.$search.'%')
                    ->orWhere('business_name_slug','like','%'.$search.'%')
                    ->orwhere('business_detail','like','%'.$search.'%')
                    ;*/
                    // $query->orWhere(DB::raw("MATCH(business_name,business_name_slug,business_detail) AGAINST ('$search*' IN BOOLEAN MODE)"));
                    // $query->orderBy("searched","desc");
                    // $query->orderByRaw(DB::raw("instr(business_name, '".$search."') = 0,instr(business_name, '".$search."') desc"));
                });
                /*$query->whereHas('categories',function($query) use ($search) {
                    $query->orWhere('title','like','%'.strtolower($search).'%')->orWhere('slug','like','%'.strtolower($search).'%')->orWhere('search_keywords','like','%'.strtolower($search).'%');
                });*/
            }
            if(isset($location) && $location != '' && !empty($location)){
                $locationStr = ucwords(str_replace('-', ' ', trim($location)));
                $query->whereHas('company_data',function($query) use ($locationStr){
                    $query->where('province', '=', $locationStr);
                    $query->orWhere('city', '=', $locationStr);
                });
            }
            $query->with(['image_data','question_data','company_data' => function($query) use($search){
                if(!empty($search)){
                    // $query->on('vendor_companies.vendor_id','=','vendors.vendor_id');
                    // $query->where(DB::raw("MATCH(business_name,business_name_slug,business_detail) AGAINST ('$search' IN BOOLEAN MODE)"));
                }
            },'rating_data' => function($query) {$query->where('dispute_status','=','0');}]);
            $query->withCount(['rating_data' => function($query) {$query->where('dispute_status','=','0');}]);
            if(!empty($search)) {
                $query->with(['categories' => function($query) use($search){
                    $query->select(DB::raw("categories.*,(CASE WHEN categories.parent_id IS NULL OR categories.parent_id = 0 THEN (SELECT categories_images.images FROM categories_images WHERE categories_images.cat_id = categories.id LIMIT 1) ELSE (SELECT categories_images.images FROM categories_images WHERE categories_images.cat_id = categories.parent_id LIMIT 1) END) AS categoryImage"));
                    // $query->leftJoin("categories AS parent","parent.id","=","categories.id");
                    $query->orWhere('title','like','%'.$search.'%')->orWhere('slug','like','%'.$search.'%')->orwhere('search_keywords','like','%'.$search.'%');
                }]);
                // $query->where(DB::raw("EXISTS (SELECT * FROM categories JOIN vendor_category_relation ON vendor_category_relation.category_id = categories.id JOIN vendors ON vendors.vendor_id = vendor_category_relation.vendor_id WHERE categories.title LIKE '%$search%' OR categories.slug LIKE '%$search%' OR categories.search_keywords LIKE '%$search%' OR categories.description LIKE '%$search%')"));
                // $query->leftJoin(DB::raw("(SELECT vendor_category_relation.vendor_id FROM vendor_category_relation JOIN categories ON categories.id = vendor_category_relation.category_id WHERE categories.title LIKE '%$search%' OR categories.slug LIKE '%$search%' OR categories.search_keywords LIKE '%$search%' OR categories.description LIKE '%$search%' GROUP BY vendor_category_relation.vendor_id) vendor_category_relation"),"vendor_category_relation.vendor_id","=","vendors.vendor_id");
            }elseif(empty($category)){
                $query->with(['categories' => function($query) use($search){
                    $query->select(DB::raw("categories.*,(CASE WHEN categories.parent_id IS NULL OR categories.parent_id = 0 THEN (SELECT categories_images.images FROM categories_images WHERE categories_images.cat_id = categories.id LIMIT 1) ELSE (SELECT categories_images.images FROM categories_images WHERE categories_images.cat_id = categories.parent_id LIMIT 1) END) AS categoryImage"));
                    // $query->leftJoin("categories AS parent","parent.id","=","categories.id");
                    // $query->orWhere('title','like','%'.$search.'%')->orWhere('slug','like','%'.$search.'%')->orwhere('search_keywords','like','%'.$search.'%');
                }]);
            }
            /*$vendorData = $query->with(array('category_data'=>function($query){
               $query->select('categories.id','categories.slug','cat.slug as parent_slug','cat.title as parent_title','categories.title','categories.parent_id','categories.meta_title','categories.meta_keyword','categories.meta_description')->join('categories AS cat', 'cat.id', '=', 'categories.parent_id');
            }))->paginate(12);*/
            // echo $catData['id'];
            // dd($query->toSql());
            unset($query);
            $query = Vendor::select("*",DB::raw("(SELECT count(vendor_ratings.vendor_id) FROM vendor_ratings WHERE vendor_ratings.vendor_id = vendors.vendor_id AND vendor_ratings.dispute_status = '0') AS rating_data_count"))->join("vendor_companies","vendor_companies.vendor_id","=","vendors.vendor_id");
            $query->where('vendors.status',1);
            $query->where('vendors.verified',1);
            $query->where('vendors.step_completed',4);
            if(isset($catData['slug']) && $catData['slug']!='' && $catData['is_parent'] != 1){
                $query->whereRaw(DB::raw("vendors.vendor_id IN (SELECT vendor_category_relation.vendor_id FROM vendor_category_relation JOIN categories ON categories.id = vendor_category_relation.category_id WHERE categories.id = ?)"),[$catData['id']]);
            }elseif(isset($catData['slug'])){
                // parent id 1 for venues 
                $catIds = Category::select(DB::raw('group_concat(id) as ids'))->where('parent_id',$catData['id'])->first();
                if(isset($catIds) && !empty($catIds)){
                    // dd($catIds->ids);
                    $query->whereRaw(DB::raw("vendors.vendor_id IN (SELECT vendor_category_relation.vendor_id FROM vendor_category_relation JOIN categories ON categories.id = vendor_category_relation.category_id WHERE categories.id IN (?))"),[$catIds->ids]);
                }
            }
            if(!empty($search)){
                // $query->whereRaw(DB::raw("MATCH(business_name,business_detail,business_name_slug) AGAINST (? IN BOOLEAN MODE)"),[$search]);
                $query->whereRaw(DB::raw("MATCH(business_name,business_detail,business_name_slug) AGAINST ('+\"$search\"')"),[$search]);
                // $query->orWhereRaw(DB::raw("vendors.vendor_id IN (SELECT vendor_category_relation.vendor_id FROM vendor_category_relation JOIN categories ON categories.id = vendor_category_relation.category_id WHERE MATCH(categories.title,categories.description,categories.search_keywords) AGAINST ('*$search*' IN BOOLEAN MODE))"),[$search]);
                // $query->whereRaw(DB::raw("vendors.vendor_id IN (SELECT vendor_category_relation.vendor_id FROM vendor_category_relation JOIN categories ON categories.id = vendor_category_relation.category_id WHERE MATCH(categories.title,categories.description,categories.search_keywords) AGAINST (? IN BOOLEAN MODE))"),[$search]);
                $query->orWhereRaw(DB::raw("vendors.vendor_id IN (SELECT vendor_category_relation.vendor_id FROM vendor_category_relation JOIN categories ON categories.id = vendor_category_relation.category_id WHERE MATCH(categories.title,categories.description,categories.search_keywords) AGAINST ('+\"$search\"'))"),[$search]);
            }
            if(isset($location) && $location != '' && !empty($location)){
                $locationStr = ucwords(str_replace('-', ' ', trim($location)));
                // dd($locationStr);
                // $query->where('vendor_companies.province', '=', $locationStr);
                // $query->orWhere('vendor_companies.city', '=', $locationStr);
                $query->where(function($qu) use ($locationStr){
                    $qu->where('vendor_companies.province', '=', $locationStr);
                    // $qu->orWhere('vendor_companies.city', '=', $locationStr);
                });
            }
            $query->orderBy('vendor_companies.business_name', 'asc');
            // dd($query->toSql());
            $vendorData = $query->paginate(12)->appends(\Input::except('page'));
            // dd($vendorData);
            foreach($vendorData as $key => $vls) {
                if(!empty($vls->vendor_id)){
                    $cats = DB::select("SELECT parent_id FROM categories WHERE id IN (SELECT vendor_category_relation.category_id FROM vendor_category_relation WHERE vendor_category_relation.vendor_id = ".$vls->vendor_id.")");
                    $cats = array_map(function($element){return $element->parent_id;},$cats);
                    if(!empty($cats))
                        $vendorData[$key]['category_images'] = CategoryImages::whereIn('cat_id',(array) $cats)->limit(1)->get();
                    else 
                        $vendorData[$key]['category_images'] = [];
                }else
                    $vendorData[$key]['category_images'] = [];
                // if($vls->cat_id == 9)
                // dd($vendorData[$key]['category_images']);
            }
            ///////////////////////// SideBar Category Data   ////////////////////////////////
            $sideBarCat = Category::select('categories.id','categories.slug','categories.title',DB::raw('(select group_concat(id) from categories CAT1 where CAT1.parent_id = categories.id ) as child_group'))->where('is_parent',1)->where('status',1)->get()->toArray();
            if(isset($sideBarCat) && !empty($sideBarCat)){
                foreach($sideBarCat as $k=>$side){
                    if(!empty($side['child_group'])){
                      $data = DB::select("select count(*) as total from vendors JOIN vendor_category_relation ON vendor_category_relation.vendor_id = vendors.vendor_id where vendor_category_relation.category_id IN(".$side['child_group'].") and step_completed = 4 and verified = 1 and status = 1");
                        // echo "select count(*) as total from vendors where exists (SELECT * FROM vendor_category_relation WHERE category_id IN(".$side['child_group'].")) and step_completed = 4 and verified = 1 and status = 1";
                        // dd($data);
                      $sideBarCat[$k]['total'] = $data[0]->total;
                  }else
                      $sideBarCat[$k]['total'] = 0;
              }
            }
            /////////////////////////// SideBar Location Data  ////////////////////////////
            // dd($catData);
            if(isset($catData) && isset($catData['slug']) && $catData['slug']!='' && isset($catData['is_parent']) && $catData['is_parent'] != 1){
              $venueCat = Category::select('categories.id','categories.slug','categories.title','categories.id as child_group')->where('id',$catData['id'])->first()->toArray();
            }elseif(isset($catData['id'])){
              $venueCat = Category::select('categories.id','categories.slug','categories.title',DB::raw('(select group_concat(id) from categories CAT1 where CAT1.parent_id = categories.id ) as child_group'))->where('id',$catData['id'])->first()->toArray();
            }else{
                $venueCat = Category::select('categories.id','categories.slug','categories.title',DB::raw('(select group_concat(id) from categories CAT1 where CAT1.parent_id = categories.id ) as child_group'))->where('categories.status',1)->first()->toArray();
            }
            $locationData = DB::table('vendor_companies')
            ->leftJoin('vendors', 'vendor_companies.vendor_id', '=', 'vendors.vendor_id')
            ->select(DB::raw('count(vendor_companies.province) as location_count,vendor_companies.province'))
            ->groupBy('vendor_companies.province')
            ->where('vendors.status',1)
            ->where('vendors.verified',1)
            ->where('vendors.step_completed',4)
            // ->leftJoin('vendor_category_relation','vendor_category_relation.vendor_id','=','vendors.vendor_id')
            // ->whereIn('vendor_category_relation.category_id',explode(',',$venueCat['child_group']))
            // ->whereIn('vendors.cat_id',explode(',',$venueCat['child_group']))
            ->get()->toArray();
            /////////////////////////// Type of service  ////////////////////////////
            // if(isset($catData) && $catData['slug']!='' && $catData['is_parent'] != 1){
            //     $serviceType = Category::where('id',$catData['id'])->get()->toArray();
            // }else{
            //     $serviceType = Category::where('parent_id',$catData['id'])->get()->toArray();
            // }
            if(isset($catData['id'])){
                $parentId = $catData['parent_id'] ?? $catData['id'];
                $serviceType = Category::where('parent_id',$parentId)->get()->toArray();
                if(isset($serviceType) && !empty($serviceType)){
                    foreach($serviceType as $k=>$side){
                      $serviceType[$k]['parent_slug'] = $catData['parent_slug'] ?? $catData['slug'];
                      $newCount = DB::select("select count(*) as total from vendors where cat_id = ".$side['id']." and step_completed = 4 and verified = 1 and status = 1");
                      $serviceType[$k]['total'] = $newCount[0]->total;
                      $serviceType[$k]['total'] = 0;
                    }
                }
            } else $serviceType = [];
        /*}else{
            $vendorData = array();
            $sideBarCat = array();
            $locationData = array();
            $serviceType = array();
        }*/
        $pageId = 3;
        
        $page = Page::where('id', $pageId)->first();
        $wishLists = $this->getWishLists();
        $cats_data = Category::where('slug',$cat_slug)->first();
        $page['search_category'] = isset($catData['title'])?$catData['title']:'';
        $page['search_province'] = '';
        $page['search_province_slug'] = '';
        $page['search_region'] = '';
        if(isset($location)) {
            $locs_data = Regions::where('region','LIKE','%'.$location.'%')->first();
            if(isset($locs_data)) {
                $page['search_province'] = $locs_data->state;
                $page['search_province_slug'] = strtolower($locs_data->state);
                $page['search_region'] = $locs_data->region;
            } else {
                $page['search_province'] = ucfirst($location);
                $page['search_province_slug'] = strtolower($location);
            }
        }
        $page['search_cat_slug'] = $cat_slug;
        $page['search_location'] = '';
        // $page['search_category'] = $ca;
        $page['categories'] = Category::getCategory();
        $page['hot_deals'] = Page::get_hot_deals();
        $page['locations'] = DB::table('regions')->groupBy('state')->where('status','=','1')->pluck('state');
        // echo "<pre>"; print_r($vendorData); die;
        // dd($vendorData);
        return view('pages/wedding-venues',['pageData'=>$page,'vendorLists'=>$vendorData,'sideBarCat'=>$sideBarCat,'locationData'=>$locationData,'serviceType'=>$serviceType,'wishLists'=>$wishLists,'searchData' => $search,'locationDataString' => $location]);
    }
    
    
    public function searchString(Request $request) {
        $result = DB::table('searches')->where('name','LIKE','%'.$request->search.'%')->groupBy('name')->limit(5)->get();
        // $result = DB::table('categories')->select(DB::raw("title AS name"))->where('search_keywords','LIKE','%'.$request->search.'%')->groupBy('search_keywords')->limit(5)->get();
        return $result->toJson();
    }
    
    protected function getVenuesSearch($cat_slug,$location = null)
    {
        $catData =  DB::table('categories AS C')->select('C.*','CC.slug as parent_slug')
                    ->leftJoin('categories AS CC', 'C.parent_id', '=', 'CC.id')->where('C.slug',$cat_slug)->first();
        $catData = (array)$catData;
        if(isset($catData) && !empty($catData)){
            //DB::enableQueryLog();
            $query = Vendor::select('vendor_id','email','cat_id','freelisting');
            if(isset($catData['slug']) && $catData['slug']!='' && $catData['is_parent'] != 1){
                $query->where('vendors.cat_id',$catData['id']);
            }else{
                // parent id 1 for venues 
                $catIds = Category::select(DB::raw('group_concat(id) as ids'))->where('parent_id',$catData['id'])->first();
                if(isset($catIds) && !empty($catIds)){
                    $query->whereIn('vendors.cat_id',explode(',',$catIds->ids));
                }
            }
            $query->where('vendors.status',1);
            $query->where('vendors.verified',1);
            $query->where('vendors.step_completed',4);
            if(isset($location) && $location!=''){
                $locationStr = ucwords(str_replace('-', ' ', trim($location)));
                $query->whereHas('company_data',function($query) use ($locationStr){
                    $query->where('province', '=', $locationStr);
                    $query->orWhere('city', '=', $locationStr);
                });
            }
            $query->with('image_data','question_data','company_data','rating_data');
            $query->withCount('rating_data');
            $vendorData = $query->with(array('category_data'=>function($query){
               $query->select('categories.id','categories.slug','cat.slug as parent_slug','cat.title as parent_title','categories.title','categories.parent_id','categories.meta_title','categories.meta_keyword','categories.meta_description')->join('categories AS cat', 'cat.id', '=', 'categories.parent_id');
            }))->paginate(12);
            foreach($vendorData as $key => $vls) {
                $vendorData[$key]['category_images'] = CategoryImages::where('cat_id',$vls->cat_id)->get();
            }
            ///////////////////////// SideBar Category Data   ////////////////////////////////
            $sideBarCat = Category::select('categories.id','categories.slug','categories.title',DB::raw('(select group_concat(id) from categories CAT1 where CAT1.parent_id = categories.id ) as child_group'))->where('is_parent',1)->where('status',1)->get()->toArray();
            if(isset($sideBarCat) && !empty($sideBarCat)){
                foreach($sideBarCat as $k=>$side){
                    if(!empty($side['child_group'])){

                      $data = DB::select("select count(*) as total from vendors where cat_id IN(".$side['child_group'].") and step_completed = 4 and verified = 1 and status = 1");
                      $sideBarCat[$k]['total'] = $data[0]->total;
                  }else
                      $sideBarCat[$k]['total'] = 0;
              }
            }
            /////////////////////////// SideBar Location Data  ////////////////////////////
            if(isset($catData) && $catData['slug']!='' && $catData['is_parent'] != 1){
              $venueCat = Category::select('categories.id','categories.slug','categories.title','categories.id as child_group')->where('id',$catData['id'])->first()->toArray();
            }else{
              $venueCat = Category::select('categories.id','categories.slug','categories.title',DB::raw('(select group_concat(id) from categories CAT1 where CAT1.parent_id = categories.id ) as child_group'))->where('id',$catData['id'])->first()->toArray();
            }
            $locationData = DB::table('vendor_companies')
            ->leftJoin('vendors', 'vendor_companies.vendor_id', '=', 'vendors.vendor_id')
            ->select(DB::raw('count(vendor_companies.province) as location_count,vendor_companies.province'))
            ->groupBy('vendor_companies.province')
            ->where('vendors.status',1)
            ->where('vendors.verified',1)
            ->where('vendors.step_completed',4)
            ->whereIn('vendors.cat_id',explode(',',$venueCat['child_group']))
            ->get()->toArray();
            /////////////////////////// Type of service  ////////////////////////////
            // if(isset($catData) && $catData['slug']!='' && $catData['is_parent'] != 1){
            //     $serviceType = Category::where('id',$catData['id'])->get()->toArray();
            // }else{
            //     $serviceType = Category::where('parent_id',$catData['id'])->get()->toArray();
            // }
            $parentId = $catData['parent_id'] ?? $catData['id'];
            $serviceType = Category::where('parent_id',$parentId)->get()->toArray();
            if(isset($serviceType) && !empty($serviceType)){
                foreach($serviceType as $k=>$side){
                  $serviceType[$k]['parent_slug'] = $catData['parent_slug'] ?? $catData['slug'];
                  $newCount = DB::select("select count(*) as total from vendors where cat_id = ".$side['id']." and step_completed = 4 and verified = 1 and status = 1");
                  $serviceType[$k]['total'] = $newCount[0]->total;
                  $serviceType[$k]['total'] = 0;
                }
            }
        }else{
            $vendorData = array();
            $sideBarCat = array();
            $locationData = array();
            $serviceType = array();
        }
        $pageId = 3;
        if($cat_slug == 'wedding-venues'){ $pageId = 5; }
        $page = Page::where('id', $pageId)->first();
        $wishLists = $this->getWishLists();
        $cats_data = Category::where('slug',$cat_slug)->first();
        $page['search_category'] = isset($catData['title'])?$catData['title']:'';
        $page['search_province'] = '';
        $page['search_province_slug'] = '';
        $page['search_region'] = '';
        if($location) {
            $locs_data = Regions::where('region','LIKE','%'.$location.'%')->first();
            if(isset($locs_data)) {
                $page['search_province'] = $locs_data->state;
                $page['search_province_slug'] = strtolower($locs_data->state);
                $page['search_region'] = $locs_data->region;
            } else {
                $page['search_province'] = ucfirst($location);
                $page['search_province_slug'] = strtolower($location);
            }
        }
        $page['search_cat_slug'] = $cat_slug;
        $page['search_location'] = $location;
        $page['categories'] = Category::getCategory();
        $page['hot_deals'] = Page::get_hot_deals();
        $page['locations'] = DB::table('regions')->groupBy('state')->where('status','=','1')->pluck('state');
        // echo "<pre>"; print_r($vendorData); die;
        return view('pages/wedding-venues',['pageData'=>$page,'vendorLists'=>$vendorData,'sideBarCat'=>$sideBarCat,'locationData'=>$locationData,'serviceType'=>$serviceType,'wishLists'=>$wishLists]);
    }

    /*
    * Getting wishlist data
    */
    protected function getWishLists()
    {
        $wishList = array();
        $isLoginUser = Auth::user();
        if(isset($isLoginUser) && !empty($isLoginUser)) {
            $wishList = \App\Wishlist::where('user_id',$isLoginUser->id)->get()->toArray();
            if(isset($wishList) && !empty($wishList)) {
                $wishList = array_column($wishList,'company_id');
            }
        }
        return $wishList;
    }

    /*
     * Display the Venues and also searching vendors
     */
    protected function getVenues($slug = null,$cat_slug = null)
    {
        $catData = Category::where('slug',$slug)->first()->toArray();
        $query = Vendor::select('vendor_id','email','cat_id');
        if(isset($cat_slug) && $cat_slug!='') {
            $catId = Category::select('id','slug','title','meta_title','meta_keyword','meta_description')->where('slug',$cat_slug)->first();
            if(isset($catId) && !empty($catId)) {
                $query->where('vendors.cat_id',$catId->id);
            } else { ///// apply default //////////
                $catIds = Category::select(DB::raw('group_concat(id) as ids'))->where('parent_id',$catData['id'])->first();
                if(isset($catIds) && !empty($catIds)) {
                    $query->whereIn('vendors.cat_id',explode(',',$catIds->ids));
                }
            }
        } else { //// parent id 1 for venues 
            $catIds = Category::select(DB::raw('group_concat(id) as ids'))->where('parent_id',$catData['id'])->first();
            if(isset($catIds) && !empty($catIds)){
                $query->whereIn('vendors.cat_id',explode(',',$catIds->ids));
            }
        }
        $query->where('vendors.status',1);
        $query->where('vendors.verified',1);
        $query->where('vendors.step_completed',4);
        $query->with('image_data','company_data','question_data','rating_data');
        $query->withCount('rating_data');
        $vendorData = $query->with(array('category_data'=>function($query) {
            $query->select('categories.id','categories.slug','cat.slug as parent_slug','cat.title as parent_title','categories.title','categories.parent_id','categories.meta_title','categories.meta_keyword','categories.meta_description')->join('categories AS cat', 'cat.id', '=', 'categories.parent_id');
        }))->paginate(14);
        foreach($vendorData as $key => $vls) {
            $vendorData[$key]['category_images'] = CategoryImages::where('cat_id',$vls->cat_id)->get();
        }
        // echo "<pre>";
        // print_r($vendorData); die;
        /////////////////////////// SideBar Category Data ///////////////////////////////////
        $sideBarCat = Category::select('categories.id','categories.slug','categories.title',DB::raw('(select group_concat(id) from categories CAT1 where CAT1.parent_id = categories.id ) as child_group'))->where('is_parent',1)->where('status',1)->get()->toArray();
        if(isset($sideBarCat) && !empty($sideBarCat)) {
            foreach($sideBarCat as $k=>$side) {
                if(!empty($side['child_group'])){
                    $data = DB::select("select count(*) as total from vendors where cat_id IN(".$side['child_group'].") and verified = 1 and status = 1 and step_completed = 4");
                    $sideBarCat[$k]['total'] = $data[0]->total;
                }else
                    $sideBarCat[$k]['total'] = 0;
            }
        }
        /////////////////////////// SideBar Location Data ////////////////////////////
        if(isset($cat_slug) && $cat_slug!='' && isset($catId->id)) {
            $venueCat = Category::select('categories.id','categories.slug','categories.title','categories.id as child_group')->where('id',$catId->id)->first()->toArray();
        } else {
            $venueCat = Category::select('categories.id','categories.slug','categories.title',DB::raw('(select group_concat(id) from categories CAT1 where CAT1.parent_id = categories.id ) as child_group'))->where('id',$catData['id'])->first()->toArray();
        }
        $locationData = DB::table('vendor_companies')
        ->leftJoin('vendors', 'vendor_companies.vendor_id', '=', 'vendors.vendor_id')
        ->select(DB::raw('count(vendor_companies.province) as location_count,vendor_companies.province'))
        ->groupBy('vendor_companies.province')
        ->where('vendors.status',1)
        ->where('vendors.verified',1)
        ->where('vendors.step_completed',4)
        ->whereIn('vendors.cat_id',explode(',',$venueCat['child_group']))
        ->get()->toArray();
        /////////////////////////// Type of service  ////////////////////////////
        $serviceType = Category::where('parent_id',$catData['id'])->get()->toArray();
        if(isset($serviceType) && !empty($serviceType)){
            foreach($serviceType as $k=>$side){
                $serviceType[$k]['parent_slug'] = $catData['slug'];
                $newCount = DB::select("select count(*) as total from vendors where cat_id = ".$side['id']." and step_completed = 4 and status = 1 and verified = 1");
                $serviceType[$k]['total'] = $newCount[0]->total;
            }
        }
        $wishLists = $this->getWishLists();
        $pageId = 3;
        $page = Page::where('id', $pageId)->first();
        $page->meta_title = $catId->meta_title ?? $catData['meta_title'];
        $page->meta_keyword = $catId->meta_keyword ?? $catData['meta_keyword'];
        $page->meta_description = $catId->meta_description ?? $catData['meta_description'];
        $page['search_cat_slug'] = $cat_slug ?? $slug;
        $page['search_location'] = '';
        $page['categories'] = Category::getCategory();
        // $page['hot_deals'] = Page::get_hot_deals(); // commented by SHYAM on 15-04-20
        $page['locations'] = DB::table('regions')->groupBy('state')->where('status','=','1')->pluck('state');
        return view('pages/wedding-venues',['pageData'=>$page,'vendorLists'=>$vendorData,'sideBarCat'=>$sideBarCat,'locationData'=>$locationData,'serviceType'=>$serviceType,'wishLists'=>$wishLists]);
    }

    /*
    *
    * Display the Venues Details
    *
    */
    protected function getVenuesDetails($slug = null,$cat_slug = null,$venues_slug = null,$tab=null, $idx=null)
    {
        if($idx != '') {
            $idx = decrypt($idx);
        }
        $venID = 0;
        $query = Vendor::select('*');
        if(isset($venues_slug) && $venues_slug!='') {
            $vId = VendorCompany::select('vendor_id')->where('business_name_slug',$venues_slug)->first();
            $venID = $vId->vendor_id;
            if(isset($vId) && !empty($vId)) {
                $query->where('vendors.vendor_id',$vId->vendor_id);
            } else {
                $query->where('vendors.vendor_id',0);
            }
        }
        $query->where('vendors.status',1);
        $query->with(['image_data','company_data','rating_data','promotion_data','videos']);
        $query->withCount('rating_data');
        $vendorDetails = $query->with(array('category_data'=>function($query) {
                        $query->select('categories.id','categories.slug','cat.slug as parent_slug','cat.title as parent_title','categories.title','categories.parent_id','categories.meta_title','categories.meta_keyword','categories.meta_description')->join('categories AS cat', 'cat.id', '=', 'categories.parent_id');
        }))->first();
        if(isset($vendorDetails) && !empty($vendorDetails)) {
            $vendorDetails= $vendorDetails->toArray();
            $questionsData = DB::table('vendor_questions as VQ')->leftJoin('frequently_questions as FQ','VQ.question_id','=','FQ.id')->leftJoin('question_fields as QF','FQ.id','=','QF.question_id')->where('VQ.vendor_id',$vendorDetails['vendor_id'])->get()->toArray();
            if(isset($questionsData) && !empty($questionsData)) {
                $newArray = array();
                foreach($questionsData as $kkey=>$val) {
                    $newArray[$val->question_id]['answer'] = $val->answer;
                    $newArray[$val->question_id]['title'] = $val->title;
                    $newArray[$val->question_id]['type'] = $val->type;
                    $newArray[$val->question_id]['description'] = $val->description;
                    $newArray[$val->question_id]['label_title'] = $val->label_title;
                    $newArray[$val->question_id]['label_slug'] = $val->label_slug;
                    $newArray[$val->question_id]['options'] = $val->options;
                }
                $vendorDetails['question_data'] = $newArray;
            } else {
               $vendorDetails['question_data'] = array();
            }
            $parentCatid = Category::select('parent_id')->where('id',$vendorDetails['cat_id'])->first()->toArray();
            $vendorDetails['parent_cat_id'] =  $parentCatid['parent_id'];
        }
        $page = Page::where('id', 13)->first();
        //$page->meta_title = $vendorDetails['category_data']['business_name'] ?? $page->meta_title;
        $page->meta_title = $vendorDetails['category_data']['meta_title'] ?? $page->meta_title;
        $page->meta_keyword = $vendorDetails['category_data']['meta_keyword'] ?? $page->meta_keyword;
        $page->meta_description = $vendorDetails['category_data']['meta_description'] ?? $page->meta_description;
        $wishLists = $this->getWishLists();
        if(isset(Auth::user()->id)) {
            $userId = Auth::user()->id;
            if($userId) {
                if(!VendorView::where('user_id', '=', $userId)->whereYear('created_at', date('Y'))->exists()) {
                    $vendorViewObj = new VendorView;
                    $vendorViewObj->vendor_id = $vId->vendor_id;
                    $vendorViewObj->user_id = $userId;
                    $vendorViewObj->save();
                }
            }
        }
        $vendorDetails['location'] = DB::table('vendor_locations')
                        ->join('cities','cities.id','=','vendor_locations.city_id')
                        ->join('states','states.id','=','cities.state_id')
                        ->join('countries','countries.id','=','states.country_id')
                        ->select('vendor_locations.*','cities.name as city','states.name as state','countries.id as country_id','countries.name as country')
                        ->where(['vendor_locations.is_primary'=>1,'vendor_locations.vendor_id'=>$vendorDetails['vendor_id']])->first();
        $vendorDetails['vendor_map'] = DB::table('vendor_locations')
                        ->join('cities','cities.id','=','vendor_locations.city_id')
                        ->join('states','states.id','=','cities.state_id')
                        ->join('countries','countries.id','=','states.country_id')
                        ->select('vendor_locations.*','cities.name as city','states.name as state','countries.id as country_id','countries.name as country')
                        ->where(['vendor_locations.vendor_id'=>$vendorDetails['vendor_id']])->get();
        $vendorDetails['deals_count'] = VendorDeal::join('deal_types','deal_types.id','=','vendor_deals.deal_type_id')
                        ->select('vendor_deals.id','vendor_deals.name as deal_name','vendor_deals.photo','vendor_deals.status','deal_types.name as type','vendor_deals.expiry_date as end_date')
                        ->where('vendor_id',$vendorDetails['vendor_id'])->count();
        $vendorDetails['photos_count'] = VendorImage::where(['status'=>1,'vendor_id'=>$vendorDetails['vendor_id']])->orderBy('is_logo','asc')->count();
        $vendorDetails['videos_count'] = VendorVideo::where('vendor_id',$vendorDetails['vendor_id'])->orderBy('sort_order','asc')->count();
        $vendorDetails['cat_images'] = CategoryImages::where('cat_id',$vendorDetails['cat_id'])->get();
        $vendor_faqs   = VendorFaq::where('vendor_id',$vendorDetails['vendor_id'])->orderBy('question_id','ASC')->get();
        $faq_ans_arr=array();
        foreach ($vendor_faqs as $faq) {
            if($faq->question_id==1) {
                $faq_ans_arr['fd_arr'][]=DB::table('faq_floral_designs')->where('status','1')->whereIn('id',explode(",",$faq->answer))->orderBy('sort_order','asc')->get();
            }
            if($faq->question_id==2) {
                $faq_ans_arr['fs_arr'][]=DB::table('faq_floral_services')->select(DB::raw('group_concat(name) as name'))->where('status','1')->whereIn('id',explode(",",$faq->answer))->orderBy('sort_order','asc')->get();
            }
            if($faq->question_id==3) {
                $faq_ans_arr['ta_arr'][]=DB::table('faq_type_arrangements')->select(DB::raw('group_concat(name) as name'))->where('status','1')->whereIn('id',explode(",",$faq->answer))->orderBy('sort_order','asc')->get();
            }
            if($faq->question_id==10) {
                $faq_ans_arr['cost_fd_arr'][]=DB::table('faq_floral_services')->where('status','1')->whereIn('id',explode(",",$faq->answer))->orderBy('sort_order','asc')->get();
            }
            if($faq->question_id==4) {
                $faq_ans_arr['price_bridal'][]=number_format(str_replace("$","",$faq->answer),2);
            }
            if($faq->question_id==5) {
                $faq_ans_arr['price_bridesmaid'][]=number_format(str_replace("$","",$faq->answer),2);
            }
            if($faq->question_id==6) {
                $faq_ans_arr['price_boutonniere'][]=number_format(str_replace("$","",$faq->answer),2);
            }
            if($faq->question_id==7) {
                $faq_ans_arr['price_low_tbl'][]=number_format(str_replace("$","",$faq->answer),2);
            }
            if($faq->question_id==8) {
                $faq_ans_arr['price_elevated_tbl'][]=number_format(str_replace("$","",$faq->answer),2);
            }
            if($faq->question_id==9) {
                $faq_ans_arr['price_customer_expect'][]=number_format(str_replace("$","",$faq->answer),2);
            }
        }
        /*echo '<pre>';print_r($vendorDetails); die;*/
        $vendorDetails['faq_ans_arr'] = $faq_ans_arr;
        $sessionName = 'vendor_'.$venID;
        if(!Session::get($sessionName)) {
            $venData = VendorCompany::where('vendor_id',$venID)->first();
            $totalVisits = $venData->visits + 1;
            $venData->visits = $totalVisits;
            Session::put('vendor_'.$venID, 'done');
            $venData->save();
            if($venData->id) {
                $vendorVisits = new VendorVisitsCount();
                if(isset(Auth::user()->id)) {
                    $vendorVisits->user_id = Auth::user()->id;
                }
                $vendorVisits->vendor_id   = $venID;
                $vendorVisits->visits      = 1;
                $vendorVisits->save();
            }
        }
        // echo "<pre>"; print_r($vendorDetails); die();
        return view('pages/venues-details',['pageData'=>$page,'vendorDetails'=>$vendorDetails,'wishLists'=>$wishLists,'idx'=>$idx]);
    }
    
    public function autocomplete_latlong_by_slug(Request $request)
    {
        $vendor = VendorCompany::where('business_name_slug',$request->slug)->first();
        $address = urlencode($vendor->business_address);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false&key=".env('GMAP_API_KEY_NEW');
        // echo $url,"<br>";
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
                return $resp;
            }
        } else {
            $address = urlencode($vendor->postal_code);
            $url = "https://maps.googleapis.com/maps/api/geocode/json?components=postal_code:$address&sensor=false&key=".env('GMAP_API_KEY_NEW');
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
                    return $resp;
                }
            }
            return $resp;
        }
    }

    public function autocomplete_latlong(Request $request)
    {
        // die('Some');
        // $request->server('HTTP_ACCEPT_LANGUAGE');
        $address = '';
        $evCity = $request->city;
        $evAddress = $request->address;
        if($evAddress != '' && $evCity != '') {
            $address = $evAddress.', '.$evCity;
        } elseif($evCity != '') {
            $address = $evCity;
        }
        // $address = urlencode($address);
        $address = urlencode($evAddress);
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

    /*
    *
    * Display the Contact Us page.
    *
    */

    protected function contact(){
         $page = Page::where('id', 4)->first();
         return view('pages/contact',['pageData'=>$page]);
    }

    /*
    *
    * Save Contact Us page Enquiry.
    *
    */
    protected function sendEnquiry(Request $request)
    {
        $contactObj = new ContactEnquiry;
        $this->validate($request, [
             'name' => 'required|string',
             'email' => 'required|email',
             'comment' => 'required',
         ],['name.required'=>'Name field is required.',
         'email.required'=>'Email address field is required.',
         'comment.required'=>'Comment Field field is required.',]);
         
        $secret = '6Lfst80ZAAAAAPTWQ9HRsMWqS_uwvob6egLpXdyQ';
        $captchaId = $request->input('g-recaptcha-response');
        $responseCaptcha = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captchaId));
        
        if($responseCaptcha->success) {
            $contactObj->user_id = 0;
            if(Auth::check()){
               $contactObj->user_id = Auth::user()->id;
            }
            $contactObj->name = $request->input('name');
            $contactObj->email = $request->input('email');
            $contactObj->reason = $request->input('reason');
            $contactObj->phone = $request->input('phone');
            $contactObj->comment = $request->input('comment');
            $contactObj->form_data = 1;
            $data = $contactObj->save();
            if($data){
                Mail::to($request->input('email'))->send(new WhoIsSiteMail($request->input('email')));
                return redirect('contact')->with('success', 'Enquiry has been sent successfully.');
            }else{
              return redirect('contact')->with('success', 'Something went wrong. Please try again.');
            }
        } else
            return redirect('contact')->with('success', 'Invalid format of data !');
    }

    protected function sendRequestEnquiry(Request $request)
    {
        // return $request->all();
        $contactObj = new ContactEnquiry;
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
        ],[ 'name.required'=>'Name field is required.',
            'email.required'=>'Email address field is required.',
            'phone.required'=>'Phone number is required.']);
        $eventDate = null;
        $secret = '6Lfst80ZAAAAAPTWQ9HRsMWqS_uwvob6egLpXdyQ';
        $captchaId = $request->input('g-recaptcha-response');
        $responseCaptcha = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captchaId));
        
        if($responseCaptcha->success) {
            if($request->input('event_date') !== null && $request->input('event_date') != '') {
                $myDateTime = \DateTime::createFromFormat('d/m/Y', $request->input('event_date'));
                $eventDate = $myDateTime->format('Y-m-d');
            }
            //// If user login or new user request......
            $contactObj->user_id = 0;
            if(Auth::check()) {
                $contactObj->user_id = Auth::user()->id;
            } else {
                if(User::where('email',  $request->input('email'))->exists()) {
                    $userobj = User::where('email',  $request->input('email'))->first();
                    $contactObj->user_id = $userobj->id;
                } else {
                    $user = User::create([
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'event_date' => $eventDate,
                        'phone' => $request->input('phone'),
                        'password' => bcrypt('123@perfect'),
                        'guest' => 1,
                    ]);
                    $contactObj->user_id = $user->id;
                    $subject = 'Account Verify and Access';
                    $viewfile = 'guest_user_verify';
                    // Mail::to($request->input('email'))->send(new GuestUserVerifyLink($user->toArray(),$subject,$viewfile));
                }
            }
            $contactObj->name = $request->input('name');
            $contactObj->email = $request->input('email');
            $contactObj->number_of_guests = $request->input('number_of_guests');
            $contactObj->event_date = $eventDate;
            $contactObj->phone = $request->input('phone');
            $contactObj->comment = $request->input('comment');
            $contactObj->company_id = $request->input('company_id');
            $contactObj->form_data = 2;
            $data = $contactObj->save();
            if($data) {
                $compayData = DB::select('select V.vendor_id,V.telephone,V.email,V.message_notify_email,V.mobile,V.freelisting,V.cat_id,CT.title,VC.business_name,VC.business_address,VC.province,VC.country from vendors AS V left join vendor_companies as VC ON V.vendor_id = VC.vendor_id left join categories as CT ON V.cat_id = CT.id where VC.id = :id', ['id' => $contactObj->company_id]);
                //// Mail to user....
                $roleType = '';
                $subject = "Your enquiry has been sent";
                $viewm = 'request_enquiry_sent';
                Mail::to($request->input('email'))->send(new RequestEnquirySent($contactObj->toArray(),$compayData,$subject,$viewm,$roleType));
                //// Mail to Admin....
                if($compayData[0]->freelisting == 'Yes') {
                    $roleType = 'admin';
                    $subject = "New Lead for Free Listing Vendor";
                    $viewm = 'freeListing_enquiry_sent'; //citstestdev@gmail.com  //cesario@indigitalgroup.ca
                    Mail::to('cesario@perfectweddingday.ca')->send(new RequestEnquirySent($contactObj->toArray(),$compayData,$subject,$viewm,$roleType));
                }
                //// Mail to vendor....
                if($compayData[0]->freelisting == 'Yes') {
                    $roleType = 'vendor';
                    $subject = "You have a lead waiting for you!";
                    $viewm = 'freeListing_enquiry_sent';
                    $vendorData = Vendor::leftJoin('vendor_companies as VC','VC.vendor_id','=','vendors.vendor_id')->select('vendors.*','VC.business_name','VC.business_address','VC.province','VC.country')->where('vendors.cat_id',$compayData[0]->cat_id)->where('vendors.freelisting','Yes')->where('vendors.status','1')->take(1)->get();
                    foreach($vendorData as $vdt) {
                        if($vdt->company_data->province == $compayData[0]->province) {
                            $vendorEmail = $vdt->email;
                            if($vdt->message_notify_email != '' && $vdt->message_notify_email != NULL) {
                                $vendorEmail = $vdt->message_notify_email;
                            }
                            if($vendorEmail != '') {
                                $compayData[0]->business_name = $vdt->company_data->business_name;
                                $compayData[0]->vendor_id = $vdt->vendor_id;
                                $compayData[0]->telephone = $vdt->telephone;
                                $compayData[0]->business_address = $vdt->company_data->business_address;
                                $compayData[0]->province = $vdt->company_data->province;
                                $compayData[0]->country = $vdt->company_data->country;
                                // Mail::to($vendorEmail)->bcc('cesario@perfectweddingday.ca')->send(new RequestEnquirySent($contactObj->toArray(),$compayData,$subject,$viewm,$roleType));
                                // Mail::to('cesario@perfectweddingday.ca')->send(new RequestEnquirySent($contactObj->toArray(),$compayData,$subject,$viewm,$roleType));
                            }
                        }
                    }
                } else {
                    $vendorEmail = $compayData[0]->email;
                    if($compayData[0]->message_notify_email != '' && $compayData[0]->message_notify_email != NULL) {
                        $vendorEmail = $compayData[0]->message_notify_email;
                    }
                    if($vendorEmail != '') {
                        $roleType = '';
                        $subject = "People are looking at your business!";
                        $viewm ='admin_request_enquiry';
                        Mail::to($vendorEmail)->bcc(env('ADMIN_EMAIL'))->send(new RequestEnquirySent($contactObj->toArray(),$compayData,$subject,$viewm,$roleType,$vendorEmail));
                        // Mail::to('cesario@perfectweddingday.ca')->send(new RequestEnquirySent($contactObj->toArray(),$compayData,$subject,$viewm,$roleType));
                    }
                }
                echo json_encode(array('errorVal'=> false,'msg'=>'Enquiry has been sent successfully.'));
            } else {
                echo json_encode(array('errorVal'=> true,'msg'=>'Whoops, looks like something went wrong.'));
            }
        } else {
            echo json_encode(array('errorVal'=>true,'msg'=>'Whoops, looks like something went wrong.'));
             return;
        }
        
    }

    protected function pageSendRequestEnquiry(Request $request)
    {
        $contactObj = new ContactEnquiry;
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            // 'phone' => 'required|regex:/[0-9]{10}/',
            'phone' => 'required',
        ],['name.required'=>'Name field is required.',
        'email.required'=>'Email address field is required.',
        'phone.required'=>'Phone number is required.']);
        $secret = '6Lfst80ZAAAAAPTWQ9HRsMWqS_uwvob6egLpXdyQ';
        $captchaId = $request->input('g-recaptcha-response');
        $responseCaptcha = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captchaId));
        
        if(!isset($responseCaptcha->success)) {
             echo json_encode(array('errorVal'=>true,'msg'=>'Whoops, looks like something went wrong.'));
             return;
        }
        $checkNews = UserNewsletter::where('email_id',$request->input('email'))->where('status',0)->count();
        if($request->newsletter == '1'){
            if(!$checkNews){
                $newsObj = new UserNewsletter;
                $newsObj->email_id = $request->email;
                $newsObj->save();
            }
        }
        $eventDate = null;
        if($request->input('event_date') !== null && $request->input('event_date') != '') {
            $myDateTime = \DateTime::createFromFormat('d/m/Y', $request->input('event_date'));
            $eventDate = $myDateTime->format('Y-m-d');
        }
        //// If user login or new user request....
        $contactObj->user_id = 0;
        /*if(Auth::check()) {
           $contactObj->user_id = Auth::user()->id;
        } else {
            if(User::where('email',  $request->input('email'))->exists()) {
                $userobj = User::where('email',  $request->input('email'))->first();
                $contactObj->user_id = $userobj->id;
            } else {
                $user = User::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'event_date' => $eventDate,
                    'phone' => $request->input('phone'),
                    'password' => bcrypt('123@perfact'),
                    'guest' => 1,
                ]);
                $contactObj->user_id = $user->id;
                $subject = 'Account Verify and Access';
                $viewfile = 'guest_user_verify';
                Mail::to($request->input('email'))->send(new GuestUserVerifyLink($user->toArray(),$subject,$viewfile));
            }
        }*/
        $contactObj->name = $request->input('name');
        $contactObj->email = $request->input('email');
        $contactObj->number_of_guests = $request->input('number_of_guests');
        $contactObj->event_date = $eventDate;
        $contactObj->phone = $request->input('phone');
        $contactObj->comment = $request->input('comment');
        $contactObj->company_id = $request->input('company_id');
        $contactObj->form_data = 2;
        $data = $contactObj->save();
        if($data) {
            $compayData = DB::select('SELECT V.vendor_id,V.username,V.telephone,V.email,V.message_notify_email,V.mobile,V.freelisting,V.cat_id,CT.title,VC.business_name,VC.business_address,VC.province,VC.country,VC.business_name_slug,vendor_images.vendor_folder,vendor_images.image from vendors AS V left join vendor_companies as VC ON V.vendor_id = VC.vendor_id left join categories as CT ON V.cat_id = CT.id left join (SELECT * FROM vendor_images GROUP BY vendor_id ORDER BY is_logo DESC) AS vendor_images ON V.vendor_id = vendor_images.vendor_id where VC.id = :id', ['id' => $contactObj->company_id]);
            $blogs = BlogPost::with('categories')->latest()->inRandomOrder()->limit(3)->get();
            Mail::to($contactObj->email)->send(new PatientAutoResponderMail($contactObj->name,$contactObj->email,$compayData[0],[],$blogs));
            //// Mail to user....
            $roleType = '';
            $subject = "Your enquiry has been sent";
            $viewm = 'request_enquiry_sent';
            // Mail::to($request->input('email'))->send(new RequestEnquirySent($contactObj->toArray(),$compayData,$subject,$viewm,$roleType));
            //// Mail to Admin....
            if($compayData[0]->freelisting == 'Yes') {
                $roleType = 'admin';
                $subject = "New Lead for Free Listing Vendor";
                $viewm = 'freeListing_enquiry_sent';
                Mail::to('cesario@perfectweddingday.ca')->send(new RequestEnquirySent($contactObj->toArray(),$compayData,$subject,$viewm,$roleType));
            }
            //// Mail to vendor....
            if($compayData[0]->freelisting == 'Yes') {
                $roleType = 'vendor';
                $subject = "You have a lead waiting for you!";
                $viewm = 'freeListing_enquiry_sent';
                $vendorData = Vendor::leftJoin('vendor_companies as VC','VC.vendor_id','=','vendors.vendor_id')->select('vendors.*','VC.business_name','VC.business_address','VC.province','VC.country')->where('vendors.cat_id',$compayData[0]->cat_id)->where('vendors.freelisting','Yes')->where('vendors.status','1')->take(1)->get();
                foreach($vendorData as $vdt) {
                    if($vdt->company_data->province == $compayData[0]->province) {
                        $vendorEmail = $vdt->email;
                        if($vdt->message_notify_email != '' && $vdt->message_notify_email != NULL) {
                            // $vendorEmail = $vdt->message_notify_email;
                        }
                        if($vendorEmail != '') {
                            $compayData[0]->business_name = $vdt->company_data->business_name;
                            $compayData[0]->vendor_id = $vdt->vendor_id;
                            $compayData[0]->telephone = $vdt->telephone;
                            $compayData[0]->business_address = $vdt->company_data->business_address;
                            $compayData[0]->province = $vdt->company_data->province;
                            $compayData[0]->country = $vdt->company_data->country;
                            Mail::to($vendorEmail)->bcc('cesario@perfectweddingday.ca')->send(new RequestEnquirySent($contactObj->toArray(),$compayData,$subject,$viewm,$roleType));
                            // Mail::to('cesario@perfectweddingday.ca')->send(new RequestEnquirySent($contactObj->toArray(),$compayData,$subject,$viewm,$roleType));
                        }
                    }
                }
            } else {
                $vendorEmail = $compayData[0]->email;
                if($compayData[0]->message_notify_email != '' && $compayData[0]->message_notify_email != NULL) {
                    $vendorEmail = $compayData[0]->message_notify_email;
                }
                /*if($vendorEmail != '') {
                    $roleType = '';
                    $subject = "New enquiry has been received";
                    $viewm ='admin_request_enquiry';
                    // Mail::to($vendorEmail)->send(new RequestEnquirySent($contactObj->toArray(),$compayData,$subject,$viewm,$roleType));
                    // Mail::to('cesario@perfectweddingday.ca')->send(new RequestEnquirySent($contactObj->toArray(),$compayData,$subject,$viewm,$roleType));
                }*/
            }
            return redirect()->back()->with('success', 'Enquiry has been sent successfully.');
        } else {
            return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    protected function save_newsletter(Request $request){
        $newsObj = new UserNewsletter;
        $this->validate($request, [
             'email' => 'required|email',
         ],['email.required'=>'Email address field is required.']);
        $newsObj->email_id = $request->input('email');
        $data = $newsObj->save();
        if($data){
            echo json_encode(array('errorVal'=>false,'msg'=>'Newsletter has been created.'));
        }else{
            echo json_encode(array('errorVal'=>true,'msg'=>'Whoops, looks like something went wrong.'));
        }
    }

    protected function save_review(Request $request)
    {
        $contactObj = new VendorRating;
        $this->validate($request, [
             'rname' => 'required|string',
             'remail' => 'required|email',
             'score' => 'required',
         ],['name.required'=>'Name field is required.',
         'email.required'=>'Email address field is required.',
         'score.required'=>'Rating is required.']);
        $checkUser = User::where('email',$request->input('remail'))->first();
        $contactObj->vendor_id = $request->input('vendor_id');
        $vendorObj = Vendor::with('company_data')->where('vendor_id',$contactObj->vendor_id)->get();
        $vendorEmail = $vendorObj[0]->email;
        if(isset($checkUser->id))
            $contactObj->user_id = $checkUser->id;
        // $contactObj->user_id = Auth::id();
        $contactObj->name = $request->input('rname');
        // $contactObj->email = Auth::user()->email;
        $contactObj->email = $request->input('remail');
        $contactObj->quality_of_service = 0;
        $contactObj->responsiveness = 0;
        $contactObj->professionalism = 0;
        $contactObj->value = 0;
        $contactObj->flexibility = 0;
        $contactObj->average_rating = $request->input('score');
        $contactObj->review_description = $request->input('review_description');
        $contactObj->request_id = $request->input('request_id');
        $data = $contactObj->save();
        if($data) {
            if($request->input('request_id') != '') {
                $reviewRequest = ReviewRequest::find($request->input('request_id'));
                $reviewRequest->request_status = '1';
                $reviewRequest->save();
            }
            if(!empty($vendorEmail))
            Mail::to($vendorEmail)->bcc('cesario@perfectweddingday.ca')->send(new RequestEnquirySent($contactObj->toArray(),$vendorObj,'You have a lead waiting for you!','freeListing_enquiry_sent','vendor'));
            $subject = "Your review has been sent";
            $viewm = 'request_enquiry_sent';
            if(!empty($request->input('email')))
            Mail::to($request->input('email'))->send(new RequestEnquirySent($contactObj->toArray(),$vendorObj,$subject,$viewm,''));
            return redirect()->back()->with('message', '<span class="alert alert-success">Review has been sent successfully.</span>');
        } else {
            return redirect()->back()->with('message', '<span class="alert alert-denger">Something went wrong. Please try again.</span>');
        }       
        /*if(Auth::check())
        {
        } else {
            return redirect('login');
        }*/
    }


    /*
    *
    * Guest Account verifications
    *
    */

    public function guest_account_verify($id) {

        $userid = base64_decode($id);

        if(!User::where('id', $userid)->exists()) {
            return redirect('/');
            exit;
        }
        $countries = Countries::where('status',1)->get()->toArray();
        $userObj = User::where('id', $userid)->first();

        if($userObj->guest) {
            return redirect('/login');
        }
       
        return view('pages.guest-account-verify', [ 'userObj' => $userObj, 'countries' => $countries ] );

    }


    /*
    *
    *   Post data to verify link and access acount
    *
    */

    public function post_guest_account_verify(Request $request) {

       // dd($request->all());

        $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6',
                'address' => 'required',
                'event_role' => 'required',
            ],['name.required'=>'First and Last Name field is required.',
            'email.required'=>'Email id field is required.',
            'password.required'=>'Password field is required.',
            'address.required'=>'Live in place field is required.',
            'event_role.required'=>'You must select your role in this event.',
            ]);


         $eventDate = null;
        if($request->input('event_date') !== null && $request->input('event_date') != ''){
            $myDateTime = \DateTime::createFromFormat('d/m/Y', $request->input('event_date'));
            $eventDate = $myDateTime->format('Y-m-d');
        }

        $userUpdateobj = User::find(base64_decode($request->user_id));
        $userUpdateobj->password = bcrypt($request->password);
        $userUpdateobj->address = $request->address;
        $userUpdateobj->country = $request->country;
        $userUpdateobj->event_role = $request->event_role;
        $userUpdateobj->mail_allow = $request->mail_allow;
        $userUpdateobj->phone = $request->phone;
        $userUpdateobj->guest = 1;
        $userUpdateobj->save();

        if($request->event_role != 'other'){
            UserPartners::create([
                'user_id' => $userUpdateobj->id,
                'name' => $request->name,
                'wedding_date' => $eventDate,
                'gender' => $request->event_role,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $listData = \App\TodoListCategory::where('status','=','1')->get()->toArray();
        if(isset($listData) && !empty($listData)) {
            $budgetArray = array();
            $counter = 0;
            foreach($listData as $cats){
                $initBudgets =  \App\initBudgets::where('cat_id',$cats['cat_id'])->where('status','=','1')->get()->toArray();
                if(!empty($initBudgets)){
                    foreach($initBudgets as $intb){                   
                    $budgetArray[$counter]['user_id'] = $userUpdateobj->id;
                    $budgetArray[$counter]['cat_id'] = $cats['cat_id'];
                    $budgetArray[$counter]['concept'] = $intb['title'];
                    $budgetArray[$counter]['estimate_budget'] = $intb['budget'];
                    $budgetArray[$counter]['final_cost'] = 0;
                    $budgetArray[$counter]['paid'] = 0;
                    $budgetArray[$counter]['pending'] = 0;
                    $budgetArray[$counter]['task_id'] = 0;
                    $budgetArray[$counter]['paid_date'] = '0000-00-00';
                    $counter++;
                    }
                }
            }
        }
        if(isset($budgetArray)){
            \App\userBudget::insert($budgetArray);
            $totalBudgetArray['user_id'] = $userUpdateobj->id;
            $totalBudgetArray['total_estimate'] = array_sum(array_column($budgetArray,'estimate_budget'));
            $totalBudgetArray['created_at'] = date('Y-m-d H:i:s');
            $totalBudgetArray['updated_at'] = date('Y-m-d H:i:s');
            \App\userTotalEstimateBudget::insert($totalBudgetArray);

        }
        /////////////////////////////////////
        Event::fire(new UserCreated($userUpdateobj));

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect()->intended('dashboard');
        } else {
            echo "error";
            die();
        }
    }

    protected function reviewRequestMail()
    {
        return view('pages/review_request_mail');
    }

    public function getSingleVendor($business_slug)
    {
        $idx = null;
        if(isset($idx)) {
            $idx = decrypt($idx);
        }
        $venID = 0;
        $query = Vendor::select('*');
        $vId = VendorCompany::select('vendor_id')->where('business_name_slug',$business_slug)->orderBy('id','desc')->first();
        $venID = $vId->vendor_id;
        $teamMembers = VendorTeammember::where(['vendor_id'=> $venID ])->orderBy('biography')->get();
        $blogs = BlogPost::select('blog_posts.*',DB::raw("DATE_FORMAT(blog_posts.created_at,'%d') AS day"),DB::raw("DATE_FORMAT(blog_posts.created_at,'%M') AS month"),DB::raw("DATE_FORMAT(blog_posts.created_at,'%Y') AS year"),DB::raw("DATE_FORMAT(blog_posts.created_at,'%d, %Y') AS display_dates"),'blog_categories.name as category','blog_categories.slug as category_slug');
		$blogs->where('vendor_id',$venID);
		$blogs->join('blog_categories',function($query){
			$query->on('blog_categories.id','=','blog_posts.blog_category_id');
		});
		$blogs->where('approved',1);
		$blogs->where('published',1);
		$blogs = $blogs->paginate(10);
// 		dd($blogs);
        if(isset($vId) && !empty($vId)) {
            $query->where('vendors.vendor_id',$vId->vendor_id);
        } else {
            $query->where('vendors.vendor_id',0);
        }
        $query->where('vendors.status',1);
        $query->with(['image_data','company_data','rating_data' => function($query) {$query->where('dispute_status','=','0');},'promotion_data','videos']);
        $query->withCount(['rating_data' => function($query) {$query->where('dispute_status','=','0');}]);
        // dd($vId->vendor_id);
        // dd($query->toSql());
        $query->with(array('category_data'=>function($query) {
                        $query->select('categories.id','categories.slug','cat.slug as parent_slug','cat.title as parent_title','categories.title','categories.parent_id','categories.meta_title','categories.meta_keyword','categories.meta_description')->join('categories AS cat', 'cat.id', '=', 'categories.parent_id');
        }));
        // dd($query->toSql());
        $vendorDetails = $query->first();
        if($vendorDetails == null) return redirect('/');
        if(isset($vendorDetails) && !empty($vendorDetails)) {
            $vendorDetails= $vendorDetails->toArray();
            $questionsData = DB::table('vendor_questions as VQ')->leftJoin('frequently_questions as FQ','VQ.question_id','=','FQ.id')->leftJoin('question_fields as QF','FQ.id','=','QF.question_id')->where('VQ.vendor_id',$vendorDetails['vendor_id'])->get()->toArray();
            if(isset($questionsData) && !empty($questionsData)) {
                $newArray = array();
                foreach($questionsData as $kkey=>$val) {
                    $newArray[$val->question_id]['answer'] = $val->answer;
                    $newArray[$val->question_id]['title'] = $val->title;
                    $newArray[$val->question_id]['type'] = $val->type;
                    $newArray[$val->question_id]['description'] = $val->description;
                    $newArray[$val->question_id]['label_title'] = $val->label_title;
                    $newArray[$val->question_id]['label_slug'] = $val->label_slug;
                    $newArray[$val->question_id]['options'] = $val->options;
                }
                $vendorDetails['question_data'] = $newArray;
            } else {
               $vendorDetails['question_data'] = array();
            }
            $cats = VendorCategoryRelation::select('category_id')->where('vendor_id',$vendorDetails['vendor_id'])->get()->toArray();
            /*$catsImplode = implode(',', array_map(function($entry){
                return $entry['category_id'];
            }, $cats));*/
            $catsIds = array_map(function($entry){
                return $entry['category_id'];
            }, $cats);
            // dd($cats);
            if(empty($catsIds))
                $catsIds[] = -1;
            $parentCatid = Category::select('parent_id')->whereIn('id',$catsIds)->first();
            $vendorDetails['parent_cat_id'] =  $parentCatid['parent_id'];
            $vendorDetails['cat_images'] = CategoryImages::whereIn('cat_id',$catsIds)->get();
            // print_r(count($vendorDetails['cat_images']));die;
        }
        $page = Page::where('id', 13)->first();
        //$page->meta_title = $vendorDetails['category_data']['business_name'] ?? $page->meta_title;
        $page->meta_title = $vendorDetails['category_data']['meta_title'] ?? $page->meta_title;
        $page->meta_keyword = $vendorDetails['category_data']['meta_keyword'] ?? $page->meta_keyword;
        $page->meta_description = $vendorDetails['category_data']['meta_description'] ?? $page->meta_description;
        $wishLists = $this->getWishLists();
        if(isset(Auth::user()->id)) {
            $userId = Auth::user()->id;
            if($userId) {
                if(!VendorView::where('user_id', '=', $userId)->whereYear('created_at', date('Y'))->exists()) {
                    $vendorViewObj = new VendorView;
                    $vendorViewObj->vendor_id = $vId->vendor_id;
                    $vendorViewObj->user_id = $userId;
                    $vendorViewObj->save();
                }
            }
        }
        $vendorDetails['location'] = DB::table('vendor_locations')
                        ->join('cities','cities.id','=','vendor_locations.city_id')
                        ->join('states','states.id','=','cities.state_id')
                        ->join('countries','countries.id','=','states.country_id')
                        ->select('vendor_locations.*','cities.name as city','states.name as state','countries.id as country_id','countries.name as country')
                        ->where(['vendor_locations.is_primary'=>1,'vendor_locations.vendor_id'=>$vendorDetails['vendor_id']])->first();
        $vendorDetails['vendor_map'] = DB::table('vendor_locations')
                        ->join('cities','cities.id','=','vendor_locations.city_id')
                        ->join('states','states.id','=','cities.state_id')
                        ->join('countries','countries.id','=','states.country_id')
                        ->select('vendor_locations.*','cities.name as city','states.name as state','countries.id as country_id','countries.name as country')
                        ->where(['vendor_locations.vendor_id'=>$vendorDetails['vendor_id']])->get();
        $vendorDetails['deals_count'] = VendorDeal::join('deal_types','deal_types.id','=','vendor_deals.deal_type_id')
                        ->select('vendor_deals.id','vendor_deals.name as deal_name','vendor_deals.photo','vendor_deals.status','deal_types.name as type','vendor_deals.expiry_date as end_date')
                        ->where('vendor_id',$vendorDetails['vendor_id'])->count();
        $vendorDetails['photos_count'] = VendorImage::where(['status'=>1,'vendor_id'=>$vendorDetails['vendor_id']])->orderBy('is_logo','asc')->count();
        $vendorDetails['videos_count'] = VendorVideo::where('vendor_id',$vendorDetails['vendor_id'])->orderBy('sort_order','asc')->count();
        $vendorDetails['cat_images'] = CategoryImages::where('cat_id',$vendorDetails['cat_id'])->get();
        $vendor_faqs   = VendorFaq::where('vendor_id',$vendorDetails['vendor_id'])->orderBy('question_id','ASC')->get();
        $faq_ans_arr=array();
        foreach ($vendor_faqs as $faq) {
            if($faq->question_id==1) {
                $faq_ans_arr['fd_arr'][]=DB::table('faq_floral_designs')->where('status','1')->whereIn('id',explode(",",$faq->answer))->orderBy('sort_order','asc')->get();
            }
            if($faq->question_id==2) {
                $faq_ans_arr['fs_arr'][]=DB::table('faq_floral_services')->select(DB::raw('group_concat(name) as name'))->where('status','1')->whereIn('id',explode(",",$faq->answer))->orderBy('sort_order','asc')->get();
            }
            if($faq->question_id==3) {
                $faq_ans_arr['ta_arr'][]=DB::table('faq_type_arrangements')->select(DB::raw('group_concat(name) as name'))->where('status','1')->whereIn('id',explode(",",$faq->answer))->orderBy('sort_order','asc')->get();
            }
            if($faq->question_id==10) {
                $faq_ans_arr['cost_fd_arr'][]=DB::table('faq_floral_services')->where('status','1')->whereIn('id',explode(",",$faq->answer))->orderBy('sort_order','asc')->get();
            }
            if($faq->question_id==4) {
                $faq_ans_arr['price_bridal'][]=number_format(str_replace("$","",$faq->answer),2);
            }
            if($faq->question_id==5) {
                $faq_ans_arr['price_bridesmaid'][]=number_format(str_replace("$","",$faq->answer),2);
            }
            if($faq->question_id==6) {
                $faq_ans_arr['price_boutonniere'][]=number_format(str_replace("$","",$faq->answer),2);
            }
            if($faq->question_id==7) {
                $faq_ans_arr['price_low_tbl'][]=number_format(str_replace("$","",$faq->answer),2);
            }
            if($faq->question_id==8) {
                $faq_ans_arr['price_elevated_tbl'][]=number_format(str_replace("$","",$faq->answer),2);
            }
            if($faq->question_id==9) {
                $faq_ans_arr['price_customer_expect'][]=number_format(str_replace("$","",$faq->answer),2);
            }
        }
        /*echo '<pre>';print_r($vendorDetails); die;*/
        $vendorDetails['faq_ans_arr'] = $faq_ans_arr;
        $sessionName = 'vendor_'.$venID;
        if(!Session::get($sessionName)) {
            $venData = VendorCompany::where('vendor_id',$venID)->first();
            $totalVisits = $venData->visits + 1;
            $venData->visits = $totalVisits;
            Session::put('vendor_'.$venID, 'done');
            $venData->save();
            if($venData->id) {
                $vendorVisits = new VendorVisitsCount();
                if(isset(Auth::user()->id)) {
                    $vendorVisits->user_id = Auth::user()->id;
                }
                $vendorVisits->vendor_id   = $venID;
                $vendorVisits->visits      = 1;
                $vendorVisits->save();
            }
        }
        $vendorDetails['business_hours'] = BusinessHours::where('vendor_id',$venID)->get();
        $vendorDetails['business_social'] = DB::table('business_social_media')->select('*',DB::raw("(CASE WHEN link = '' OR link IS NULL THEN 0 ELSE 1 END) AS is_link"))->join('social_media','social_media.id','=','social_media_id')->where('vendor_id',$venID)->get();
        $vendorDetails['business_info'] = BusinessInfo::where('vendor_id',$venID)->get();
        $vendorDetails['categories'] = DB::select(DB::raw("SELECT * FROM categories WHERE id in (SELECT parent_id FROM categories WHERE categories.id IN (SELECT category_id FROM vendor_category_relation WHERE vendor_id = $venID) GROUP BY categories.parent_id)"));
        $vendorDetails['vendorId'] = $venID;
        $vendorDetails['videos'] = VendorVideo::where('vendor_id',$venID)->get();
        return view('pages/venues-details',['pageData'=>$page,'vendorDetails'=>$vendorDetails,'wishLists'=>$wishLists,'idx'=>$idx,'blogs' => $blogs,'url' => url('community'),'single_url' => url('community-post'),'teamMembers' => $teamMembers]);
    }
    public function address_verify(Request $request)
    {
        $address = urlencode($request->input('address'));
        // echo "$address";
        // $url = 'https://maps.google.com/maps/api/geocode/json?key='.env('GMAP_API_KEY').'&address=' . urlencode($address) . '&sensor=false';
        // count($resp['results']) > 0 && $resp['status'] == 'OK';
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false&key=".env('GMAP_API_KEY_GEOCODE');
        $resp_json = file_get_contents($url);
        $resp = json_decode($resp_json, true);
        // $geocode = file_get_contents($url);
        // $results = json_decode($geocode, true);
        return response(array("status" => count($resp['results']) > 0 && $resp['status'] == 'OK'),200);
    }

    public function category_view($slug = null)
    {
        $category = Category::select('categories.*',\DB::raw("(SELECT images FROM categories_images WHERE cat_id=categories.id LIMIT 1) AS image"),
        \DB::raw("(SELECT images FROM categories_images WHERE cat_id=categories.parent_id LIMIT 1) AS image2"))
        ->where('slug',$slug)->first();
        if(!isset($category->id)) return redirect()->back();
        $page = Page::whereIn('id', [27,26])->first();
        return view('pages.category_view',['pageData' => $page,'categoryData' => $category]);
    }
    public function promocode_request(Request $request)
    {
        if(empty($request->code))
            return response()->json(['status' => false,'message' => 'Promocode can\'t be empty !!','data' => null]);
        else{
            $checkPromoCode = PromoCode::where('name',$request->code)->where('used_at')->where('vendor_id')->get();
            if(count($checkPromoCode) <= 0){
                return response()->json(['status' => false,'message' => 'Promocode already used or unavailable !!','data' => null]);
            }else{
                $checkPromoCode = $checkPromoCode[0];
                $promocode = PromoCode::find($checkPromoCode->id);
                $promocode->used_at = date('Y-m-d H:i:s');
                $promocode->vendor_id = Session::get('session_vendorId');
                $vendorObj = Vendor::find($promocode->vendor_id);
                $vendorObj->freelisting = 'No';
                $vendorObj->pay_status = 1;
                $vendorObj->verified = 1;
                $promocode->save();
                $vendorObj->save();
                $username = Session::get('_vendor_username');
                $password = Session::get('_vendor_password');
                Auth::guard('vendor')->attempt(['username'=>$username,'password'=>$password]);
                Session::forget('_vendor_registration_step');
                Session::forget('_vendor_id');
                Session::forget('_vendor_username');
                Session::forget('_vendor_password');
                Session::forget('session_vendorId');
                $vendors = $vendorObj;
                $vendorCompany = VendorCompany::where('vendor_id','!=',$promocode->vendor_id)->inRandomOrder()->limit(3)->get();
                Mail::to($vendors->email)->send(new VendorAfterPayment($vendors->username));
                // Mail::to($vendors->email)->send(new ProfessionalTipsMail($vendors->username,'','',$vendorCompany,$vendors->email));
                // Mail::to($vendors->email)->send(new ProfessionalTipsLeadMail($vendors->username));
                return response()->json(['status' => true,'message' => 'Successfully registered as featured account !!','data' => ['url' => url('dashboard')]]);
            }
        }
    }
    public function test_email()
    {
        // Mail::to('ashiqkmuhammed@gmail.com')->send(new VendorMakeChangesMail('ashiq'));
        $mails = new \App\Mail\ConditionsOfContractMail();
        Mail::to('ashiqkmuhammed@gmail.com')->send(new \App\Mail\ConditionsOfContractMail());
        return ($mails)->render();
        return view('emails.blog_submission_french',[
                        'roleType' => '',
                        'name' => @$this->objectData['name'],
                        'email' => @$this->objectData['email'],
                        'number_of_guests' => @$this->objectData['number_of_guests'],
                        'event_date' => @$this->objectData['event_date'],
                        'phone' => @$this->objectData['phone'],
                        'comment' => @$this->objectData['comment'],
                        'vendor_id' => @$this->companyData[0]->vendor_id,
                        'business_name' => @$this->companyData[0]->business_name,
                        'category_title' => @$this->companyData[0]->title,
                        'telephone' => @$this->companyData[0]->telephone,
                        'business_address' => @$this->companyData[0]->business_address,
                        'province' => @$this->companyData[0]->province,
                        'country' => @$this->companyData[0]->country,
                    ]);
    }
    public function aboutUs()
    {
        $page = Page::where('id',27)->first();
        $bios = Page::whereIn('id',[28,29,30])->get();
        return view('pages.about_us',['pageData' => $page,'bios' => $bios]);
    }
    public function communityPage()
    {
        $page = Page::where('id',31)->first();
        return view('pages.community_guidelines',['pageData' => $page]);
    }
    public function userAgreement()
    {
        $page = Page::where('id',32)->first();
        return view('pages.user_agreement',['pageData' => $page]);
    }
    public function bios($slug)
    {
        $page = Page::where('url',$slug)->first();
        $pageMain = Page::where('id',27)->first();
        if(!isset($page)) return redirect('about-us');
        $bios = Page::whereIn('id',[28,29,30])->where('url','!=',$slug)->get();
        return view('pages.bios',['pageData' => $page,'bios' => $bios,'mainPage' => $pageMain]);
    }
    public function unsubscribeNewsletterEmail($email)
    {
        $email = strlen($email) > 50 ? decrypt($email) : $email;
        $status = false;
        $statusData = UserNewsletter::where('email_id',$email)->first();
        if(isset($statusData->id)){
            $updateData = UserNewsletter::find($statusData->id);
            $updateData->status = 0;
            $status = $updateData->save();
        }else{
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                $insertData = new UserNewsletter;
                $insertData->email_id = $email;
                $insertData->status = 0;
                $status = $insertData->save();
            }
        }
        return view('pages.email_unsubsribe',['status' => $status]);
    }
    public function vendorExamples($business_slug)
    {
        $page = Page::where('id', 13)->first();
        if($business_slug == 'example-1')
            $setPage = 'venues-details-example-1';
        if($business_slug == 'example-2')
            $setPage = 'venues-details-example-2';
        if($business_slug == 'example-3')
            $setPage = 'venues-details-example-3';
        if(!isset($setPage)) return redirect('/');
        return view('pages.'.$setPage,['pageData'=>$page]);
    }
    public function vendorExamples2($business_slug)
    {
        $page = Page::where('id', 13)->first();
        if($business_slug == 'example-1')
            $setPage = 'venues-details-example-1';
        if($business_slug == 'example-2')
            $setPage = 'venues-details-example-2';
        if($business_slug == 'example-3')
            $setPage = 'venues-details-example-3';
        if(!isset($setPage)) return redirect('/');
        return view('pages.venues-details',['pageData'=>$page,'slug_ex' => $business_slug,'vendorDetails' => []]);
    }
    public function get_city_town($province=null, $vals=null)
    {
        $regions = Regions::where('state',$province)->where('region', 'LIKE', '%'.$vals.'%')->get();
        $htmls = '';
        foreach($regions as $reg) {
            $htmls .= "<option class='region_list' value=".$reg->region.">";
        }
        echo $htmls;
    }
    public function getPhoneNumber(Request $request)
    {
        $vendorCompany = VendorCompany::where('business_name_slug',$request->slug)->first();
        $vendor = Vendor::where('vendor_id',$vendorCompany->vendor_id)->first();
        $vendorUpdate = Vendor::find($vendorCompany->vendor_id);
        $vendorUpdate->phone_number_count = $vendor->phone_number_count+1;
        $vendorUpdate->save();
        // Vendor::update(['phone_number_count' => $vendor->phone_number_count+1])->where('vendor_id',$vendorCompany->vendor_id);
        return ['mobile' => $vendor->mobile,'telephone' => $vendor->telephone];
    }
    public function claimYourListing($slug,Request $request)
    {
        // dd($request->all());
        $vendorCompany = VendorCompany::where('business_name_slug',$slug)->first();
        $signup = new Signup;
        
        $signup->firstname          = $request->firstname;
        $signup->lastname           = $request->lastname ?? null;
        $signup->practice_name      = $request->practice_name;
        $signup->email              = $request->email;
        $signup->phone              = $request->phone;
        $signup->service_specialty  = $request->service_specialty;
        $signup->employees          = $request->employees;
        $signup->appointment_at     = $request->appointment_at;
        $signup->profile_page       = $request->profile_page ?? 0;
        $signup->content_provider   = $request->content_provider ?? 0;
        $signup->online_booking     = $request->online_booking ?? 0;
        $signup->public_speaker     = $request->public_speaker ?? 0;
        $signup->vendor_id          = $vendorCompany->vendor_id ?? null;
        
        $signup->save();
        return redirect()->back()->with('success','Successfully requested for claim your lisiting !!');
    }
}