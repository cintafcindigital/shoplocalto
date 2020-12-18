<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserChangePassword;
use App\Page;
use App\Vendor;
use App\VendorDeal;
use App\VendorImage;
use App\VendorVideo;
use App\VendorFaq;
use App\ReviewRequest;
use DB;
use Hash;
use Auth;
use View;

class VemployeeController extends Controller
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
                            }])->first();
            ////// Vendor Progressive Bar Start from here......
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
     * Show the employees page.
     *
     * @return \Illuminate\Http\Response 
     */
	public function index()
    {
        $vendorId =  \Auth::user()->vendor_id;
       // $data['userData'] = \Auth::user();
        $data['companyData'] = \App\CompanySetting::where('id',1)->first();
        $data['vendorData'] = Vendor::with('company_data','image_data','category_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
		$data['titleData'] = \App\Page::where('id', 10)->first();
		//$data['vendorData'] = \Auth::user();
		$data['vendorEmployees'] = array();
		$data['vendorEmployees'] = Vendor::where('parent_vendor_id', '=', $vendorId)->get();
        return view('vendor.vendor_employees', ['data'=>$data]);
	}

    /*
    *   Add New Employee
    */
    public function add_employees(Request $request)
    {
        $this->validate($request, [
            'Eusername' => 'required',
            'Epassword' => 'required',
            'Ename' => 'required',
            'Email' => 'required',
        ],[ 'Eusername.required'=>'Username field is required.',
            'Epassword.required' => 'Password field is required',
            'Ename.required' => 'Name is required',
            'Email.required' => 'Email is required']);
        if($request->Epassword != $request->Econfirmpassword) {
            return \Redirect::back()->with('error','Password Do not Match');
        }
        if(!Vendor::where('username', $request->Eusername)->exists()) {
            $vendorId =  \Auth::user()->vendor_id;
            $employeesObj = new Vendor;
            $employeesObj->parent_vendor_id = $vendorId;
            $employeesObj->username = $request->Eusername;
            $employeesObj->contact_person = $request->Ename;
            $employeesObj->password = bcrypt($request->Epassword);
            $employeesObj->email = $request->Email;
            $employeesObj->role = $request->role;
            $employeesObj->save();
            if($employeesObj->vendor_id) {
                return \Redirect::back()->with('message','Employee Created Successfully.');
            } else {
                return \Redirect::back()->with('error','Somethings went worng.');
            }
        } else {
            return \Redirect::back()->with('error','Username is already Taken.');
        }
    }

	public function update_employees(Request $request)
    {
        $validation = $this->validate($request, [
            'vendor_name' => 'required',
            'vendor_email' => 'required',
        ],[ 'vendor_name.required'=>'Name field is required.',
            'vendor_email.required' => 'Email field is required']);
        if($request->vendor_password_new != $request->vendor_password_confirm) {
            return redirect()->back()->with('error', 'Do not match confirm password.');
        }
        $updateObj = Vendor::find($request->vendor_id);
        if(isset($request->vendor_password_old) && $request->vendor_password_old != NULL) {
            $vendorObj = Vendor::where('vendor_id', $request->vendor_id)->get();
            if (Hash::check($request->vendor_password_old, $vendorObj[0]->password)) {
                $updateObj->password = bcrypt($request->vendor_password_new);
                $updateObj->save();
            } else {
                return redirect()->back()->with('error', 'Please enter correct Old Password');
            }
        }
        $updateObj->contact_person = $request->vendor_name;
        $updateObj->email = $request->vendor_email;
        $updateObj->role = $request->vendor_role;
        $updateObj->save();
        if($updateObj->vendor_id) {
            return \Redirect::back()->with('message','Update Employee Details Successfully.');
        }
    }
}
?>