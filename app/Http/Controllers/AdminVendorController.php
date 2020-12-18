<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use PDF;
use View;
use File;
use App\Admin;
use App\Vendor;
use App\VendorCompany;
use App\VendorImage;
use App\User;
use App\ContactEnquiry;
use App\PaymentMethod;
use App\Category;
use App\CategoryImages;
use App\Countries;
use App\States;
use App\Cities;
use App\VendorTeammember;
use App\VendorRating;
use App\VendorLocation;
use App\Subscription;
use App\VendorBill;
use App\VendorInvoice;
use App\UserBookedVendor;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceReminderMail;
use App\Mail\FreelistingMail;
use App\Mail\PaymentSuccessMail;
use App\Mail\VendorMailToAdmin;
use App\Library\Moneris\mpgTransaction;
use App\Library\Moneris\CofInfo;
use App\Library\Moneris\mpgRequest;
use App\Library\Moneris\mpgHttpsPost;
use Session;
use App\Page;
use App\Regions;
use App\SocialMedia;
use Illuminate\Support\Facades\Hash;
use App\BusinessInfo;
use App\BusinessSocialMedia;
use App\BusinessHours;
use App\VendorCategoryRelation;
use App\Feature;
use App\VendorFeature;
use App\Tag;
use App\District;
use App\Community;

