<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Auth;
use Route;
use Input;
use App\Page;
use App\Vendor;
use App\VendorCompany;
use App\VendorImage;
use App\VendorQuestion;
use App\VendorPromotion;
use App\Category;
use App\Regions;
use App\SocialMedia;
use App\BusinessInfo;
use App\BusinessSocialMedia;
use App\BusinessHours;
use App\VendorCategoryRelation;
use App\Mail\WelcomeMailToVendor;
use App\Signup;
use Session;

class VendorLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:vendor', ['except' => ['logout']]);
    }

    /*
    * ---------------------------------------------------
    *  View Login Form
    * ---------------------------------------------------
    */
    public function viewLogin(Request $request)
    {
        // echo Hash::make('ashiq123');exit;
        $verification = @$request->get('verification');
        if($verification) {
            $username = @decrypt($verification);
            $vendorDt = Vendor::where('username',$username)->first();
            $vendors = Vendor::find($vendorDt->vendor_id);
            $vendors->verified = '1';
            $vendors->save();
        }
        // dd(Hash::make('ashiq123'));
        $pageData = Page::select('id','url','title','image','image_description','description','meta_title','meta_description','meta_keyword')->where('id', 2)->first();
        return view('vendor.auth.login',['pageData'=>$pageData]);
    }

    /*
    * ---------------------------------------------------
    *  Vendor Login Functionality
    * ---------------------------------------------------
    */
    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:6'
        ]);
        // Attempt to log the user in
        // if (Auth::guard('vendor')->attempt(['username'=>$request->username,'password'=>$request->password,'status'=>'1','freelisting'=>'No','pay_status'=>'1','verified'=>'1'], $request->remember)) {
        if (Auth::guard('vendor')->attempt(['username'=>$request->username,'password'=>$request->password,'status'=>'1','verified'=>'1','freelisting'=>'No'], $request->remember)) {
            // if successful, then redirect to their intended location
            Auth::guard('vendor')->user()->last_login = date('Y-m-d H:i:s');
            Auth::guard('vendor')->user()->save();
            session(['vendor_progress_popup' => 'allow']);
            return redirect()->intended(route('vendor.dashboard'));
        } 
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->with('msg','Invalid Credentials or Your account is not verified Please try again.');
    }

    /*
    * ---------------------------------------------------
    *  Vendor Logout Function
    * ---------------------------------------------------
    */
    public function logout()
    {
        Auth::guard('vendor')->logout();
        return redirect('/login');
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

    /*
    * ---------------------------------------------------
    *  View Vendor Registartion Step 1
    * ---------------------------------------------------
    */
    public function viewRegister(Request $request)
    {
        $vendor_id = @$request->vendorId;
        $pageData = Page::select('id','url','title','image','image_description','description','meta_title','meta_description','meta_keyword')->where('id', 8)->first();
        /////////////////////// Move next step if step 1 is completed ///////////////////////
        $data = session()->all();
        
        $vendorData = array();
        if($vendor_id) {
            $vendorData = Vendor::with(['company_data'])->where('vendor_id',$vendor_id)->first();
        }
        $categories = Category::getCategory();
        $regions = Regions::distinct()->get(['state']);
        $socialMedia = SocialMedia::all();
        
        return view('vendor/vendor_register_form',['pageData'=>$pageData]);
    }
    
    /*
    
    public function viewRegister(Request $request)
    {
        return 
        $vendor_id = @$request->vendorId;
        $pageData = Page::select('id','url','title','image','image_description','description','meta_title','meta_description','meta_keyword')->where('id', 8)->first();
        /////////////////////// Move next step if step 1 is completed ///////////////////////
        $data = session()->all();
        if(isset($data['_vendor_registration_step'])) {
            if($data['_vendor_registration_step'] == 2) { // If Step 2
                $imageData = array();
                if(isset($data['_vendor_id']) && $data['_vendor_id'] !='') {
                    $imageData = VendorImage::select('vendor_id','vendor_folder','image','is_logo')->where('status', 1)->where('vendor_id',$data['_vendor_id'])->get()->toArray();
                }
                return view('vendor/vendor_register_1',['pageData'=>$pageData,'imageData'=>$imageData]);
            } elseif($data['_vendor_registration_step'] == 3) {  // If Step 3
                $getCatId = Vendor::select('cat_id')->where('vendor_id',$data['_vendor_id'])->get()->toArray();
                if(isset($getCatId[0]['cat_id']) && $getCatId[0]['cat_id'] !='') {
                    $venObj = new Vendor;
                    $getAllQuestions = $venObj->getAllQuestions($data['_vendor_id'],$getCatId[0]['cat_id']);
                } else {
                    $getAllQuestions = array();
                }
                // return view('vendor/vendor_register_2',['pageData'=>$pageData,'questions'=>$getAllQuestions]);
                return view('vendor/vendor_register_3',['pageData'=>$pageData]);
            } else {  // If Step 4
            }
        } else {
            $vendorData = array();
            if($vendor_id) {
                $vendorData = Vendor::with(['company_data'])->where('vendor_id',$vendor_id)->first();
            }
            $categories = Category::getCategory();
            $regions = Regions::distinct()->get(['state']);
            $socialMedia = SocialMedia::all();
            return view('vendor/vendor_register',['pageData'=>$pageData,'categories'=>$categories,'regions'=>$regions,'vendorData'=>$vendorData,'socialMedia' => $socialMedia]);
        }
    }*/

    public function get_city_town($province=null, $vals=null)
    {
        $regions = Regions::where('state',$province)->where('region', 'LIKE', '%'.$vals.'%')->get();
        $htmls = '';
        foreach($regions as $reg) {
            $htmls .= "<option class='region_list' value=".$reg->region.">";
        }
        echo $htmls;
    }

    /*
    * ---------------------------------------------------
    *  Make Vendor Registartion Step 1
    * ---------------------------------------------------
    */
    
    public function makeRegister(Request $request)
    {
        $secret = '6Lfst80ZAAAAAPTWQ9HRsMWqS_uwvob6egLpXdyQ';
        $captchaId = $request->input('g-recaptcha-response');
    
        $responseCaptcha = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captchaId));

        if($responseCaptcha->success) {
            
            $signup = new Signup;
        
            $signup->firstname          = $request->firstname;
            $signup->lastname           = $request->lastname;
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
            
            $signup->save();
            
            session()->flash('message','Successfully received the signup request');
            
            return redirect('register-complete');
        }
        else
        {
            die('Invalid submission!');
        }
    }
    
    public function registerComplete(Request $request) {
        
        $vendor_id = @$request->vendorId;
        $pageData = Page::select('id','url','title','image','image_description','description','meta_title','meta_description','meta_keyword')->where('id', 8)->first();
        /////////////////////// Move next step if step 1 is completed ///////////////////////
        $data = session()->all();
        
        $vendorData = array();
        if($vendor_id) {
            $vendorData = Vendor::with(['company_data'])->where('vendor_id',$vendor_id)->first();
        }
        $categories = Category::getCategory();
        $regions = Regions::distinct()->get(['state']);
        $socialMedia = SocialMedia::all();
        
        return view('vendor.vendor_register_complete',['pageData'=>$pageData]);        
        
    }
    
    public function makeRegisterOld(Request $request)
    {
        if(@$request->vendor_id != '' && @$request->company_id != '') {
            $this->validate($request, [
                'username' => 'required|max:30|alpha_dash|min:5',
                'password' => 'required|string|min:6|confirmed',
                'contact_person' => 'required|string',
                'email' => 'required|string|email|max:255',
                'telephone' => 'required',
                'country' => 'required',
                'province' => 'required',
                'city' => 'required',
                'postal_code' => 'required',
                'address' => 'required',
                'business_name' => 'required',
                'category' => 'required|array|max:3',
            ]);
            $vendorObj = Vendor::find($request->vendor_id);
            $vendorCompanyObj = VendorCompany::find($request->company_id);
            $moreInfoObject = BusinessInfo::find($request->vendor_id);
        } else {
            $this->validate($request, [
                'username' => 'required|max:30|alpha_dash|min:5|unique:vendors',
                'password' => 'required|string|min:6|confirmed',
                'contact_person' => 'required|string',
                'email' => 'required|string|email|max:255|unique:vendors',
                'telephone' => 'required',
                'country' => 'required',
                'province' => 'required',
                'city' => 'required',
                'postal_code' => 'required',
                'address' => 'required',
                'business_name' => 'required',
                // 'business_address' => 'required',
                // 'address_verify' => 'required',
                'category' => 'required|array|max:3',
            ]);
            $vendorObj = new Vendor;
            $vendorCompanyObj = new VendorCompany;
            $moreInfoObject = new BusinessInfo;
        }
        /*********************************************/
        $categories = $request->input('category');
        if(is_array($categories))
        {
            $checkProfession = Category::whereIn('id',$categories)->where('is_professionals',1)->count();
            $vendorObj->is_professionals = $checkProfession > 0;
        }
        $vendorObj->username = $request->input('username');
        $vendorObj->contact_person = $request->input('contact_person');
        $vendorObj->password = Hash::make($request->input('password'));
        $vendorObj->email = $request->input('email');
        $vendorObj->telephone = $request->input('telephone');
        $vendorObj->mobile = $request->input('mobile');
        $vendorObj->fax = $request->input('fax');
        // $vendorObj->cat_id = $request->input('category');
        if(@$request->vendor_id) {
            $vendorObj->step_completed = 4;
        } else {
            $vendorObj->step_completed = 1;
        }
        $vendorObj->website = $request->input('website');
        $vendorObj->business_description = $request->input('business_detail');
        $data = $vendorObj->save();
        if($data) {
            /*********************************************/
            $vendorCompanyObj->vendor_id = $vendorObj->vendor_id;
            $vendorCompanyObj->country = $request->input('country');
            $vendorCompanyObj->province = $request->input('province');
            $vendorCompanyObj->city = $request->input('city');
            $vendorCompanyObj->postal_code = $request->input('postal_code');
            // $vendorCompanyObj->address = $request->input('address');
            $vendorCompanyObj->business_name = $request->input('business_name');
            $vendorCompanyObj->business_name_slug = $this->makeSlugFromTitle($request->input('business_name'));
            $vendorCompanyObj->business_detail = $request->input('business_detail');
            // $vendorCompanyObj->business_address = $request->input('business_address');
            $vendorCompanyObj->address = $request->input('address');
            $vendorCompanyObj->business_address = $request->input('address');
            $vendorCompanyObj->save();
            /*********************************************************/
            $moreInfoObject->vendor_id = $vendorObj->vendor_id;
            $moreInfoObject->free_parking = $request->input('free_parking');
            $moreInfoObject->paid_parking = $request->input('paid_parking');
            $moreInfoObject->indoor_parking = $request->input('indoor_parking');
            $moreInfoObject->no_parking = $request->input('no_parking');
            $moreInfoObject->wheel_chair = $request->input('wheelchair');
            $moreInfoObject->motor_vehicle = $request->input('motor_vehicle');
            $moreInfoObject->health_benefit = $request->input('health_benefit');
            $moreInfoObject->gov_insurance = $request->input('gov_insurance');
            $moreInfoObject->self_pay = $request->input('self_pay');
            $moreInfoObject->personal_cheque = $request->input('personal_cheque');
            $moreInfoObject->finance_available = $request->input('finance_available');
            if(!empty($request->input('special_message')))
                $moreInfoObject->holiday_special = $request->input('special_message');
            // $moreInfoObject->language_spoke = $request->input('language_spoken');
            if(!empty($request->input('languages')))
                $moreInfoObject->language = is_array($request->input('languages')) ? implode(',',$request->input('languages')) : $request->input('languages');
            if(!empty($request->input('sign_language')))
                $moreInfoObject->sign_language = $request->input('sign_language');
            if(!empty($request->input('lgbtq')))
                $moreInfoObject->lgbtq = $request->input('lgbtq');
            $moreInfoObject->save();
            /*********************************************************/
            BusinessSocialMedia::where('vendor_id',$vendorObj->vendor_id)->delete();
            $socialMedia = SocialMedia::all();
            foreach($socialMedia as $social){
                $businessSocialObj = new BusinessSocialMedia;
                $businessSocialObj->vendor_id = $vendorObj->vendor_id;
                $businessSocialObj->social_media_id = SocialMedia::get_social_media_id($social->slug);
                $businessSocialObj->link = $request->input($social->slug);
                $businessSocialObj->save();
            }
            BusinessHours::where('vendor_id',$vendorObj->vendor_id)->delete();
            if(!empty($request->only('sunday_open','sunday_open'))){
                $businessHours = new BusinessHours();
                $businessHours->vendor_id = $vendorObj->vendor_id;
                $businessHours->day = 'SUN';
                $businessHours->open = $request->input('sunday_open');
                $businessHours->close = $request->input('sunday_close');
                $businessHours->save();
            }
            if(!empty($request->only('monday_open','monday_close'))){
                $businessHours = new BusinessHours();
                $businessHours->vendor_id = $vendorObj->vendor_id;
                $businessHours->day = 'MON';
                $businessHours->open = $request->input('monday_open');
                $businessHours->close = $request->input('monday_close');
                $businessHours->save();
            }
            if(!empty($request->only('tue_open','tue_close'))){
                $businessHours = new BusinessHours();
                $businessHours->vendor_id = $vendorObj->vendor_id;
                $businessHours->day = 'TUE';
                $businessHours->open = $request->input('tue_open');
                $businessHours->close = $request->input('tue_close');
                $businessHours->save();
            }
            if(!empty($request->only('wed_open','wed_close'))){
                $businessHours = new BusinessHours();
                $businessHours->vendor_id = $vendorObj->vendor_id;
                $businessHours->day = 'WED';
                $businessHours->open = $request->input('wed_open');
                $businessHours->close = $request->input('wed_close');
                $businessHours->save();
            }
            if(!empty($request->only('thu_open','thu_close'))){
                $businessHours = new BusinessHours();
                $businessHours->vendor_id = $vendorObj->vendor_id;
                $businessHours->day = 'THU';
                $businessHours->open = $request->input('thu_open');
                $businessHours->close = $request->input('thu_close');
                $businessHours->save();
            }
            if(!empty($request->only('fri_open','fri_close'))){
                $businessHours = new BusinessHours();
                $businessHours->vendor_id = $vendorObj->vendor_id;
                $businessHours->day = 'FRI';
                $businessHours->open = $request->input('fri_open');
                $businessHours->close = $request->input('fri_close');
                $businessHours->save();
            }
            if(!empty($request->only('sat_open','sat_close'))){
                $businessHours = new BusinessHours();
                $businessHours->vendor_id = $vendorObj->vendor_id;
                $businessHours->day = 'SAT';
                $businessHours->open = $request->input('sat_open');
                $businessHours->close = $request->input('sat_close');
                $businessHours->save();
            }
            VendorCategoryRelation::where('vendor_id',$vendorObj->vendor_id)->delete();
            foreach ($categories as $key => $value) {
                $vendorCategoryObject = new VendorCategoryRelation;
                $vendorCategoryObject->category_id = $value;
                $vendorCategoryObject->vendor_id = $vendorObj->vendor_id;
                $vendorCategoryObject->save();
            }
            $request->session()->put('_vendor_registration_step', 2);
            $request->session()->put('_vendor_id', $vendorObj->vendor_id);
            $request->session()->put('_vendor_username', $request->input('username'));
            $request->session()->put('_vendor_password', $request->input('password'));
            if(@$request->vendor_id) {
                return redirect('/register?vendorId='.$request->vendor_id)->with('success','First step has been completed.');
            } else {
                return redirect('/register')->with('success','First step has been completed.');
            }
        } else {
            if(@$request->vendor_id) {
                return redirect('/register?vendorId='.$request->vendor_id)->with('fail', 'Something went wrong! Please try again.');
            } else {
                return redirect('/register')->with('fail', 'Something went wrong! Please try again.');
            }
        }
    }

    /*
    * ---------------------------------------------------
    *  Make Vendor Registartion Step 2
    * ---------------------------------------------------
    */
    public function makeRegisterSecondStep(Request $request)
    {
        $vendor_id = @Input::get('vendorId', false);
        $data = session()->all();
        if(isset($data['_vendor_id']) && $data['_vendor_id']!='') {
            $vendorObj = new Vendor;
            if(@$vendor_id) {
                $vendorObj->step_completed = 4;
                $affectedRows = Vendor::where('vendor_id', $data['_vendor_id'])->update(['step_completed' => 4]);
            } else {
                $vendorObj->step_completed = 2;
                $affectedRows = Vendor::where('vendor_id', $data['_vendor_id'])->update(['step_completed' => 2]);
            }
            if($affectedRows) {
                $request->session()->put('_vendor_registration_step', 3);
                if(@$vendor_id) {
                    return redirect('/register?vendorId='.$vendor_id)->with('success', 'Second step has been completed.');
                } else {
                    return redirect('/register')->with('success', 'Second step has been completed.');
                }
            } else {
                if(@$vendor_id) {
                    return redirect('/register?vendorId='.$vendor_id)->with('fail', 'Something went wrong! Please try again.');
                } else {
                    return redirect('/register')->with('fail', 'Something went wrong! Please try again.');
                }
            }
        } else {
            if(@$vendor_id) {
                return redirect('/register?vendorId='.$vendor_id)->with('fail', 'Something went wrong! Please try again.');
            } else {
                return redirect('/register')->with('fail', 'Something went wrong! Please try again.');
            }
        }
    }

   /*
    * ---------------------------------------------------
    *  Make Vendor Registartion Step 3
    * ---------------------------------------------------
    */
    public function makeRegisterThiredStep(Request $request)
    {
        $data = session()->all();
        if(isset($data['_vendor_id']) && $data['_vendor_id']!='') {
            $allRequestVal = $request->all();
            //$vendorObjQus = new VendorQuestion;
            $vendorObjQus = array();
            $vendorId = $data['_vendor_id'];
            $count = 0 ;
            foreach($allRequestVal as $key=>$val) {
                $pattern = '/^question_/';
                preg_match($pattern, $key, $matches);
                if(!empty($matches)) {
                    $vendorObjQus[$count]['question_id'] = str_replace('question_',"",$key);
                    if(is_array($val)) {
                        $vendorObjQus[$count]['answer'] = implode(',',$val);
                    } else {
                        $vendorObjQus[$count]['answer'] = $val;
                    }
                    $vendorObjQus[$count]['vendor_id'] = $vendorId;
                    $vendorObjQus[$count]['status'] = 1;
                    $vendorObjQus[$count]['created_at'] = new \DateTime();
                    $vendorObjQus[$count]['updated_at'] = new \DateTime();
                    $count++;
                }
            }
            $saveData = VendorQuestion::insert($vendorObjQus);
            if($saveData) {
                $vendorObj = new Vendor;
                if(@$request->vendor_id) {
                    $vendorObj->step_completed = 4;
                    $affectedRows = Vendor::where('vendor_id', $data['_vendor_id'])->update(['step_completed' => 4]);
                } else {
                    $vendorObj->step_completed = 3;
                    $affectedRows = Vendor::where('vendor_id', $data['_vendor_id'])->update(['step_completed' => 3]);
                }
                $request->session()->put('_vendor_registration_step', 4);
                if(@$request->vendor_id) {
                    return redirect('/register?vendorId='.$request->vendor_id)->with('success', 'Third step has been completed.');
                } else {
                    return redirect('/register')->with('success', 'Third step has been completed.');
                }
            } else {
                if(@$request->vendor_id) {
                    return redirect('/register?vendorId='.$request->vendor_id)->with('fail', 'Something went wrong! Please try again.');
                } else {
                    return redirect('/register')->with('fail', 'Something went wrong! Please try again.');
                }
            }
        } else {
            if(@$request->vendor_id) {
                return redirect('/register?vendorId='.$request->vendor_id)->with('fail', 'Something went wrong! Please try again.');
            } else {
                return redirect('/register')->with('fail', 'Something went wrong! Please try again.');
            }
        }
    }

   /**
    * ---------------------------------------------------
    *  Make Vendor Registartion Step 4
    * ---------------------------------------------------
    */
    public function makeRegisterFourStepSimple()
    {
        $data = session()->all();
        /*print_r($data);
        die;*/
        if(isset($data['_vendor_id']) && $data['_vendor_id']!='') {
            $vendorObj = new Vendor;
            $vendorObj->step_completed = 4;
            if(Session::get('session_vendorId') == '' || Session::get('session_vendorId') == null) {
                $vendorObj->freelisting = 'Yes';
                $affectedRows = Vendor::where('vendor_id',$data['_vendor_id'])->update(['step_completed'=>4,'freelisting'=>'Yes']);
            } else {
                $vendorObj->freelisting = 'No';
                $affectedRows = Vendor::where('vendor_id',$data['_vendor_id'])->update(['step_completed'=>4,'freelisting'=>'No']);
            }
            if (Auth::guard('vendor')->attempt(['username'=>$data['_vendor_username'], 'password'=>$data['_vendor_password']])) {
                if(Session::get('session_vendorId') == '' || Session::get('session_vendorId') == null) {
                    Session::put('session_vendorId', Auth::guard('vendor')->id());
                    Session::put('session_payType','marketing');
                    /*
                    Auth::guard('vendor')->logout();
                    $vendor = Vendor::where('vendor_id',$data['vendor_id'])->first();
                    Mail::to($vendor->email)->send(new WelcomeMailToVendor($data['_vendor_username']));*/
                    return redirect('payment-packages');
                } else {
                    Auth::guard('vendor')->logout();
                    /*$hgf = Auth::guard('vendor')->attempt(['username'=>$data['_vendor_username'], 'password'=>$data['_vendor_password']]);
                    echo Session::get('session_vendorId');die;*/
                    return redirect('/register')->with('fail', 'Something went wrong! Please try again.');
                    return redirect('payment-thankyou');
                }
            } else
                return redirect('/register')->with('fail', 'Something went wrong! Please try again.');
        } else
            return redirect('/register')->with('fail', 'Something went wrong! Please try again.');
    }
    public function makeRegisterFourStep(Request $request)
    {
        $data = session()->all();
        if(isset($data['_vendor_id']) && $data['_vendor_id']!='') {
            $vendorObjPro = new VendorPromotion;
            $vendorObjPro->vendor_id = $data['_vendor_id'];
            $vendorObjPro->promotion_amount = $request->input('promotion_amount');
            $vendorObjPro->offer_type = 1;
            if($request->input('offer_wedding')) {
                $vendorObjPro->offer_wedding = $request->input('offer_wedding');
            }
            $saveData = $vendorObjPro->save();
            if($saveData) {
                $vendorObj = new Vendor;
                $vendorObj->step_completed = 4;
                if(Session::get('session_vendorId') == '' || Session::get('session_vendorId') == null) {
                    $vendorObj->freelisting = 'Yes';
                    $affectedRows = Vendor::where('vendor_id',$data['_vendor_id'])->update(['step_completed'=>4,'freelisting'=>'Yes']);
                } else {
                    $vendorObj->freelisting = 'No';
                    $affectedRows = Vendor::where('vendor_id',$data['_vendor_id'])->update(['step_completed'=>4,'freelisting'=>'No']);
                }
                $request->session()->forget('_vendor_registration_step');
                $request->session()->forget('_vendor_id');
                $request->session()->forget('_vendor_username');
                $request->session()->forget('_vendor_password');
                // ########################################################################################
                // ###########################          PAYMENT CODE            ###########################
                // ########################################################################################
                    // $pay = $this->makePayment($order,$request);
                    // $refNum = $pay->getReferenceNum();
                    // $txnNum = $pay->getTxnNumber();
                    // $resCod = $pay->getResponseCode();
                    // if($pay->getResponseCode() < 50 && strlen($refNum) > 5 && strlen($txnNum) > 5 && is_numeric($resCod)) {
                    //     $order->payment_method = 'Credit Card';
                    //     $order->reference_num = $pay->getReferenceNum();
                    //     $order->transaction_id = $pay->getTxnNumber();
                    //     $order->payment_status = $pay->getResponseCode();
                    //     $order->status  = 1;
                    //     $order->save();
                    //     //// Update Basket......
                    //     $basket->open = 0;
                    //     $basket->page = 'thankyou';
                    //     $basket->save();
                    //     $basket = Basket::with(['items'=>function($query) {
                    //                 $query->with('address','color', 'size', 'shirttype');
                    //             }])->whereId(session('basket_id'))->first();
                    //     Session::forget('basket_id');
                    //     //// Order Notification Mail......
                    //     $reciepient = $basket->email;
                    //     $data = array('basket'=>$basket);
                    //     Mail::send('emails.orderReceiving', $data, function($message) use ($reciepient) {
                    //         $message->to($reciepient,'')->subject('Your Order Details');
                    //         $message->from('citstestdev@gmail.com','CreativeTees');
                    //     });
                    //     //// To admin......
                    //     $admin_reciepient = 'citstestdev@gmail.com';
                    //     $data = array('basket'=>$basket);
                    //     Mail::send('emails.orderReceiving', $data, function($message) use ($admin_reciepient) {
                    //         $message->to($admin_reciepient,'')->subject('Your Order Details');
                    //         $message->from('citstestdev@gmail.com','CreativeTees');
                    //     });
                    //     session('basket_id',NULL);
                    //     session(['order_id' => $basket->id]);
                    //     return redirect('shop/thankyou');
                    // } else {
                    //     $pay->getMessage();
                    //     $badorder = Order::find($order->id);
                    //     $badorder->delete();
                    //     return Redirect::back()->withErrors([$pay->getMessage()]);
                    // }
                // ########################################################################################
                // ###########################          PAYMENT CODE            ###########################
                // ########################################################################################
                if (Auth::guard('vendor')->attempt(['username'=>$data['_vendor_username'], 'password'=>$data['_vendor_password']])) {
                    // if(Session::get('session_vendorId') == '' || Session::get('session_vendorId') == null) {
                    //     Session::put('session_vendorId', $data['_vendor_id']);
                    //     Session::put('session_payType','marketing');
                    //     Auth::guard('vendor')->logout();
                    //     return redirect('payment-packages');
                    // } else {
                    //     return redirect()->intended(route('vendor.dashboard'));
                    // }
                    if(Session::get('session_vendorId') == '' || Session::get('session_vendorId') == null) {
                        Session::put('session_vendorId', $data['_vendor_id']);
                        Session::put('session_payType','marketing');
                        Auth::guard('vendor')->logout();
                        return redirect('payment-packages');
                    } else {
                        Auth::guard('vendor')->logout();
                        return redirect('payment-thankyou');
                    }
                } else {
                    return redirect('/register')->with('fail', 'Something went wrong! Please try again.');
                }
            } else {
                return redirect('/register')->with('fail', 'Something went wrong! Please try again.');
            }
        } else {
            return redirect('/register')->with('fail', 'Something went wrong! Please try again.');
        }
    }

    // ########################################################################################
    // ###########################          PAYMENT CODE            ###########################
    // ########################################################################################

    // protected function makePayment(Order $order, Request $request) 
    // {

    //     //// live site data key form www.memorilaflowlers.ca......
    //     // $store_id='monca93210';
    //     // $api_token='3yAtOzMUMmOqZU0oFKIN';
    //     //// cardtest put this request in url......
    //     // if(($request->has('cardtest') && $request->cardtest == 'yes') || $_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
    //         $store_id='store5';
    //         $api_token='yesguy';
    //     // }
    //     $customername = $order->basket->address->firstname . ' ' . $order->basket->address->lastname;
    //     $type='purchase';
    //     $cust_id        = $customername . ' | ' . $order->basket->email;
    //     $order_id       = $order->invoice_id.$order->id;
    //     $amount         = $order->grandtotal;
    //     $pan            = $request->cardnumber;
    //     $expiry_date    = substr($request->exp_year,2,2).sprintf("%02d",$request->exp_month);
    //     $crypt          = '7';
    //     $dynamic_descriptor='CreativeTees Payment';
    //     $status_check   = 'false';
    //     $txnArray=array('type'=>$type,
    //                     'order_id'=>$order_id,
    //                     'cust_id'=>$cust_id,
    //                     'amount'=>$amount,
    //                     'pan'=>$pan,
    //                     'expdate'=>$expiry_date,
    //                     'crypt_type'=>$crypt,
    //                     'dynamic_descriptor'=>$dynamic_descriptor
    //                    );
    //     // print_r($txnArray); die;
    //     $mpgTxn = new mpgTransaction($txnArray);
    //     $mpgRequest = new mpgRequest($mpgTxn);
    //     $mpgRequest->setProcCountryCode("CA");
    //     // if(($request->has('cardtest') && $request->cardtest == 'yes') || $_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
    //         $mpgRequest->setTestMode(true);
    //     // }
    //     $mpgHttpPost  = new mpgHttpsPost($store_id,$api_token,$mpgRequest);
    //     $mpgResponse = $mpgHttpPost->getMpgResponse();
    //     return $mpgResponse;
    // }

    

    // ########################################################################################
    // ###########################          PAYMENT CODE            ###########################
    // ########################################################################################

    /*
    * ---------------------------------------------------
    *  Upload Vendor Image Via Ajax
    * ---------------------------------------------------
    */
    public function uploadImages(Request $request)
    {
        //$request->session()->flush();
        $data = session()->all();
        if(isset($data['_vendor_id']) && $data['_vendor_id']!='') {
            $this->validate($request, [
                'userImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $image = $request->file('userImage');
            $input['image'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/vendors/VENDOR_'.$data['_vendor_id']);
            if($image->move($destinationPath, $input['image'])) {
                //************************************************//
                $vendorImageObj = new VendorImage;
                $vendorImageObj->vendor_id = $data['_vendor_id'];
                $vendorImageObj->vendor_folder = 'VENDOR_'.$data['_vendor_id'];
                $vendorImageObj->image = $input['image'];
                if($vendorImageObj->save()) {
                    return response()->json(array('errorVal'=>false,'msg'=>'VENDOR_'.$data['_vendor_id'].'/'.$input['image']), 200);
                } else {
                    return response()->json(array('errorVal'=>true,'msg'=>'Image not saved. Please try again.'), 200);
                }//************************************************//
            } else {
                return response()->json(array('errorVal'=>true,'msg'=>'Image not uploaded. Please try again.'), 200);
            }
        } else {
            return response()->json(array('errorVal'=>true,'msg'=>'Something went wrong! Please try again.'), 200);
        }
    }

    /*
    * ---------------------------------------------------
    *  Reset View Password 
    * ---------------------------------------------------
    */
    public function resetView()
    {
        $this->middleware('guest');
        $pageData = Page::select('id','url','title','image','image_description','description','meta_title','meta_description','meta_keyword')->where('id', 12)->first();
        return view('vendor/auth/passwords/email',['pageData'=>$pageData]);
    }

}