class AdminVendorController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $data['new_users'] = User::whereDate('created_at', DB::raw('CURDATE()'))->count();
        $data['new_vendors'] = Vendor::whereDate('created_at', DB::raw('CURDATE()'))->where('freelisting','No')->count();
        View::share('slideBar',$data);
    }

    /*
    * -------------------------------------------------------------
    * Working On Vendor Module
    * -------------------------------------------------------------
    */
    protected function vendors($type = "all",Request $request)
    {
        $name = $request->name;
        $category = $request->category;
        $catVendors = array();
        if($name != null && $name != '') {
            $compData = VendorCompany::leftJoin('vendors','vendor_companies.vendor_id','=','vendors.vendor_id')->select('vendor_companies.vendor_id')->where('vendors.username','like','%'.$name.'%')->orWhere('vendors.contact_person','like','%'.$name.'%')->orWhere('vendors.email','like','%'.$name.'%')->orWhere('vendor_companies.province','like','%'.$name.'%')->orWhere('vendor_companies.city','like','%'.$name.'%')->orWhere('vendor_companies.business_name','like','%'.$name.'%')->get();
            foreach($compData as $cp) {
                if(!in_array($cp->vendor_id, $catVendors)) {
                    array_push($catVendors,$cp->vendor_id);
                }
            }
            if(count($catVendors) > 0) {
                $query = Vendor::whereIn('vendors.vendor_id', $catVendors)->where('parent_vendor_id', 0);
            } else {
                $query = Vendor::where('parent_vendor_id', 0);
            }
        } else {
            $query = Vendor::where('parent_vendor_id', 0);
        }
        if($type == "featured")
            $query->where('vendors.display_home_page',1);
        if($type == "active")
            $query->where('vendors.status',1);
        if($type == "inactive")
            $query->where('vendors.status',0);
        $query->select('vendors.*',DB::raw("(select avg(average_rating) from vendor_ratings where status = 1 and vendor_id = vendors.vendor_id) as avg_rating"),DB::raw("(SELECT GROUP_CONCAT(categories.title) FROM categories JOIN vendor_category_relation ON vendor_category_relation.category_id = categories.id WHERE vendor_category_relation.vendor_id = vendors.vendor_id) AS categories"));
        if($category != null && $category != '') {
            $categories = Category::where('status', 1)->where('parent_id', $category)->get()->toArray();
            $categories = array_map(function($result){
                return $result['id'];
            },$categories);
            $query->join('vendor_category_relation','vendor_category_relation.vendor_id','=','vendors.vendor_id');
            $query->groupBy('vendor_category_relation.vendor_id');
            if(!empty($categories))
                $query->whereIn('vendor_category_relation.category_id',$categories);
            else
                $query->where('vendor_category_relation.category_id',$category);
        }
        $subscription = Subscription::get();
        // $query->with(['noOfCouples','image_data','company_data']);
        $query->with(['noOfCouples','image_data']);
        $query->join('vendor_companies','vendor_companies.vendor_id','=','vendors.vendor_id');
        /*$query->load(['company_data' => function ($q) use($request) {
          $q->orderBy('business_name', $request->name_sort);
        }]);*/
        if(!empty($request->name_sort))
            $query->orderBy('business_name',$request->name_sort);
        if(!empty($request->category_sort)){
            $query->join('vendor_category_relation','vendor_category_relation.vendor_id','=','vendors.vendor_id');
            $query->groupBy('vendor_category_relation.vendor_id');
            $query->join('categories','categories.id','=','vendor_category_relation.category_id');
            $query->orderBy('categories.title',$request->category_sort);
        }
        if(!empty($request->since_sort))
            $query->orderBy('vendors.created_at',$request->since_sort);
        /*if(!empty($request->name_sort) && $request->name_sort == 'desc')
            $query->orderBy('business_name');*/
            // dd($query->toSql());
        $vendors = $query->paginate(21);
        // dd($query->with(['noOfCouples','image_data','company_data'])->toSql());
        $categories = Category::where('status', 1)->get();
        $enCount = ContactEnquiry::select('company_id',DB::raw('count(company_id) as enCount'))->where('form_data',2)->groupBy('company_id')->get()->toArray();
        // dd($vendors);
        return view('admin/vendors/list', [
            'vendors' => $vendors,
            'categories' => $categories,
            'enCount' => $enCount,            
            'subscription'=>$subscription
        ]);
    }
    protected function addvendor()
    {
          $pageData = Page::select('id','url','title','image','image_description','description','meta_title','meta_description','meta_keyword')->where('id', 8)->first();
            $categories = Category::getCategory();
            $regions = Regions::distinct()->get(['state']);
            $socialMedia = SocialMedia::all();
            $features=Feature::get();
            $districts=District::get();
            $locations=Community::get();
        return view('admin/vendors/addvendor',['pageData'=>$pageData,'categories'=>$categories,'regions'=>$regions,'socialMedia' => $socialMedia,'features'=>$features,'districts'=>$districts,'locations'=>$locations]);
    }
    protected function savevendor(Request $request)
    {
        $this->validate($request, [
                'password' => 'required|string|min:6|confirmed',
                'username' => 'required|max:30|alpha_dash|min:6|unique:vendors',
                //'contact_person' => 'required|string',
                'email' => 'required|string|email|max:255',
               'telephone' => 'required|max:10|regex:/[0-9]/',
               'mobile' => 'max:10|nullable|regex:/[0-9]/',
                
                
                'postal_code' => 'required',
                'address' => 'required',
                'business_name' => 'required',
                // 'business_address' => 'required',
                // 'address_verify' => 'required',
                'category' => 'required|array|min:1',
                'feature1' => 'required|array|min:1',
                'district'=>'required',
                'location'=>'required'
                //'userImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $vendorObj = new Vendor;
            $vendorCompanyObj = new VendorCompany;
            $moreInfoObject = new BusinessInfo;
          $categories = $request->input('category');
          $features=$request->input('feature1');
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
        $vendorObj->step_completed = 4;
        $vendorObj->status = $request->has('active') && $request->active == 1 ? 1 : 0;
        $vendorObj->verified = 1;
        $vendorObj->is_business_hours = $request->has('is_business_hours') && $request->is_business_hours == 1 ? 1 : 0;
        // $vendorObj->cat_id = $request->input('category');
        $vendorObj->website = $request->input('website');
        $vendorObj->business_description = $request->input('business_detail');
        $data = $vendorObj->save();
        if($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $input['image'] = time().'_featured_'.mt_rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/vendors/VENDOR_'.$vendorObj->vendor_id);
            if($image->move($destinationPath, $input['image'])) {
                $vendorObj->featured_image = $input['image'];
                $vendorObj->save();
            }
        }
        if(!empty($request->input('featured_image')) && strlen($request->input('featured_image')) > 6) {
            $featuredImage = $request->input('featured_image');
            if(preg_match('/data:image/', $featuredImage)) {
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time() . '_featured_'.mt_rand(1000,9999) . '.png';
                $path = public_path() . '/vendors/VENDOR_' . $vendorObj->vendor_id;
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path.'/'.$image_name, $featuredImage);
                $vendorObj->featured_image = $image_name;
            }
        }
        if(!empty($request->input('userImage')) && strlen($request->input('userImage')) > 6) {
            $featuredImage = $request->input('userImage');
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
                $vendorObj->profile = $vendorImageObj->image;
                $vendorObj->save();
            }
        }

        if($data) {
            /*********************************************/
            $vendorCompanyObj->vendor_id = $vendorObj->vendor_id;
            $vendorCompanyObj->country = 'Canada';
            $vendorCompanyObj->province = 'Ontario';
            $vendorCompanyObj->district = $request->input('district');
            $vendorCompanyObj->location = $request->input('location');
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
            foreach ($features as $key => $value) {
                $vendorfeature = new VendorFeature;
                $vendorfeature->feature_id = $value;
                $vendorfeature->vendor_id = $vendorObj->vendor_id;
                $vendorfeature->save();
            }
            $tags=$request->input('tag');
            $myArray = explode(',', $tags);
            
            foreach ($myArray as $key) {
            $tag=new Tag;
            $tag->vendor_id=$vendorObj->vendor_id;
            $tag->tagname=$key;
            $tag->save();
            }
            
            // $moreInfoObject->vendor_id = $vendorObj->vendor_id;
            // $moreInfoObject->free_parking = $request->input('free_parking');
            // $moreInfoObject->paid_parking = $request->input('paid_parking');
            // $moreInfoObject->indoor_parking = $request->input('indoor_parking');
            // $moreInfoObject->no_parking = $request->input('no_parking');
            // $moreInfoObject->wheel_chair = $request->input('wheelchair');
            // $moreInfoObject->motor_vehicle = $request->input('motor_vehicle');
            // $moreInfoObject->health_benefit = $request->input('health_benefit');
            // $moreInfoObject->gov_insurance = $request->input('gov_insurance');
            // $moreInfoObject->self_pay = $request->input('self_pay');
            // $moreInfoObject->personal_cheque = $request->input('personal_cheque');
            // $moreInfoObject->finance_available = $request->input('finance_available');
            // if(!empty($request->input('special_message')))
            //     $moreInfoObject->holiday_special = $request->input('special_message');
            // // $moreInfoObject->language_spoke = $request->input('language_spoken');
            // if(!empty($request->input('languages')))
            //     $moreInfoObject->language = is_array($request->input('languages')) ? implode(',',$request->input('languages')) : $request->input('languages');
            // if(!empty($request->input('sign_language')))
            //     $moreInfoObject->sign_language = $request->input('sign_language');
            // if(!empty($request->input('lgbtq')))
            //     $moreInfoObject->lgbtq = $request->input('lgbtq');
            // $moreInfoObject->save();
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
            if($request->hasFile('userImage')) {
                $image = $request->file('userImage');
                $input['image'] = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/vendors/VENDOR_'.$vendorObj->vendor_id);
                if($image->move($destinationPath, $input['image'])) {
                    //************************************************//
                    $vendorImageObj = new VendorImage;
                    $vendorImageObj->vendor_id = $vendorObj->vendor_id;
                    $vendorImageObj->vendor_folder = 'VENDOR_'.$vendorObj->vendor_id;
                    $vendorImageObj->image = $input['image'];
                    $vendorImageObj->save();
                    $vendorObj->profile = $vendorImageObj->image;
                    $vendorObj->save();
                    //************************************************//
                }
            }
            $request->session()->put('_vendor_registration_step', 2);
            $request->session()->put('_vendor_id', $vendorObj->vendor_id);
            $request->session()->put('_vendor_username', $request->input('username'));
            $request->session()->put('_vendor_password', $request->input('password'));
            return $request->has('active') && $request->active == 1 ? redirect('admin/vendors')->with('edit-success','Vendor Added Successfully.') : redirect('admin/inactive-vendors')->with('edit-success','Vendor Added Successfully.');
        } 
    }
    public function makeSlugFromTitle($title)
    {
        $slug = str_slug($title);
        $count = VendorCompany::whereRaw("business_name_slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }

    protected function active_vendors(Request $request)
    {
        $name = $request->name;
        $category = $request->category;
        $catVendors = array();
        if($name != null && $name != '') {
            $compData = VendorCompany::leftJoin('vendors','vendor_companies.vendor_id','=','vendors.vendor_id')->select('vendor_companies.vendor_id')->where('vendors.username','like','%'.$name.'%')->orWhere('vendors.contact_person','like','%'.$name.'%')->orWhere('vendors.email','like','%'.$name.'%')->orWhere('vendor_companies.province','like','%'.$name.'%')->orWhere('vendor_companies.city','like','%'.$name.'%')->orWhere('vendor_companies.business_name','like','%'.$name.'%')->get();
            foreach($compData as $cp) {
                if(!in_array($cp->vendor_id, $catVendors)) {
                    array_push($catVendors,$cp->vendor_id);
                }
            }
            if(count($catVendors) > 0) {
                $query = Vendor::whereIn('vendor_id', $catVendors)->where('parent_vendor_id', 0)->where('status', 1)->where('freelisting','No')->where('verified', 1)->orderBy('created_at', 'desc');
            } else {
                $query = Vendor::where('parent_vendor_id', 0)->where('status', 1)->where('freelisting','No')->where('verified', 1)->orderBy('created_at', 'desc');
            }
        } else {
            $query = Vendor::where('parent_vendor_id', 0)->where('status', 1)->where('freelisting','No')->where('verified', 1)->orderBy('created_at', 'desc');
        }
        $query->select('vendors.*',DB::raw("(select avg(average_rating) from vendor_ratings where status = 1 and vendor_id = vendors.vendor_id) as avg_rating"),DB::raw("(SELECT GROUP_CONCAT(categories.title) FROM categories JOIN vendor_category_relation ON vendor_category_relation.category_id = categories.id WHERE vendor_category_relation.vendor_id = vendors.vendor_id) AS categories"));
        if($category != null && $category != '') {
            $query->join('vendor_category_relation','vendor_category_relation.vendor_id','=','vendors.vendor_id');
            $query->where('vendor_category_relation.category_id',$category);
        }
        $vendors = $query->with(['noOfCouples','category_data','image_data','company_data'])->paginate(20);
        $categories = Category::where('status', 1)->get();
        $enCount = ContactEnquiry::select('company_id',DB::raw('count(company_id) as enCount'))->where('form_data',2)->groupBy('company_id')->get()->toArray();
        return view('admin/vendors/active_list', [
            'vendors' => $vendors,
            'categories' => $categories,
            'enCount' => $enCount
        ]);
    }

    protected function freelisting_vendors(Request $request)
    {
        $name = $request->name;
        $category = $request->category;
        $catVendors = array();
        if($name != null && $name != '') {
            $compData = VendorCompany::leftJoin('vendors','vendor_companies.vendor_id','=','vendors.vendor_id')->select('vendor_companies.vendor_id')->where('vendors.username','like','%'.$name.'%')->orWhere('vendors.contact_person','like','%'.$name.'%')->orWhere('vendors.email','like','%'.$name.'%')->orWhere('vendor_companies.province','like','%'.$name.'%')->orWhere('vendor_companies.city','like','%'.$name.'%')->orWhere('vendor_companies.business_name','like','%'.$name.'%')->get();
            foreach($compData as $cp) {
                if(!in_array($cp->vendor_id, $catVendors)) {
                    array_push($catVendors,$cp->vendor_id);
                }
            }
            if(count($catVendors) > 0) {
                $query = Vendor::whereIn('vendor_id', $catVendors)->where('parent_vendor_id', 0)->where('freelisting','Yes')->orderBy('created_at', 'desc');
            } else {
                $query = Vendor::where('parent_vendor_id', 0)->where('freelisting','Yes')->orderBy('created_at', 'desc');
            }
        } else {
            $query = Vendor::where('parent_vendor_id', 0)->where('freelisting','Yes')->orderBy('created_at', 'desc');
        }
        $query->select('vendors.*',DB::raw("(select avg(average_rating) from vendor_ratings where status = 1 and vendor_id = vendors.vendor_id) as avg_rating"),DB::raw("(SELECT GROUP_CONCAT(categories.title) FROM categories JOIN vendor_category_relation ON vendor_category_relation.category_id = categories.id WHERE vendor_category_relation.vendor_id = vendors.vendor_id) AS categories"));
        if($category != null && $category != '') {
            $query->join('vendor_category_relation','vendor_category_relation.vendor_id','=','vendors.vendor_id');
            $query->where('vendor_category_relation.category_id',$category);
        }
        $vendors = $query->with(['noOfCouples','category_data','image_data','company_data'])->paginate(20);
        $categories = Category::where('status', 1)->get();
        $enCount = ContactEnquiry::select('company_id',DB::raw('count(company_id) as enCount'))->where('form_data',2)->groupBy('company_id')->get()->toArray();
        $subscription = Subscription::get();
        return view('admin/vendors/freelisting', [
            'vendors' => $vendors,
            'categories' => $categories,
            'enCount' => $enCount,
            'subscription'=>$subscription
        ]);
    }

    public function freelisting_mail_template()
    {
        return view('admin/vendors/freelisting_mail_template');
    }

    public function mailingFileupload(Request $request)
    {
        $reponce = array();
        $file = $request->file('fileobj');
        $imgName = str_random(30).'.'.$file->extension();
        $file->move('images/mailing_images',$imgName);
        if($file != '') {
            $reponce['html'] = '<div class="app-admin-sol-template-tag inbox-message-link">
                <span class="icon icon-clip icon-left inbox-message-link__label fleft">'.$file->getClientOriginalName().'</span>
                <a class="icon icon-close-small inbox-message-link__remove app-admin-sol-attached-del" data-imgName='.$imgName.'></a>
            </div>';
            $reponce['imgName'] = $imgName;
        } else {
            $reponce['html'] = '';
            $reponce['imgName'] = '';
        }
        echo json_encode($reponce);
    }

    public function mailingFileremove($imgName)
    {
        unlink('images/mailing_images/'.$imgName);
        echo 'removed';
    }

    public function bulk_freelisting_vendor(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required', 'comments' => 'required'
        ],[ 'subject.required' => 'Template Subject is required.', 'comments.required' => 'Please write something in message box.']);
        $mailCount = 0;
        $vendors = Vendor::with('company_data')->where('freelisting','Yes')->get();
        foreach($vendors as $vnd) {
            $pay_link = url('payment-freelisting-details/'.$vnd->vendor_id);
            $siteLogo = url('/')."/public/images/logo.png";
            $heading = 'Hi '.ucwords($vnd->contact_person);
            $email_template_arr = array('subject' => $request->subject, 'content' => $request->comments, 'attachment' => $request->attachment, 'siteLogo'=>$siteLogo, 'pay_link'=>$pay_link, 'heading'=>$heading);
            try {
                Mail::to($vnd->email)->send(new FreelistingMail($email_template_arr));
            } catch (\Exception $e) {}
            $mailCount++;
        }
        if($mailCount > 0) {
            return redirect()->back()->with('message','<div class="alert alert-success">Mail sent to all Freelisting Vendors.</div>');
        } else {
            return redirect()->back()->with('message','<div class="alert alert-danger">Something went wrong please try again.</div>');
        }
    }

    public function bulk_guest_vendor(Request $request) //// Upload Bulk Vendors here......
    {
        if($request->hasFile('uploadcsv')){
            $path = $request->file('uploadcsv')->getRealPath();
            $data = \Excel::load($path)->get();
            if($data->count()) {
                $vCount = 0;
                foreach ($data as $key => $value) {
                    $vCount++;
                    $cat_id = Category::where('title',$value->vendor_category)->first();
                    $newVendor = new Vendor();
                    $newVendor->contact_person = $value->contact_person ? : '';
                    $newVendor->telephone = $value->telephone ? : '';
                    $newVendor->mobile = $value->mobile ? : '';
                    $newVendor->fax = $value->fax ? : '';
                    $newVendor->website = $value->website ? : '';
                    $newVendor->email = $value->email ? : '';
                    $newVendor->message_notify_email = $value->email_for_message_notification ? : '';
                    $newVendor->cat_id = @$cat_id->id;
                    $newVendor->username = '';
                    $newVendor->password = '';
                    $newVendor->step_completed = '4';
                    $newVendor->status = '1';
                    $newVendor->business_description = '';
                    $newVendor->freelisting = 'Yes';
                    $newVendor->save();
                    if($newVendor->vendor_id) {
                        $businessNameSlug = str_replace(' ','_',strtolower(@$value->business_name));
                        $business_name_slug = str_replace('.','',$businessNameSlug);
                        $vendorCompany = new VendorCompany;
                        $vendorCompany->vendor_id = $newVendor->vendor_id;
                        $vendorCompany->country = $value->country ? : '';
                        $vendorCompany->province = $value->province ? : '';
                        $vendorCompany->city = $value->city ? : '';
                        $vendorCompany->postal_code = $value->postal_code ? : '';
                        $vendorCompany->address = $value->address ? : '';
                        $vendorCompany->business_name = $value->business_name ? : '';
                        $vendorCompany->business_name_slug = $business_name_slug ? : '';
                        $vendorCompany->business_detail = $value->business_detail ? : '';
                        $vendorCompany->business_address = $value->business_address ? : '';
                        $vendorCompany->save();
                        //// Save Vendor Location for MAP......
                        $city = Cities::where('name','LIKE','%'.$value->city.'%')->first();
                        if($value->country != '' && $city->id != '' && $value->postal_code != '' && $value->address != '') {
                            $vendor_loc                  = new VendorLocation();
                            $vendor_loc->vendor_id       = $newVendor->vendor_id;
                            $vendor_loc->address         = $value->address;
                            $vendor_loc->city_id         = $city->id;
                            $vendor_loc->postal_code     = $value->postal_code;
                            $vendor_loc->main_telephone  = $value->telephone ? : '';
                            $vendor_loc->fax             = $value->fax ? : '';
                            $vendor_loc->extension       = '';
                            $vendor_loc->other_telephone = $value->mobile ? : '';
                            $vendor_loc->business_hours  = '';
                            $vendor_loc->save();
                        }
                    }
                }
                return redirect()->back()->with('success', "$vCount Guest vendors uploaded Successfully");
            }
        }
    }

    public function inactive_vendors(Request $request)
    {
        $name = $request->name;
        $category = $request->category;
        $catVendors = array();
        if($name != null && $name != '') {
            $compData = VendorCompany::leftJoin('vendors','vendor_companies.vendor_id','=','vendors.vendor_id')->select('vendor_companies.vendor_id')->where('vendors.username','like','%'.$name.'%')->orWhere('vendors.contact_person','like','%'.$name.'%')->orWhere('vendors.email','like','%'.$name.'%')->orWhere('vendor_companies.province','like','%'.$name.'%')->orWhere('vendor_companies.city','like','%'.$name.'%')->orWhere('vendor_companies.business_name','like','%'.$name.'%')->get();
            foreach($compData as $cp) {
                if(!in_array($cp->vendor_id, $catVendors)) {
                    array_push($catVendors,$cp->vendor_id);
                }
            }
            if(count($catVendors) > 0) {
                $query = Vendor::whereIn('vendor_id',$catVendors)->where('parent_vendor_id',0)->where('freelisting','No')->where('verified',0)->orWhere('status',0)->orderBy('created_at','desc');
            } else {
                $query = Vendor::where('parent_vendor_id',0)->where('freelisting','No')->where('verified',0)->orWhere('status',0)->orderBy('created_at','desc');
            }
        } else {
            $query = Vendor::where('parent_vendor_id',0)->where('freelisting','No')->where('verified',0)->orWhere('status',0)->orderBy('created_at','desc');
        }
        $query->select('vendors.*',DB::raw("(select avg(average_rating) from vendor_ratings where status = 1 and vendor_id = vendors.vendor_id) as avg_rating"),DB::raw("(SELECT GROUP_CONCAT(categories.title) FROM categories JOIN vendor_category_relation ON vendor_category_relation.category_id = categories.id WHERE vendor_category_relation.vendor_id = vendors.vendor_id) AS categories"));
        if($category != null && $category != '') {
            $query->join('vendor_category_relation','vendor_category_relation.vendor_id','=','vendors.vendor_id');
            $query->where('vendor_category_relation.category_id',$category);
        }
        $vendors = $query->with(['noOfCouples','category_data','image_data','company_data'])->paginate(20);
        $categories = Category::where('status', 1)->get();
        // $vendors = Vendor::with(['noOfCouples','category_data','company_data'])->leftJoin('categories','vendors.cat_id','=','categories.id')->select('vendors.*','categories.title')->where('vendors.freelisting','Yes')->orderBy('vendors.created_at', 'desc')->get();
        return view('admin/vendors/inactive_list', ['vendors' => $vendors,'categories' => $categories]);
    }

    public function pending_vendors(Request $request)
    {
        $name = $request->name;
        $category = $request->category;
        $catVendors = array();
        if($name != null && $name != '') {
            $compData = VendorCompany::leftJoin('vendors','vendor_companies.vendor_id','=','vendors.vendor_id')->select('vendor_companies.vendor_id')->where('vendors.username','like','%'.$name.'%')->orWhere('vendors.contact_person','like','%'.$name.'%')->orWhere('vendors.email','like','%'.$name.'%')->orWhere('vendor_companies.province','like','%'.$name.'%')->orWhere('vendor_companies.city','like','%'.$name.'%')->orWhere('vendor_companies.business_name','like','%'.$name.'%')->get();
            foreach($compData as $cp) {
                if(!in_array($cp->vendor_id, $catVendors)) {
                    array_push($catVendors,$cp->vendor_id);
                }
            }
            if(count($catVendors) > 0) {
                $query = Vendor::rightJoin('payment_methods as PM','PM.vendor_id','=','vendors.vendor_id')->whereIn('PM.vendor_id',$catVendors)->where('vendors.parent_vendor_id', 0)->where('vendors.freelisting','Yes')->orderBy('created_at','desc');
            } else {
                $query = Vendor::rightJoin('payment_methods as PM','PM.vendor_id','=','vendors.vendor_id')->where('vendors.parent_vendor_id', 0)->where('vendors.freelisting','Yes')->orderBy('created_at','desc');
            }
        } else {
            $query = Vendor::rightJoin('payment_methods as PM','PM.vendor_id','=','vendors.vendor_id')->where('vendors.parent_vendor_id', 0)->where('vendors.freelisting','Yes')->orderBy('created_at','desc');
        }
        $query->select('vendors.*',DB::raw("(select avg(average_rating) from vendor_ratings where status = 1 and vendor_id = vendors.vendor_id) as avg_rating"),DB::raw("(SELECT GROUP_CONCAT(categories.title) FROM categories JOIN vendor_category_relation ON vendor_category_relation.category_id = categories.id WHERE vendor_category_relation.vendor_id = vendors.vendor_id) AS categories"));
        if($category != null && $category != '') {
            $query->join('vendor_category_relation','vendor_category_relation.vendor_id','=','vendors.vendor_id');
            $query->where('vendor_category_relation.category_id',$category);
        }
        $query->groupBy('vendors.vendor_id');
        $vendors = $query->with(['noOfCouples','category_data','image_data','company_data'])->paginate(20);
        $categories = Category::where('status', 1)->get();
        $subscription = Subscription::get();
        return view('admin/vendors/pending_list', ['vendors' => $vendors,'categories' => $categories,'subscription'=>$subscription]);
    }

    public function payment_data($vendorId=null)
    {
        $response = array();
        $payData = PaymentMethod::where('vendor_id',$vendorId)->first();
        if($payData->subscription_id) {
            $subsData = Subscription::where('id',$payData->subscription_id)->first();
            $response['type'] = $subsData->type;
            $response['amount'] = $subsData->amount;
            $response['duration'] = $subsData->duration;
            $response['payId'] = $payData->id;
            $response['cardholder_name'] = $payData->cardholder_name;
            $response['card_number'] = $payData->card_number;
            $response['card_cvc'] = $payData->card_cvc;
            $response['exp_month'] = $payData->exp_month;
            $response['exp_year'] = $payData->exp_year;
            $response['pay_type'] = $payData->pay_type;
            $response['subscription_id'] = $payData->subscription_id;
            echo json_encode($response);
        } else {
            echo json_encode($response);
        }
    }

    public function payment_data_save(Request $request)
    {
        $vendorId = $request->vendor_id;
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
                for($vbn = 0; $vbn < $numLoops; $vbn++) {
                    $vendorBill = new VendorBill;
                    $vendorBill->vendor_id       = $vendorId;
                    $vendorBill->subscription_id = $request->subscription_id;
                    $vendorBill->invoice_id      = $vendorInvoice->id;
                    $vendorBill->invoice_number  = 'PWDVND'.$vendorId.(date('m',strtotime("+$vbn months",strtotime(date('Y-m-d')))));
                    $vendorBill->due_date        = date('Y-m-d', strtotime("+$vbn months", strtotime(date('Y-m-d'))));
                    $vendorBill->paid_amount     = round($subscription->amount / $numLoops, 2);
                    $vendorBill->paid_date       = date('Y-m-d');
                    $vendorBill->card_id         = $request->payId;
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
                }
            }
            $vendors = Vendor::find($vendorId);
            $vendors->status = 1;
            $vendors->pay_status = 1;
            $vendors->freelisting = 'No';
            $vendors->save();
            //// Payment Mail......
            try {
                Mail::to($vendors->email)->send(new PaymentSuccessMail($vendors,$vendorInvoice,$subsAmount,'approved','payment_success'));
                //// Mail to Admin......
                $subject = "Vendor Payment Details"; //cesario@indigitalgroup.ca
                // Mail::to('citstestdev@gmail.com')->send(new VendorMailToAdmin($vendors,$subsAmount,$subject,'done'));
                Mail::to('cesario@perfectweddingday.ca')->send(new VendorMailToAdmin($vendors,$subsAmount,$subject,'done'));
                //// Verification Mail......
                $updLink = url('login').'?verification='.encrypt($vendors->username);
                Mail::to($vendors->email)->send(new PaymentSuccessMail($vendors,array(),'',$updLink,'payment_thankyou'));
            } catch (\Exception $e) {}
            return 'Payment approved successfully and verification email sent to vendor. It is set to inactive vendor untill vendor verified it from email.';
        } else {
            return $mpgResponse->getMessage();
        }
    }

    public function change_listing_status($id=null,$status=null)
    {
        $vendors = Vendor::find($id);
        if($status == 'Freelisting') {
            $vendors->freelisting = 'No';
        } else {
            $vendors->freelisting = 'Yes';
        }
        $vendors->save();
        if($status == 'Freelisting') {
            return 'Paid Listed';
        } else {
            return 'Freelisting';
        }
    }

    public function change_listing_status2($id=null,$status=null)
    {
        $vendors = Vendor::find($id);
        if($status === 'No')
            $vendors->freelisting = $status;
        else{
            $vendors->freelisting = 'Yes';
            return redirect()->back()->with('error','Something went wrong. Please try again later !!');
        }
        $vendors->save();
        return redirect()->back()->with('success','Successfully changed vendor to paid listing !');
    }

    public function payment_with_listing_status(Request $request)
    {
        $vendorId = $request->vendor_id;
        $vendorData = Vendor::where('vendor_id',$vendorId)->first();
        if($vendorId && isset($vendorData->id)) {
            $paymnt = new PaymentMethod();
            $paymnt->vendor_id       = $vendorId;
            /*$paymnt->cardholder_name = $request->cardholder_name;
            $paymnt->card_type       = $request->cardType;
            $paymnt->card_number     = $request->card_number;
            $paymnt->card_cvc        = $request->card_cvc;
            $paymnt->exp_month       = $request->exp_month;
            $paymnt->exp_year        = $request->exp_year;*/
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
                } elseif($subscription->duration == '1 Month') {
                    $numLoops = 1;
                    $due_date = date('Y-m-d', strtotime("+1 months", strtotime($due_date)));
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
                // }
                /*$store_id = 'store5';
                $api_token = 'yesguy';
                $txnArray = array(
                    'type'               => 'purchase',
                    'order_id'           => time().rand(000,999),
                    'cust_id'            => $request->cardholder_name,
                    'amount'             => number_format($subsAmount,2,".",""),
                    'pan'                => $request->card_number,
                    'expdate'            => substr($request->exp_year,2,2).sprintf("%02d",$request->exp_month),
                    'crypt_type'         => '7',
                    'dynamic_descriptor' => 'My Health Squad'
                );
                $mpgTxn = new mpgTransaction($txnArray);
                $mpgRequest = new mpgRequest($mpgTxn);
                $mpgRequest->setProcCountryCode("CA");*/
                // if(($request->has('cardtest') && $request->cardtest == 'yes') || $_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
                // }
                /*$mpgRequest->setTestMode(true);
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
                        }
                    }
                    $vendors = Vendor::find($vendorId);
                    $vendors->status = 1;
                    $vendors->pay_status = 1;
                    $vendors->freelisting = 'No';
                    $vendors->save();
                    //// Payment Mail......
                    Mail::to($vendors->email)->send(new PaymentSuccessMail($vendors,$vendorInvoice,$subsAmount,'approved','payment_success'));
                    //// Mail to Admin......
                    $subject = "Vendor Payment Details"; //cesario@indigitalgroup.ca
                    Mail::to('citstestdev@gmail.com')->send(new VendorMailToAdmin($vendors,$subsAmount,$subject,'done'));
                    Mail::to('cesario@perfectweddingday.ca')->send(new VendorMailToAdmin($vendors,$subsAmount,$subject,'done'));
                    //// Verification Mail......
                    $updLink = url('login').'?verification='.encrypt($vendors->username);
                    Mail::to($vendors->email)->send(new PaymentSuccessMail($vendors,array(),'',$updLink,'payment_thankyou'));
                    return 'Payment approved successfully and verification email sent to vendor. It is set to inactive vendor untill vendor verified it from email.';
                } else {
                    return $mpgResponse->getMessage();
                }*/
            } else {
                return redirect()->back()->with('error','Payment not saved to database. So please try again later !!');
            }
        } else {
            return redirect()->back()->with('error','Your selected vendor is not found. So please try again later !!');
        }
    }

    protected function vendor_details($id)
    {
        $venData = Vendor::getAll($id);
        $teamData = VendorTeammember::where('vendor_id',$id)->get();
        $reviewData = VendorRating::with('user')->where('vendor_id',$id)->get();
        $billData = VendorBill::with('vendor')->where('vendor_id',$id)->get();
        $connectedCouple = UserBookedVendor::with('user')->where('vendor_id',$id)->get();
        $dateE = Carbon::now(); 
        $date = Carbon::now(); 
        $dateS = $date->modify("-12 months"); // Last day 12 months ago
        $venComp = @$venData['company_data']->id;
        $chatMessage = ContactEnquiry::with('user', 'replies')->where('form_data',2)->where('company_id',$venComp)->orderBy('id','desc')->get();
        $assMem = array(@$venData['vendor_data']->assign_sales,@$venData['vendor_data']->assign_marketing,@$venData['vendor_data']->assign_customer,@$venData['vendor_data']->assign_technical);
        $staffMember = Admin::whereIn('id',$assMem)->get();
        // dd($venData);
        if(isset($venData['vendor_data']) && !empty($venData['vendor_data'])){
            return view('admin/vendors/details', [
                'vendorData' => $venData,
                'chatMessage' => $chatMessage,
                'teamData' => $teamData,
                'reviewData' => $reviewData,
                'billData' => $billData,
                'connCouples' => $connectedCouple,
                'staffMember' => $staffMember,
            ]);
        } else {
           return redirect('admin/vendors');
        }
    }

    protected function edit_vendors($id)
    {
        // $catData = Vendor::where('vendor_id', $id)->first()->toArray();
        // return view('admin/vendors/edit', [
        //     'vendorData' => $venData,
        // ]);
        
        $admins = Admin::where('status',2)->get();
        $dataVal = Vendor::orderBy('created_at', 'asc')->where('vendor_id',$id)->first();
        $company_data = VendorCompany::where('vendor_id',$id)->first()->toArray();
       
        // return $id;
        
        $countryData = Countries::get()->toArray();
        $provinceData = States::get()->toArray();
        // dd($provinceData);
        
        $pageData = Page::select('id','url','title','image','image_description','description','meta_title','meta_description','meta_keyword')->where('id', 8)->first();
            $categories = Category::getCategory();
            $regions = Regions::distinct()->get(['state']);
            $socialMedia = SocialMedia::all();
             $business_hours=BusinessHours::where('vendor_id',$id)->get();
         $businfo=BusinessInfo::where('vendor_id',$id)->first();
         $cat=VendorCategoryRelation::where('vendor_id',$id)->get();
         $social=BusinessSocialMedia::where('vendor_id',$id)->get();
         $vendorImages = VendorImage::where('vendor_id',$id)->get();
         $features=Feature::get();
         $districts=District::get();
         $vendorfeatures=VendorFeature::where('vendor_id',$id)->get();
         $tags=Tag::where('vendor_id',$id)->get();
        if(isset($dataVal) && !empty($dataVal)) {
            // return view('admin/vendors/edit', [
            //     'data' => $dataVal->toArray(),
            //     'admins' => $admins,
            //     'company_data' => $company_data,
            //     'countries'=>$countryData,
            //     'province'=>$provinceData,
            // ]);
            // echo $cat;
            // die;
            //dd($social);
             return view('admin/vendors/editvendor', [
                'vendorData' => $dataVal,
                'admins' => $admins,
                'company_data' => $company_data,
                'countries'=>$countryData,
                'province'=>$provinceData,
                'regions'=>$regions,
                'socialMedia'=>$socialMedia,
                'categories'=>$categories,
                'businessHours'=>$business_hours,
                'businfo'=>$businfo,
                'cat'=>$cat,
                'social'=>$social,
                'images' => $vendorImages,
                'features'=>$features,
                'vendorfeatures'=>$vendorfeatures,
                'tags'=>$tags,
                'districts'=>$districts
            ]);
        } else {
           return redirect('admin/vendors');
        }
    }

    protected function edit_vendor_data(Request $request)
    {
        $venObj = Vendor::find($request->input('vendor_id'));
        $moreInfoObject = BusinessInfo::where('vendor_id',$request->input('vendor_id'))->first();
        if(!isset($moreInfoObject->id)){
            $moreInfoObject = new BusinessInfo;
            $moreInfoObject->vendor_id = $venObj->vendor_id;
        }
        $vendorId = $request->input('vendor_id');
        $venCompObj = VendorCompany::where('vendor_id',$request->input('vendor_id'))->first();
        
        if($request->input('password')) {
             if($request->email1==$request->email)
          {
            $this->validate($request, [
                // 'profile_image' => 'image',
                // 'description' => 'required',
                // 'mobile' => 'required',
                'telephone' => 'required|regex:/[0-9]/',
                'email' => 'required|email',
                'mobile' => 'max:10|nullable|regex:/[0-9]/',
                // 'website' => 'required',
                'postal_code' => 'required',
                'contact_person' => 'required',
                'password' => 'required|min:6|same:password',
                'confirm_password' => 'required|min:6|same:password',
                 'category' => 'required|array|min:1',
                 'feature1' => 'required|array|min:1',
                 'district'=>'required',
                 'location'=>'required'
            ]);
          }
          else
          {
            $this->validate($request, [
                // 'profile_image' => 'image',
                // 'description' => 'required',
                // 'mobile' => 'required',
                'telephone' => 'required|regex:/[0-9]/',
                'email' => 'required|email',
                'mobile' => 'max:10|nullable|regex:/[0-9]/',
                // 'website' => 'required',
                'postal_code' => 'required',
                'contact_person' => 'required',
                'password' => 'required|min:6|same:password',
                'confirm_password' => 'required|min:6|same:password',
                 'category' => 'required|array|min:1',
                 'feature1' => 'required|array|min:1',
                 'district'=>'required',
                 'location'=>'required'
            ]);  
          }
        } else {
             if($request->email1==$request->email)
          {
            $this->validate($request, [
                // 'profile_image' => 'image',
                // 'description' => 'required',
                // 'mobile' => 'required',
                'telephone' => 'required|regex:/[0-9]/',
                'email' => 'required|email',
                'mobile' => 'max:10|nullable|regex:/[0-9]/',
                // 'website' => 'required',
                'postal_code' => 'required',
                'contact_person' => 'required',
                 'category' => 'required|array|min:1',
                 'feature1' => 'required|array|min:1',
                 'district'=>'required',
                 'location'=>'required'
            ]);
          }
          else
          {
              $this->validate($request, [
                // 'profile_image' => 'image',
                // 'description' => 'required',
                // 'mobile' => 'required',
                'telephone' => 'required|regex:/[0-9]/',
                'mobile' => 'max:10|nullable|regex:/[0-9]/',
                'email' => 'required|email',
                // 'website' => 'required',
                'postal_code' => 'required',
                'contact_person' => 'required',
                 'category' => 'required|array|min:1',
                 'feature1' => 'required|array|min:1',
                 'district'=>'required',
                 'location'=>'required'
            ]);
          }
        }
        if($request->has('password') && !empty($request->input('password'))) {
            $this->validate($request, [
                'password' => 'required_with:confirm_password|string|min:6|same:confirm_password',
                'confirm_password' => 'min:6'
                ]);
            $venObj->password = bcrypt($request->input('password'));
        }
        $categories = $request->input('category');
        $features=$request->input('feature1');
        if($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            // $destinationPath = public_path('/vendor_profile');
            $destinationPath = public_path('/vendors/VENDOR_'.$vendorId);
            $image->move($destinationPath, $name);
            $venObj->profile = $name;
        }
        if(!empty($request->input('profile_image')) && strlen($request->input('profile_image')) > 6) {
            $featuredImage = $request->input('profile_image');
            if(preg_match('/data:image/', $featuredImage)) {
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time() . '_profile_'.mt_rand(1000,9999) . '.png';
                $path = public_path() . '/vendors/VENDOR_' . $venObj->vendor_id;
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path. '/' . $image_name, $featuredImage);
                $vendorImageObj = VendorImage::where('image',$venObj->profile)->first();
                if(isset($vendorImageObj->id) && !empty($vendorImageObj->id))
                    $vendorImageObj = VendorImage::find($vendorImageObj->id);
                else
                    $vendorImageObj = new VendorImage;
                $vendorImageObj->vendor_id = $venObj->vendor_id;
                $vendorImageObj->vendor_folder = 'VENDOR_'.$venObj->vendor_id;
                $vendorImageObj->image = $image_name;
                $vendorImageObj->save();
                $venObj->profile = $image_name;
            }
        }
        $venObj->business_description = $request->business_detail;
        $venObj->telephone = $request->telephone;
        $venObj->mobile = $request->mobile;
        $venObj->email = $request->email;
        $venObj->website = $request->website;
        $venObj->contact_person = $request->contact_person;
        
        $venObj->assign_sales = $request->assign_sales;
        $venObj->assign_marketing = $request->assign_marketing;
        $venObj->assign_customer = $request->assign_customer;
        $venObj->assign_technical = $request->assign_technical;
        $venObj->is_business_hours = $request->has('is_business_hours') && $request->is_business_hours == 1 ? 1 : 0;
        
        if($request->hasFile('featured_image')) {
            @unlink(public_path('/vendors/VENDOR_'.$venObj->vendor_id).@$venObj->featured_image);
            $image = $request->file('featured_image');
            $input['image'] = time().'_featured_'.mt_rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/vendors/VENDOR_'.$venObj->vendor_id);
            if($image->move($destinationPath, $input['image'])) {
                $venObj->featured_image = $input['image'];
            }
        }
        if(!empty($request->input('featured_image')) && strlen($request->input('featured_image')) > 6) {
            $featuredImage = $request->input('featured_image');
            if(preg_match('/data:image/', $featuredImage)) {
                @unlink(public_path('/vendors/VENDOR_'.$venObj->vendor_id).@$venObj->featured_image);
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time() . '_featured_'.mt_rand(1000,9999) . '.png';
                $path = public_path() . '/vendors/VENDOR_' . $venObj->vendor_id;
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path. '/' . $image_name, $featuredImage);
                $venObj->featured_image = $image_name;
            }
        }

        $venCompObj->business_name = $request->business_name;
        $venCompObj->postal_code = $request->postal_code;
        $venCompObj->business_detail = $request->business_detail;
        $venCompObj->business_address = $request->address;
        $venCompObj->address = $request->address;
        $venCompObj->district = $request->district;
        $venCompObj->location = $request->location;
       
        $data = $venObj->save();
        $venCompObj->save();
        
        
        if($data){
            
            //$moreInfoObject->vendor_id = $request->input('vendor_id');
            // $moreInfoObject->free_parking = $request->input('free_parking');
            // $moreInfoObject->paid_parking = $request->input('paid_parking');
            // $moreInfoObject->indoor_parking = $request->input('indoor_parking');
            // $moreInfoObject->no_parking = $request->input('no_parking');
            // $moreInfoObject->wheel_chair = $request->input('wheelchair');
            // $moreInfoObject->motor_vehicle = $request->input('motor_vehicle');
            // $moreInfoObject->health_benefit = $request->input('health_benefit');
            // $moreInfoObject->gov_insurance = $request->input('gov_insurance');
            // $moreInfoObject->self_pay = $request->input('self_pay');
            // $moreInfoObject->personal_cheque = $request->input('personal_cheque');
            // $moreInfoObject->finance_available = $request->input('finance_available');
            // if(!empty($request->input('special_message')))
            //     $moreInfoObject->holiday_special = $request->input('special_message');
            // // $moreInfoObject->language_spoke = $request->input('language_spoken');
            // if(!empty($request->input('languages')))
            //     $moreInfoObject->language = is_array($request->input('languages')) ? implode(',',$request->input('languages')) : $request->input('languages');
            // if(!empty($request->input('sign_language')))
            //     $moreInfoObject->sign_language = $request->input('sign_language');
            // if(!empty($request->input('lgbtq')))
            //     $moreInfoObject->lgbtq = $request->input('lgbtq');
            // $moreInfoObject->save();  
            VendorFeature::where('vendor_id',$vendorId)->delete();
        foreach ($features as $key => $value) {
                $vendorfeature = new VendorFeature;
                $vendorfeature->feature_id = $value;
                $vendorfeature->vendor_id = $vendorId;
                $vendorfeature->save();
            }
            Tag::where('vendor_id',$vendorId)->delete();
            $tags=$request->input('tag');
            $myArray = explode(',', $tags);
            
            foreach ($myArray as $key) {
            $tag=new Tag;
            $tag->vendor_id=$vendorId;
            $tag->tagname=$key;
            $tag->save();
            }
           BusinessSocialMedia::where('vendor_id',$request->input('vendor_id'))->delete();
            $socialMedia = SocialMedia::all();
            foreach($socialMedia as $social){
                $businessSocialObj = new BusinessSocialMedia;
                $businessSocialObj->vendor_id = $request->input('vendor_id');
                $businessSocialObj->social_media_id = SocialMedia::get_social_media_id($social->slug);
                $businessSocialObj->link = $request->input($social->slug);
                $businessSocialObj->save();
            }
            BusinessHours::where('vendor_id',$request->input('vendor_id'))->delete();
            if(!empty($request->only('sunday_open','sunday_open'))){
                $businessHours = new BusinessHours();
                $businessHours->vendor_id = $request->input('vendor_id');
                $businessHours->day = 'SUN';
                $businessHours->open = $request->input('sunday_open');
                $businessHours->close = $request->input('sunday_close');
                $businessHours->save();
            }
            if(!empty($request->only('monday_open','monday_close'))){
                $businessHours = new BusinessHours();
                $businessHours->vendor_id = $request->input('vendor_id');
                $businessHours->day = 'MON';
                $businessHours->open = $request->input('monday_open');
                $businessHours->close = $request->input('monday_close');
                $businessHours->save();
            }
            if(!empty($request->only('tue_open','tue_close'))){
                $businessHours = new BusinessHours();
                $businessHours->vendor_id = $request->input('vendor_id');
                $businessHours->day = 'TUE';
                $businessHours->open = $request->input('tue_open');
                $businessHours->close = $request->input('tue_close');
                $businessHours->save();
            }
            if(!empty($request->only('wed_open','wed_close'))){
                $businessHours = new BusinessHours();
                $businessHours->vendor_id = $request->input('vendor_id');
                $businessHours->day = 'WED';
                $businessHours->open = $request->input('wed_open');
                $businessHours->close = $request->input('wed_close');
                $businessHours->save();
            }
            if(!empty($request->only('thu_open','thu_close'))){
                $businessHours = new BusinessHours();
                $businessHours->vendor_id = $request->input('vendor_id');
                $businessHours->day = 'THU';
                $businessHours->open = $request->input('thu_open');
                $businessHours->close = $request->input('thu_close');
                $businessHours->save();
            }
            if(!empty($request->only('fri_open','fri_close'))){
                $businessHours = new BusinessHours();
                $businessHours->vendor_id = $request->input('vendor_id');
                $businessHours->day = 'FRI';
                $businessHours->open = $request->input('fri_open');
                $businessHours->close = $request->input('fri_close');
                $businessHours->save();
            }
            if(!empty($request->only('sat_open','sat_close'))){
                $businessHours = new BusinessHours();
                $businessHours->vendor_id = $request->input('vendor_id');
                $businessHours->day = 'SAT';
                $businessHours->open = $request->input('sat_open');
                $businessHours->close = $request->input('sat_close');
                $businessHours->save();
            }
            VendorCategoryRelation::where('vendor_id',$request->input('vendor_id'))->delete();
            foreach ($categories as $key => $value) {
                $vendorCategoryObject = new VendorCategoryRelation;
                $vendorCategoryObject->category_id = $value;
                $vendorCategoryObject->vendor_id = $request->input('vendor_id');
                $vendorCategoryObject->save();
            }
            
            return redirect('admin/vendor-details/'.$vendorId)->with('edit-success','Vendor Updated Successfully.');
        } else {
            return redirect('admin/vendor-details/'.$vendorId)->with('edit-success','Something went wrong. Please try again.');
        }
    }
    protected function delvendor_details($id)
    {
        $v = Vendor::where('vendor_id',$id)->first();
        Vendor::where('vendor_id',$id)->delete();
        VendorCategoryRelation::where('vendor_id',$id)->delete();
        BusinessInfo::where('vendor_id',$id)->delete();
        BusinessSocialMedia::where('vendor_id',$id)->delete();
        BusinessHours::where('vendor_id',$id)->delete();
        VendorImage::where('vendor_id',$id)->delete();
        @File::deleteDirectory(@public_path('/vendors/VENDOR_'.$v->vendor_id));
        return redirect()->back()->with('delete-success','Vendor deleted Successfully.');
    }
    protected function deleteBulkVendors(Request $request){
        $idx = $request->vendors;
        foreach($idx as $id) {
            $v = Vendor::where('vendor_id',$id)->first();
            Vendor::where('vendor_id',$id)->delete();
            VendorCategoryRelation::where('vendor_id',$id)->delete();
            BusinessInfo::where('vendor_id',$id)->delete();
            BusinessSocialMedia::where('vendor_id',$id)->delete();
            BusinessHours::where('vendor_id',$id)->delete();
            VendorImage::where('vendor_id',$id)->delete();
            @File::deleteDirectory(@public_path('/vendors/VENDOR_'.$v->vendor_id));
        }
        return redirect()->back()->with('delete-success','Vendors are deleted Successfully.');
    }
    protected function view_team_member($id)
    {
        $dataVal = VendorTeammember::where('id',$id)->first();
        $vendor_data = Vendor::where('vendor_id',$dataVal->vendor_id)->first();
        $venComp = VendorCompany::where('vendor_id',$dataVal->vendor_id)->first()->id;
        $chatMessage = ContactEnquiry::with('user','replies')->where('form_data',2)->where('company_id',$venComp)->orderBy('id','desc')->get();
        if(isset($dataVal) && !empty($dataVal)) {
            return view('admin/vendors/view-team-member', ['data'=>$dataVal,'vendor_data'=>$vendor_data,'chatMessage'=>$chatMessage]);
        } else {
            return redirect('admin/vendors');
        }
    }

    protected function update_team_member(Request $request)
    {
        $venObj = Vendor::find($request->input('vendor_id'));
        $vendorId = $request->input('vendor_id');
        $venCompObj = VendorCompany::where('vendor_id',$request->input('vendor_id'))->first();
        $this->validate($request, [
            // 'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'profile_image' => 'image|max:2048',
            'description' => 'required',
            'mobile' => 'required',
            'telephone' => 'required',
            'email' => 'required|email',
            'website' => 'required',
            'contact_person' => 'required',
        ]);
        if($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            // $destinationPath = public_path('/vendor_profile');
            $destinationPath = public_path('/vendors/VENDOR_'.$vendorId);
            $image->move($destinationPath, $name);
            $venObj->profile = $name;
        }
        $venObj->business_description = $request->description;
        $venObj->telephone = $request->telephone;
        $venObj->mobile = $request->mobile;
        $venObj->email = $request->email;
        $venObj->website = $request->website;
        $venObj->contact_person = $request->contact_person;
        
        $venObj->assign_sales = $request->assign_sales;
        $venObj->assign_marketing = $request->assign_marketing;
        $venObj->assign_customer = $request->assign_customer;
        $venObj->assign_technical = $request->assign_technical;

        $venCompObj->business_name = $request->business_name;
        $venCompObj->business_detail = $request->business_detail;
        $venCompObj->business_address = $request->business_address;
        $venCompObj->city = $request->city;
        $venCompObj->province = $request->province;
        $venCompObj->country = $request->country;
        $data = $venObj->save();
        $venCompObj->save();
        if($data){
            return redirect()->back()->with('success', 'Vendor Updated Successfully.');
        } else {
            return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    protected function status_vendor($id,$status)
    {
        $socialObj = Vendor::find($id);
        $socialObj->status = $status;
        $socialObj->verified = 1;
        $data = $socialObj->save();
        if($data){
            return redirect()->back()->with('success', 'Vendor status has been updated.');
        } else {
            return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    protected function weddingidea_permission($id,$status)
    {
        $socialObj = Vendor::find($id);
        $socialObj->weddingidea_permission = $status;
        $data = $socialObj->save();
        if($data){
            return redirect()->back()->with('success', 'Wedding-Idea status has been updated.');
        }else{
            return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    public function all_invoices()
    {
        $vendorInvoices = VendorInvoice::with(['subscription','vendor_data','vendor_bills'])->orderBy('created_at', 'desc')->get();
        if(isset($vendorInvoices) && !empty($vendorInvoices)){
            return view('admin/vendors/all_invoices', [
                'vendorInvoices' => $vendorInvoices
            ]);
        } else {
           return redirect('admin/vendors');
        }
    }

    public function invoice_reminder($vendorId=null)
    {
        $billData = VendorBill::with('carddata')->where('vendor_id',$vendorId)->where('status','0')->orderBy('id','ASC')->first();
        if(@$billData->id) {
            $vendorData = Vendor::where('vendor_id',$vendorId)->first();
            $vendorCompany = VendorCompany::where('vendor_id',$vendorId)->first();
            $vendorImage = VendorImage::where('vendor_id',$vendorId)->where('status','1')->first();
            $review_cc = $vendorData->email;
            $vendorLogo = url('/public/vendors').'/'.$vendorImage->vendor_folder.'/'.$vendorImage->image;
            $vendorName = $vendorData->contact_person;
            $dueDate = date_format(date_create($billData->due_date),'d M Y');
            $newDueDate = date('d M Y', strtotime($billData->due_date.' + 15 days'));
            $paymentLink = url('bills');
            $messages = "I hope things are going well for you.<br/><br/> This is to remind you that your invoice <b>( <i>#".$billData->invoice_number."</i> )</b> in the amount of <b>( <i>$".$billData->paid_amount."</i> )</b> is overdue as of <b><i>".$dueDate."</i></b>. Please make your payment before <b><i>".$newDueDate."</i></b>, Otherwise your account will be Inactive.<br/><br/>If you have any questions concerning the same, Please contact us at <a href='mailto:cesario@indigitalgroup.ca'>cesario@indigitalgroup.ca</a>";
            $baseUrl = url('/');
            $compName = $vendorCompany->business_name;
            $address = $vendorCompany->address.' '.$vendorCompany->city;
            $subject = 'Review '.$vendorData->contact_person;
            $pageName = 'invoice_reminder_mail';

            // return view('emails.invoice_reminder_mail')->with(['review_cc' => $review_cc,'vendorLogo' => $vendorLogo,'vendorName' => $vendorName,'compName' => $compName,'messages' => $messages,'paymentLink' => $paymentLink,'baseUrl' => $baseUrl,'address' => $address,'subject' => $subject]); die;

            // Mail::to('citstestdev@gmail.com')->send(new InvoiceReminderMail($review_cc, $vendorLogo, $vendorName, $compName, $messages, $paymentLink, $baseUrl, $address, $subject, $pageName));
            return redirect()->back()->with('success', 'Reminder Mail has been sent Successfully.');
        } else {
            return redirect()->back()->with('failure', 'Something went wrong. Please try again.');
        }
    }

    public function download_invoice($id=null,$vendorId=null)
    {
        $pdfdata = array();
        $invcData = VendorInvoice::with(['subscription','featured_profile'])->where('id','=',$id)->first();
        $pdfdata['invoiceData'] = $invcData;
        $pdfdata['billData'] = VendorBill::with('carddata')->where('invoice_id','=',$id)->orderBy('id','ASC')->get();
        $pdfdata['pdfImage'] = url('public/images/logo.png');
        $pdfdata['vendorData'] = Vendor::with('company_data', 'category_data', 'image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        // $pdf = PDF::loadView('vendor.billinvoice.bill_invoice',compact('pdfdata'));
        return view('vendor.featured.invoice_template')->with(['pdfdata' => $pdfdata]);
        $pdf = PDF::loadView('vendor.featured.invoice_template',compact('pdfdata'));
        $customPaper = array(0,0,950,1500);
        $pdf->setPaper($customPaper);
        return $pdf->download($invcData->invoice_id.'.pdf');
    }

    public function unpaid_inactive_vendors()
    {
        $inactiveVendors = 0;
        $vendor_bills = VendorBill::where('status','0')->get();
        foreach($vendor_bills as $vb) {
            if($vb->due_date) {
                $curDate = strtotime(date('Y-m-d'));
                $newDueDate = strtotime(date('Y-m-d', strtotime($vb->due_date.' + 15 days')));
                if($curDate >= $newDueDate) {
                    if(@$vb->vendor_id) {
                        $vendor = Vendor::find($vb->vendor_id);
                        $vendor->status = '0';
                        $vendor->save();
                        $inactiveVendors++;
                    }
                }
            }
        }
        echo "Total $inactiveVendors Vendors are Inactive";
    }
    public function featured_status(Request $request)
    {
        $vendor = Vendor::find($request->id);
        $vendor->display_home_page = !$vendor->display_home_page;
        $vendor->save();
    }
    public function search_location($district,$vals)
    {
        $locations = Community::where('district_id',$district)->where('name', 'LIKE', '%'.$vals.'%')->get();
        $htmls = '';
        foreach($locations as $reg) {
            $htmls .= "<option class='region_list' value=".$reg->name.">";
        }
        echo $htmls;
    }
}
