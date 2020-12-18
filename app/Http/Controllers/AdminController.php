<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\EnquiryReply;
use App\Slider;
use App\Page;
use App\Admin;
use App\Subscription;
use App\Testimonial;
use App\Category;
use App\CategoryImages;
use App\CompanySetting;
use App\SocialSetting;
use App\VendorCompany;
use App\Vendor;
use App\User;
use App\Faq;
use App\ContactEnquiry;
use App\UserNewsletter;
use App\States;
use App\Countries;
use App\Signup;
use Excel;
use View;
use DB;
use File;
use Auth;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // die(Hash::make("ashiq123"));
        $this->middleware('auth:admin');
        $data['new_users'] = User::whereDate('created_at', DB::raw('CURDATE()'))->count();
        $data['new_vendors'] = Vendor::whereDate('created_at', DB::raw('CURDATE()'))->where('freelisting','No')->count();
        View::share('slideBar',$data);
    }

    /**
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fromDate = date('Y-m-01').' 00:00:00';
        $toDate = date('Y-m-d').' 23:59:59';
        $todayFrom = date('Y-m-d').' 00:00:00';
        $todayTo = date('Y-m-d').' 23:59:59';
        //// All Vendors Count......
        $data['totalVendors'] = Vendor::count();
        $data['activeVendors'] = Vendor::where('freelisting','No')->where('status',1)->count();
        $data['inactiveVendors'] = Vendor::where('freelisting','Yes')->count();
        //// Visitors by Province......
        $data['provinceVisits'] = DB::select(DB::raw("SELECT SUM(visits) as visits,province FROM vendor_companies WHERE visits > 0 group by province"));
        //// Couples by Province......
        $data['provinceCouples'] = DB::select(DB::raw("SELECT count(users.id) as visits,province FROM users WHERE status > 0 group by province"));
        //// All Visits by Date......
        // $data['totalVisits'] = DB::table("vendor_visits_count")->where('created_at','>=',$fromDate)->where('created_at','<=',$toDate)->sum('visits');
        // $data['todayVisits'] = DB::table("vendor_visits_count")->where('created_at','>=',$todayFrom)->where('created_at','<=',$todayTo)->sum('visits');
        $datetimeSave = date('Y-m-d H:i:s');
        $data['totalVisits'] = DB::select("SELECT COUNT(*) AS cnt FROM site_visitor WHERE DATE_FORMAT(created_at,'%Y-%m-%d') BETWEEN DATE_FORMAT(STR_TO_DATE('$datetimeSave','%Y-%m-%d %H:%i:%s'),'%Y-%m-%d') -  INTERVAL 1 MONTH AND DATE_FORMAT(STR_TO_DATE('$datetimeSave','%Y-%m-%d %H:%i:%s'),'%Y-%m-%d')")[0]->cnt;
        $data['todayVisits'] = DB::select("SELECT COUNT(*) AS cnt FROM site_visitor WHERE DATE_FORMAT(created_at,'%Y-%m-%d') = DATE_FORMAT(STR_TO_DATE('$datetimeSave','%Y-%m-%d %H:%i:%s'),'%Y-%m-%d')")[0]->cnt;
        $data['monthlySignup'] = DB::select("SELECT COUNT(*) AS cnt FROM vendors WHERE verified = 1 AND status = 1 AND DATE_FORMAT(created_at,'%Y-%m-%d') BETWEEN DATE_FORMAT(STR_TO_DATE('$datetimeSave','%Y-%m-%d %H:%i:%s'),'%Y-%m-%d') -  INTERVAL 1 MONTH AND DATE_FORMAT(STR_TO_DATE('$datetimeSave','%Y-%m-%d %H:%i:%s'),'%Y-%m-%d')")[0]->cnt;
        $data['todaySignup'] = DB::select("SELECT COUNT(*) AS cnt FROM vendors WHERE verified = 1 AND status = 1 AND DATE_FORMAT(created_at,'%Y-%m-%d') = DATE_FORMAT(STR_TO_DATE('$datetimeSave','%Y-%m-%d %H:%i:%s'),'%Y-%m-%d')")[0]->cnt;
        //// All Visits by Category......
        $data['recentVendors'] = DB::select("SELECT * FROM `vendors` JOIN vendor_companies ON vendor_companies.vendor_id = vendors.vendor_id WHERE verified = 1 AND status = 1 AND vendors.created_at IS NOT NULL ORDER BY vendors.created_at DESC LIMIT 4");
        $data['recentCommunityPosts'] = DB::select("SELECT * FROM `blog_posts` WHERE published = 1 AND approved = 1 AND vendor_id IS NOT NULL ORDER BY created_at DESC LIMIT 4");
        $data['catVisits'] = Category::with(['vendor_data'=>function($q){
                                $q->with(['company_data'=>function($qu){ $qu->where('visits','>',0); }]);
                            }])->get();
        
        $data['catVisits'] = DB::select("SELECT categories.id,categories.title,(SELECT COUNT(vendor_category_relation.vendor_id) FROM vendor_category_relation JOIN vendors ON vendor_category_relation.vendor_id = vendors.vendor_id AND vendors.status = 1 AND vendors.verified = 1  WHERE vendor_category_relation.category_id = categories.id) AS vendors FROM categories WHERE categories.status = 1 ORDER BY vendors DESC LIMIT 10");
        $data['topSearches'] = DB::select("SELECT COUNT(name) as cnt,name FROM `searches` GROUP BY name ORDER BY cnt DESC LIMIT 4");
        $data['vendorsHomePage'] = Vendor::select(DB::raw("*"),DB::raw("(CASE WHEN profile = '' OR profile IS NULL THEN (SELECT vendor_images.image FROM vendor_images WHERE vendor_images.vendor_id = vendors.vendor_id ORDER BY vendor_images.id ASC LIMIT 1) ELSE vendors.profile END) AS img"))->with('company_data')->where('display_home_page',1)->get();
        // dd($data['vendorsHomePage']);
        // print_r($data['catVisits']);
        // die;
        return view('admin.dashboard',['data'=>$data]);
    }
    
    public function getVendors(Request $request)
    {
        $searchTag = $request->term;
        $data = Vendor::select("vendors.vendor_id AS id","vendor_companies.business_name AS text")->join('vendor_companies','vendor_companies.vendor_id','=','vendors.vendor_id')->where('display_home_page',0)->where('status',1)->where('verified',1)->where('vendor_companies.business_name','LIKE','%'.$searchTag.'%')->orderBy('vendors.created_at','desc')->limit(10)->get()->toArray();
        return ["results" => $data];
    }
    
    public function setVendorHome(Request $request)
    {
        $this->validate($request,['vendor' => 'required|array|min:1']);
        $vendors = $request->vendor;
        foreach($vendors as $vend){
            $vendor = Vendor::find($vend);
            $vendor->display_home_page = 1;
            $vendor->save();
        }
        return redirect()->back()->with('success','<div class="alert alert-success">Successfully added home vendors to display !!</div>');
    }
    
    public function removeVendorHome($id)
    {
        // $this->validate($request,['vendor' => 'required|array|min:1']);
        // $vendors = $request->vendor;
        // foreach($vendors as $vend){
            $vendor = Vendor::find($id);
            $vendor->display_home_page = 0;
            $vendor->save();
        // }
        return redirect()->back()->with('success','<div class="alert alert-success">Successfully removed home vendors to display !!</div>');
    }

    /*
    * -------------------------------------------------------------
    * Working On Admin Setting Module
    * -------------------------------------------------------------
    */
    protected function admin_setting()
    {
        $admins = Admin::where('role',1)->orderBy('created_at', 'asc')->get();
        $company = CompanySetting::orderBy('created_at', 'asc')->get();
        $social = SocialSetting::orderBy('created_at', 'asc')->get();
        return view('admin/admin_settings/newlist', [
            'admins' => $admins,
            'company' => $company,
            'socialmedia' => $social
        ]);
    }

    protected function manage_admin()
    {
        $admins = Admin::where('role',1)->orderBy('created_at', 'asc')->get();
        return view('admin/admin_settings/list', [
            'admins' => $admins
        ]);
    }

    protected function edit_admin($id)
    {
        $admin = Admin::orderBy('created_at', 'asc')->where('id',$id)->first();
        $company = CompanySetting::orderBy('created_at', 'asc')->where('id',$id)->first();
        if(isset($admin) && !empty($admin)){
            return view('admin/admin_settings/edit', [
                'admin' => $admin->toArray(),
                'company' => $company->toArray(),
            ]);
        } else {
            return redirect('admin/manage-admin');
        }
    }

    protected function edit_admin_data(Request $request)
    {
        $this->validate($request, [
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                // 'password' => 'required|string|min:6|confirmed',
                'email' => 'required|string|email|max:255',
            ],[ 'firstname.required' => ' First name field is required.',
                'lastname.required' => ' Lasr name field is required.',
                // 'password.required' => ' The password field is required.',
        ]);
        $adminObj = Admin::find($request->input('admin_id'));
        $adminObj->name = $request->input('firstname').' '.$request->input('lastname');
        $adminObj->firstname = $request->input('firstname');
        $adminObj->lastname = $request->input('lastname');
        if($request->has('password') && !empty($request->input('password'))){
            $this->validate($request, [
                'password' => 'required|string|min:6|confirmed',
                ],[
                'password.required' => 'The password field is required.',
                    ]);
            $adminObj->password = Hash::make($request->input('password'));
        }
        $adminObj->email = $request->input('email');
        $data = $adminObj->save();
        if($data) {
            return redirect()->back()->with('success', 'Admin setting has been updated.');
        } else {
            return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    /*
    * -------------------------------------------------------------
    *   Working On Company Setting Module
    * -------------------------------------------------------------
    */
    protected function company_settings()
    {
        $company = CompanySetting::orderBy('created_at', 'asc')->get();
        return view('admin/company_settings/list', [
            'company' => $company
        ]);
    }

    protected function edit_company_settings($id)
    {
        $company = CompanySetting::orderBy('created_at', 'asc')->where('id',$id)->first();
        if(isset($company) && !empty($company)){
            return view('admin/company_settings/edit', [
                'company' => $company->toArray(),
            ]);
        } else {
            return redirect('admin/company-settings');
        }
    }

    protected function edit_company_settings_data(Request $request)
    {
        $this->validate($request, [
                'company_name' => 'required|string',
                'email_id' => 'required|string|email|max:255',
                'email_goes_to' => 'required|string|email|max:255',
                'phone_number' => 'required|string',
                'logo' => 'max:2048',
            ],['company_name.required' => ' The company name field is required.',
                'email_id.required' => ' The email id field is required.',
                'email_goes_to.required' => ' The email goes to id field is required.',
        ]);
        $companyObj = CompanySetting::find($request->input('company_id'));
        $companyObj->company_name = $request->input('company_name');
        $companyObj->email_id = $request->input('email_id');
        $companyObj->email_goes_to = $request->input('email_goes_to');
        $companyObj->phone_number = $request->input('phone_number');
        $companyObj->fax_number = $request->input('fax_number');
        $companyObj->toll_free_number = $request->input('toll_free_number');
        $companyObj->address = $request->input('address');
        if($request->file('logo') !== null){
            $image = $request->file('logo');
            $input['logo'] = 'Logo_'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['logo']);
            $companyObj->logo = $input['logo'];
        }
        $data = $companyObj->save();
        if($data){
            return redirect()->back()->with('success2', 'Company setting has been updated.');
        } else {
            return redirect()->back()->with('success2', 'Something went wrong. Please try again.');
        }
    }

    /*
    * -------------------------------------------------------------
    *   Working On Social Setting Module
    * -------------------------------------------------------------
    */
    protected function social_settings()
    {
        $dataVals = SocialSetting::orderBy('created_at', 'asc')->get();
        return view('admin/social_settings/list', [
            'data' => $dataVals
        ]);
    }

    protected function edit_social_settings($id)
    {
        $dataVal = SocialSetting::orderBy('created_at', 'asc')->where('id',$id)->first();
        if(isset($dataVal) && !empty($dataVal)){
            return view('admin/social_settings/edit', [
                'data' => $dataVal->toArray(),
            ]);
        } else {
           return redirect('admin/social-settings');
        }
    }

    protected function edit_social_settings_data(Request $request)
    {
        $this->validate($request, [
                'name' => 'required|string',
                'social_link' => 'required|string',
            ],['name.required' => ' The social media name field is required.',
                'social_link.required' => ' The social media link field is required.',
        ]);
        $socialObj = SocialSetting::find($request->input('social_id'));
        $socialObj->name = $request->input('name');
        $socialObj->social_link = $request->input('social_link');
        $data = $socialObj->save();
        if($data){
            return redirect()->back()->with('success', 'Social media has been updated.');
        } else {
            return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    protected function status_social_settings($id,$status)
    {
        $socialObj = SocialSetting::find($id);
        $socialObj->status = $status;
        $data = $socialObj->save();
        if($data){
            return redirect()->back()->with('success', 'Social media status has been updated.');
        } else {
            return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    /*
     * -------------------------------------------------------------
     * Working On Slider Module
     * -------------------------------------------------------------
     */
    protected function add_slider()
    {
        $sliders = Slider::orderBy('created_at', 'asc')->get();
        return view('admin/slider', [
            'sliders' => $sliders
        ]);
    }

    protected function save_slider(Request $request)
    {
        $sliderObj = new Slider;
        $this->validate($request, [
             'name' => 'required|string|max:255',
             'image' => 'required',
         ]);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $input['image'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/sliders');
            $image->move($destinationPath, $input['image']);
            $input['name'] = $request->input('name');
        }
        if(!empty($request->input('image')) && strlen($request->input('image')) > 6) {
            $featuredImage = $request->input('image');
            if(preg_match('/data:image/', $featuredImage)) {
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time().'_slider_'.rand(1000,9999) . '.png';
                $path = public_path() . '/sliders';
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path. '/' . $image_name, $featuredImage);
                $input['image'] = $image_name;
                $sliderObj->image = $input['image'];
            }
        }
        $sliderObj->name = $request->name;
        $sliderObj->status = 1;
        $sliderObj->save();
        //$this->postImage->add($input);
        return redirect()->back()->with('success', 'Slider Added Successfully.');
    }

    protected function delete_slider($id)
    {
        Slider::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Slider Deleted Successfully.');
    }

    /* -------------------------------------------------------------
     * Working On Subscription Module
     * -------------------------------------------------------------
     */
    protected function add_subscription()
    {
        $subscription = Subscription::orderBy('created_at', 'asc')->get();
        return view('admin/subscription/subscription', ['subscription' => $subscription]);
    }

    protected function save_subscription(Request $request)
    {
        $this->validate($request, [
            'type'      => 'required|string|max:155',
            'amount'    => 'required|numeric',
            'image'     => 'required',
            'feature_1' => 'required|string',
            'feature_2' => 'required|string',
            'feature_3' => 'required|string',
            'feature_4' => 'required|string',
            'feature_5' => 'required|string',
        ],[ 'type.required'      => 'Please mention subscription type',
            'amount.required'    => 'Please add subscription amount',
            'image.required'     => 'Please upload subscription image',
            'feature_1.required' => 'Please fill this feature',
            'feature_2.required' => 'Please fill this feature also',
            'feature_3.required' => 'Please fill this feature also',
            'feature_4.required' => 'Please fill this feature also',
            'feature_5.required' => 'Please fill this feature also']);
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/subscription'), $imageName);
        }
        if(!empty($request->input('image')) && strlen($request->input('image')) > 6) {
            $featuredImage = $request->input('image');
            if(preg_match('/data:image/', $featuredImage)) {
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time().'_subscription_'.rand(1000,9999) . '.png';
                $path = public_path() . '/subscription';
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path. '/' . $image_name, $featuredImage);
                $imageName = $image_name;
            }
        }
        $subsObj = new Subscription;
        $subsObj->type = $request->type;
        $subsObj->amount = $request->amount;
        $subsObj->duration = $request->duration;
        $subsObj->image = $imageName;
        $subsObj->feature_1 = $request->feature_1;
        $subsObj->feature1_favour = $request->feature1_favour;
        $subsObj->feature_2 = $request->feature_2;
        $subsObj->feature2_favour = $request->feature2_favour;
        $subsObj->feature_3 = $request->feature_3;
        $subsObj->feature3_favour = $request->feature3_favour;
        $subsObj->feature_4 = $request->feature_4;
        $subsObj->feature4_favour = $request->feature4_favour;
        $subsObj->feature_5 = $request->feature_5;
        $subsObj->feature5_favour = $request->feature5_favour;
        $subsObj->is_promocode = isset($request->is_promocode) ? ($request->is_promocode == null ? 0 : $request->is_promocode) : 0;
        $subsObj->save();
        return redirect()->back()->with('success', 'Subscription Added Successfully.');
    }

    public function edit_subscription($id)
    {
        $subs = Subscription::where('id',$id)->first();
        return view('admin/subscription/edit-subscription', ['subs' => $subs]);
    }

    protected function update_subscription(Request $request)
    {
        $this->validate($request, [
            'type'      => 'required|string|max:155',
            'amount'    => 'required|numeric',
            'feature_1' => 'required|string',
            'feature_2' => 'required|string',
            'feature_3' => 'required|string',
            'feature_4' => 'required|string',
            'feature_5' => 'required|string',
        ],[ 'type.required'      => 'Please mention subscription type',
            'amount.required'    => 'Please add subscription amount',
            'feature_1.required' => 'Please fill this feature',
            'feature_2.required' => 'Please fill this feature also',
            'feature_3.required' => 'Please fill this feature also',
            'feature_4.required' => 'Please fill this feature also',
            'feature_5.required' => 'Please fill this feature also'
        ]);
        $id = $request->upd_id;
        $subsObj = Subscription::find($id);
        if($request->hasFile('image')) {
            if($subsObj->image) {
                unlink('subscription/'.$subsObj->image);
            }
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/subscription'), $imageName);
        }
        $subsObj->type = $request->type;
        $subsObj->amount = $request->amount;
        $subsObj->duration = $request->duration;
        if($request->hasFile('image')) {
            $subsObj->image = $imageName;
        }
        if(!empty($request->input('image')) && strlen($request->input('image')) > 6) {
            $featuredImage = $request->input('image');
            if(preg_match('/data:image/', $featuredImage)) {
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time().'_subscription_'.rand(1000,9999) . '.png';
                $path = public_path() . '/subscription';
                @unlink(public_path() . '/subscription/'.@$subsObj->image);
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path. '/' . $image_name, $featuredImage);
                $imageName = $image_name;
                $subsObj->image = $imageName;
            }
        }
        $subsObj->feature_1 = $request->feature_1;
        $subsObj->feature1_favour = $request->feature1_favour;
        $subsObj->feature_2 = $request->feature_2;
        $subsObj->feature2_favour = $request->feature2_favour;
        $subsObj->feature_3 = $request->feature_3;
        $subsObj->feature3_favour = $request->feature3_favour;
        $subsObj->feature_4 = $request->feature_4;
        $subsObj->feature4_favour = $request->feature4_favour;
        $subsObj->feature_5 = $request->feature_5;
        $subsObj->feature5_favour = $request->feature5_favour;
        $subsObj->is_promocode = isset($request->is_promocode) ? ($request->is_promocode == null ? 0 : $request->is_promocode) : 0;
        $subsObj->save();
        return redirect()->back()->with('success', 'Subscription Updated Successfully.');
    }

    protected function delete_subscription($id)
    {
        $subsData = Subscription::findOrFail($id);
        if($subsData->image) {
            unlink('subscription/'.$subsData->image);
        }
        $subsData->delete();
        return redirect()->back()->with('success', 'Subscription Deleted Successfully.');
    }

    /*
    * -------------------------------------------------------------
    * Working On Page Module
    * -------------------------------------------------------------
    */
    protected function pages(Request $request)
    {
        $query = Page::orderBy('created_at', 'asc');
        if($request->input('search') != null) {
            $query->where('title', 'like', '%'.$request->input('search').'%');
            $query->orWhere('meta_title', 'like', '%'.$request->input('search').'%');
            $query->orWhere('meta_description', 'like', '%'.$request->input('search').'%');
            $query->orWhere('meta_keyword', 'like', '%'.$request->input('search').'%');
        }
        $pages = $query->get();
        return view('admin/page/list', [
            'pages' => $pages
        ]);
    }

    protected function add_page()
    {
        return view('admin/page/add');
    }

    protected function edit_page($id)
    {
        $dataVal = Page::orderBy('created_at', 'asc')->where('id',$id)->first();
        if(isset($dataVal) && !empty($dataVal)) {
            return view('admin/page/edit', [
                'data' => $dataVal->toArray(),
            ]);
        } else {
            return redirect('admin/pages');
        }
    }

    protected function delete_page($id)
    {
        $page = Page::find($id);
        if($page->delete())
            return redirect('admin/pages')->with('success', 'Page Deleted Successfully.');
        else
            return redirect('admin/pages')->with('error', 'Something went wrong. Please try again.');
    }

    protected function save_page(Request $request)
    {
        $pageObj = new Page;
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'string',
            'meta_title' => 'required|string',
            'meta_description' => 'required|string',
            'meta_keyword' => 'required|string',
            //'image' => 'required|image|max:2048',
        ],[
            'title.required' => 'Title field is required.',
            'description.required' => 'Description field is required.',
            'meta_title.required' => 'Meta Title field is required.',
            'meta_description.required' => 'Meta Description field is required.',
            'meta_keyword.required' => 'Meta Keywords field is required.',
          //  'image.required' => 'Banner image field is required.',
        ]);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $input['image'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/sliders');
            $image->move($destinationPath, $input['image']);
        }
        if(!empty($request->input('image')) && strlen($request->input('image')) > 6) {
            $featuredImage = $request->input('image');
            if(preg_match('/data:image/', $featuredImage)) {
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time().'_slider_'.rand(1000,9999) . '.png';
                $path = public_path() . '/sliders';
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path. '/' . $image_name, $featuredImage);
                $input['image'] = $image_name;
            }
        }
        $pageObj->url = str_slug($request->input('title'), '-');
        $pageObj->title = $request->input('title');
        $pageObj->description = $request->input('description');
        $pageObj->image_description = ($request->input('image_description')!=null)?$request->input('image_description'):'';
        $pageObj->meta_title = $request->input('meta_title');
        $pageObj->meta_description = $request->input('meta_description');
        $pageObj->meta_keyword = $request->input('meta_keyword');
        $pageObj->image = $input['image'];
        $pageObj->status = 1;
        $pageObj->save();
        return redirect('/admin/pages')->with('success', 'Page Added Successfully.');
    }

    protected function update_page(Request $request){
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'string',
            'meta_title' => 'required|string',
            'meta_description' => 'required|string',
            'meta_keyword' => 'required|string',
        ],[
            'title.required' => 'Title field is required.',
            'description.required' => 'Description field is required.',
            'meta_title.required' => 'Meta Title field is required.',
            'meta_description.required' => 'Meta Description field is required.',
            'meta_keyword.required' => 'Meta Keywords field is required.',
        ]);
        $pageobj = Page::find($request->input('page_id'));
        if($request->file('image') !== null) {
            $image = $request->file('image');
            $input['image'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/sliders');
            $image->move($destinationPath, $input['image']);
            $pageobj->image = $input['image'];
        }
        if(!empty($request->input('image')) && strlen($request->input('image')) > 6) {
            $featuredImage = $request->input('image');
            if(preg_match('/data:image/', $featuredImage)) {
                @unlink(public_path() . '/sliders/'.@$pageobj->image);
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time().'_slider_'.rand(1000,9999) . '.png';
                $path = public_path() . '/sliders';
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path. '/' . $image_name, $featuredImage);
                $pageobj->image = $image_name;
            }
        }
        $pageobj->url = str_slug($request->input('title'), '-');
        $pageobj->title = $request->input('title');
        $pageobj->description = $request->input('description');
        $pageobj->image_description = ($request->input('image_description') != null)?$request->input('image_description'):'';
        $pageobj->meta_title = $request->input('meta_title');
        $pageobj->meta_description = $request->input('meta_description');
        $pageobj->meta_keyword = $request->input('meta_keyword');
        $isSave = $pageobj->save();
        if($isSave) {
            return redirect('admin/pages')->with('success', 'Page Updated Successfully.');
        } else {
            return redirect('admin/pages')->with('success', 'Something went wrong. Please try again.');
        }
    }

    /*
    * -------------------------------------------------------------
    * Working On Testimonial Module
    * -------------------------------------------------------------
    */
    protected function testimonials()
    {
        $testimonials = Testimonial::orderBy('created_at', 'asc')->get();
        return view('admin/testimonial/list', [
            'testimonials' => $testimonials
        ]);
    }

    protected function add_testimonial(){
        return view('admin/testimonial/add');
    }

    protected function edit_testimonial($id)
    {
        $dataVal = Testimonial::orderBy('created_at', 'asc')->where('id',$id)->first();
        if(isset($dataVal) && !empty($dataVal)) {
            return view('admin/testimonial/edit', [
                'data' => $dataVal->toArray(),
            ]);
        } else {
            return redirect('admin/admin-testimonials');
        }
    }

    protected function save_testimonial(Request $request)
    {
        $tesObj = new Testimonial;
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required',
        ],['name.required'=>'Name field is required.','description.required'=>'Description field is required.','image.required'=>'Image field is required.',]);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $input['image'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/testimonials');
            $image->move($destinationPath, $input['image']);
        }
        if(!empty($request->input('image')) && strlen($request->input('image')) > 6) {
            $featuredImage = $request->input('image');
            if(preg_match('/data:image/', $featuredImage)) {
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time().'_testimonials_'.rand(1000,9999) . '.png';
                $path = public_path() . '/testimonials';
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path. '/' . $image_name, $featuredImage);
                $input['image'] = $image_name;
            }
        }
        $tesObj->name = $request->input('name');
        $tesObj->description = $request->input('description');
        $tesObj->image = $input['image'];
        $tesObj->status = 1;
        $tesObj->added_by = Auth::user()->name;
        $tesObj->save();
        return redirect('admin/admin-testimonials')->with('success', 'Testimonial Added Successfully.');
    }

    protected function save_changes_testimonial(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
        ],['name.required'=>'Name field is required.','description.required'=>'Description field is required.',]);
        $tesObj = Testimonial::find($request->input('tes_id'));
        if($request->file('image') !== null) {
            $image = $request->file('image');
            $input['image'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/testimonials');
            $image->move($destinationPath, $input['image']);
            $tesObj->image = $input['image'];
        }
        if(!empty($request->input('image')) && strlen($request->input('image')) > 6) {
            $featuredImage = $request->input('image');
            if(preg_match('/data:image/', $featuredImage)) {
                @unlink(public_path() . '/testimonials/'.@$tesObj->image);
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time().'_testimonials_'.rand(1000,9999) . '.png';
                $path = public_path() . '/testimonials';
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path. '/' . $image_name, $featuredImage);
                $input['image'] = $image_name;
                $tesObj->image = $input['image'];
            }
        }
        $tesObj->name = $request->input('name');
        $tesObj->description = $request->input('description');
        $isSave = $tesObj->save();
        if($isSave) {
            return redirect('admin/admin-testimonials')->with('success', 'Testimonial Updated Successfully.');
        } else {
            return redirect('admin/admin-testimonials')->with('success', 'Something went wrong. Please try again.');
        }
    }

    protected function delete_testimonial($id)
    {
        Testimonial::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Testimonial Deleted Successfully.');
    }

    protected function status_testimonial($id,$status)
    {
        $tstObj = Testimonial::find($id);
        $tstObj->status = $status;
        $data = $tstObj->save();
        if($data) {
            return redirect()->back()->with('success', 'Testimonial status has been updated.');
        } else {
            return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    /*
    * -------------------------------------------------------------
    * Working On Category Module
    * -------------------------------------------------------------
    */
    protected function categories(Request $request)
    {
        $query = Category::orderBy('created_at', 'asc');
        if ($request->input('search') != null) {
            $query->where('title', 'like', '%'.$request->input('search').'%');
            $query->orWhere('slug', 'like', '%'.$request->input('search').'%');
        }
        $cats = $query->get();
        return view('admin/category/list', [
            'cats' => $cats
        ]);
    }

    protected function add_category()
    {
        $cats = Category::where('is_parent', 1)->get()->toArray();
        return view('admin/category/add', ['cats' => $cats ]);
    }

    protected function save_category(Request $request)
    {
        // dd($request->all());
        $catObj = new Category;
        $this->validate($request, [
                'title' => 'required|string',
                'meta_title' => 'required|string',
                'meta_description' => 'required|string',
                'meta_keyword' => 'required|string',
                'description' => 'required|string',
                'categoryImage' => 'required',
                'categoryDescription' => 'required',
                // 'categoryImage.*' => 'image|max:2048',
                // 'categoryImage.*' => 'image',
                // 'icon' => 'required|image',
            ],['title.required'=>'Title field is required.',
                'meta_title.required' => 'Meta Title field is required.',
                'meta_description.required' => 'Meta Description field is required.',
                'meta_keyword.required' => 'Meta Keywords field is required.',
                // 'categoryImage.required' => 'Category Images is required.',
                'categoryDescription.required' => 'Category Description is required.',
                // 'icon.required' => 'Icon image is required.',
                'description.required' => 'Description field is required.',
        ]);
        // dd($request->all());
        $icon = $request->file('icon');
        if($icon != null){
            $imgName = time().'_icon_'.rand(1000,9999).'_'.$icon->getClientOriginalName();
            $icon->move(public_path('/images/category_icons/'),$imgName);
            $catObj->icon = $imgName;
        }
        if(!empty($request->input('icon')) && strlen($request->input('icon')) > 6) {
            $featuredImage = $request->input('icon');
            if(preg_match('/data:image/', $featuredImage)) {
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time().'_icon_'.rand(1000,9999) . '.png';
                $path = public_path() . '/images/category_icons';
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path. '/' . $image_name, $featuredImage);
                $catObj->icon = $image_name;
            }
        }
        $catObj->title = $request->input('title');
        $catObj->slug = str_slug($request->input('title'),'-');
        $catSlug = Category::where('slug',$catObj->slug)->count();
        if($catSlug > 0)
            $catObj->slug = $catObj->slug.'-'.$catSlug;
        $catObj->meta_title = $request->input('meta_title');
        $catObj->meta_description = $request->input('meta_description');
        $catObj->meta_keyword = $request->input('meta_keyword');
        $catObj->description = $request->input('description');
        $catObj->show_home = !empty($request->input('is_professionals'))?$request->input('is_professionals'):0;
        if($request->input('parent_id') != ''){
            $catObj->parent_id = $request->input('parent_id');
        }
        // if($request->input('is_parent') != ''){
        //     $catObj->is_parent = $request->input('is_parent');
        //     $checkParentIsProfession = Category::where('id',$catObj->is_parent)->first();
        //     $catObj->is_professionals = $checkParentIsProfession->is_professionals;
        // }
        $catObj->status = 1;
        $catObj->search_keywords = $request->input('search_keywords');
        $catObj->save();
        if($catObj->id) {
            if($files = $request->file('categoryImage')) {
                foreach($files as $nm => $file) {
                    $imgName = time().$nm.$file->getClientOriginalName();
                    $file->move(public_path('/images/category_images/'),$imgName);
                    $catImage = new CategoryImages;
                    $catImage->cat_id = $catObj->id;
                    $catImage->images = $imgName;
                    $catImage->description = $request->categoryDescription[$nm];
                    $catImage->save();
                }
            }
            if(!empty($request->input('categoryImage')) && strlen($request->input('categoryImage')) > 6) {
                $featuredImage = $request->input('categoryImage');
                if(preg_match('/data:image/', $featuredImage)) {
                    list($type, $featuredImage) = explode(';', $featuredImage);
                    list(, $featuredImage)      = explode(',', $featuredImage);
                    $featuredImage = base64_decode($featuredImage);
                    $image_name = time().'_'.rand(1000,9999).'_mhs_category' . '.png';
                    $path = public_path() . '/images/category_images';
                    if (!File::exists($path)){
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }
                    file_put_contents($path. '/' . $image_name, $featuredImage);
                    $catImage = new CategoryImages;
                    $catImage->cat_id = $catObj->id;
                    $catImage->images = $image_name;
                    $catImage->description = $request->categoryDescription;
                    $catImage->save();
                }
            }
        }
        return redirect('/admin/categories')->with('success', 'Category Added Successfully.');
    }

    protected function edit_category($id)
    {
        $cats = Category::where('is_parent', 1)->get()->toArray();
        $catData = Category::where('id', $id)->first()->toArray();
        $catImages = CategoryImages::where('cat_id', $id)->get();
        return view('admin/category/edit', ['cats' => $cats, 'cat_data' => $catData, 'catImages' => $catImages ]);
    }

    protected function delete_category($id)
    {
        $checkCategoryChilds = Category::where('parent_id',$id)->count();
        if($checkCategoryChilds > 0)
            return redirect()->back()->with('error',"This category have many childs !!");
        else{
            $category = Category::findOrFail($id);
            // dd($category);
            if($category->delete()){
                $status = true;
                $categoryImage = CategoryImages::where('cat_id',$id)->get();
                foreach ($categoryImage as $key => $value) {
                    @File::delete('images/category_images/'.$value->images);
                    $status = CategoryImages::findOrFail($value->id)->delete();
                }
                if($status)
                    return redirect()->back()->with('success','Category successfully deleted !!');
                else
                    return redirect()->back()->with('error','Something went wrong. Please try again later !!');
            }else
                return redirect()->back()->with('error','Something went wrong. Please try again later !!');

        }
    }

    protected function edit_category_data(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'meta_title' => 'required|string',
            'meta_description' => 'required|string',
            'meta_keyword' => 'required|string',
            'description' => 'required|string',
            ],['title.required'=>'Title field is required.',
            'meta_title.required' => 'Meta Title field is required.',
            'meta_description.required' => 'Meta Description field is required.',
            'meta_keyword.required' => 'Meta Keywords field is required.',
            'description.required' => 'Description field is required.',
        ]);
        $catObj = Category::find($request->input('cat_id'));
        $icon = $request->file('icon');
        if($icon != null){
            $imgName = time().'_icon_'.rand(1000,9999).'_'.$icon->getClientOriginalName();
            $icon->move(public_path('/images/category_icons/'),$imgName);
            $catObj->icon = $imgName;
        }
        if(!empty($request->input('icon')) && strlen($request->input('icon')) > 6) {
            $featuredImage = $request->input('icon');
            if(preg_match('/data:image/', $featuredImage)) {
                @unlink(public_path() . '/images/category_icons/'.@$catObj->icon);
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time().'_icon_'.rand(1000,9999) . '.png';
                $path = public_path() . '/images/category_icons';
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path. '/' . $image_name, $featuredImage);
                $catObj->icon = $image_name;
            }
        }
        $catObj->title = $request->input('title');
        $catObj->meta_title = $request->input('meta_title');
        $catObj->meta_description = $request->input('meta_description');
        $catObj->meta_keyword = $request->input('meta_keyword');
        $catObj->description = $request->input('description');
        $catObj->search_keywords = $request->input('search_keywords');
        $catObj->slug = str_slug($request->input('title'),'-');
        $catSlug = Category::where('slug',$catObj->slug)->count();
        if($catSlug > 0)
            $catObj->slug = $catObj->slug.'-'.$catSlug;
        $catObj->is_professionals = !empty($request->input('is_professionals'))?$request->input('is_professionals'):0;
        if($request->input('parent_id') != '') {
            $catObj->parent_id = $request->input('parent_id');
        } else {
            $catObj->parent_id = null;
        }
        if($request->input('is_parent') != '') {
            $catObj->is_parent = $request->input('is_parent');
            $checkParentIsProfession = Category::where('id',$catObj->is_parent)->first();
            $catObj->is_professionals = $checkParentIsProfession->is_professionals;
        } else {
            $catObj->is_parent = '0';
        }
        $data = $catObj->save();
        if($data) {
            $oldId = $request->input('old_id');
            /*if($oldId) {
                foreach($oldId as $onm => $old) {
                    $oldDataUpd = CategoryImages::find($oldId[$onm]);
                    $oldDataUpd->description = $request->old_categoryDescription[$onm];
                    $oldDataUpd->save();
                }
                $catImgData = CategoryImages::whereNotIn('id',$oldId)->where('cat_id',$request->input('cat_id'))->get();
                foreach($catImgData as $cid) {
                    unlink(public_path('/images/category_images/').$cid->images);
                    CategoryImages::where('id',$cid->id)->delete();
                }
            }
            if($files = $request->file('categoryImage')) {
                foreach($files as $nm => $file) {
                    $imgName = time().$nm.$file->getClientOriginalName();
                    $file->move(public_path('/images/category_images/'),$imgName);
                    $catImage = new CategoryImages;
                    $catImage->cat_id = $request->input('cat_id');
                    $catImage->images = $imgName;
                    $catImage->description = $request->categoryDescription[$nm];
                    $catImage->save();
                }
            }*/
            $catImage = CategoryImages::where('cat_id',$request->input('cat_id'))->first();
            $catImage = CategoryImages::find($catImage->id);
            $catImage->description = $request->categoryDescription;
            if(!empty($request->input('categoryImage')) && strlen($request->input('categoryImage')) > 6) {
                $featuredImage = $request->input('categoryImage');
                if(preg_match('/data:image/', $featuredImage)) {
                    @unlink(public_path() . '/images/category_images/'.@$catImage->images);
                    list($type, $featuredImage) = explode(';', $featuredImage);
                    list(, $featuredImage)      = explode(',', $featuredImage);
                    $featuredImage = base64_decode($featuredImage);
                    $image_name = time().'_icon_'.rand(1000,9999) . '.png';
                    $path = public_path() . '/images/category_images';
                    if (!File::exists($path)){
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }
                    file_put_contents($path. '/' . $image_name, $featuredImage);
                    $catImage->cat_id = $request->input('cat_id');
                    $catImage->images = $image_name;
                }
            }
            $catImage->save();
            return redirect()->back()->with('success', 'Category Updated Successfully.');
        } else {
            return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    protected function status_category($id,$status)
    {
        $faqObj = Category::find($id);
        $faqObj->status = $status;
        $data = $faqObj->save();
        if($data) {
            return redirect()->back()->with('success', 'Category status has been updated.');
        } else {
            return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    /*
    * -------------------------------------------------------------
    * Working On Faqs Module
    * -------------------------------------------------------------
    */
    protected function faqs(Request $request)
    {
        $query = Faq::orderBy('created_at', 'asc');
        if ($request->input('search') != null) {
            $query->where('question', 'like', '%'.$request->input('search').'%');
            $query->orWhere('answer', 'like', '%'.$request->input('search').'%');
        }
        $data = $query->get();
        return view('admin/faq/list', [
            'faqs' => $data
        ]);
    }

    protected function add_faq()
    {
        return view('admin/faq/add');
    }

    protected function edit_faq($id)
    {
        $faqData = Faq::where('id', $id)->first()->toArray();
        return view('admin/faq/edit', [
            'faq_data'=>$faqData,
        ]);
    }

    protected function save_faq(Request $request)
    {
         $faqObj = new Faq;
         $this->validate($request, [
            'question' => 'required|string',
            'answer' => 'required|string',
            ],['question.required'=>'Question field is required.','answer.required'=>'Answer field is required.']);
        $faqObj->question = $request->input('question');
        $faqObj->answer = $request->input('answer');
        $faqObj->status = 1;
        $data = $faqObj->save();
        if($data) {
            return redirect()->back()->with('success', 'FAQs Added Successfully.');
        } else {
            return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    protected function edit_faq_data(Request $request)
    {
        $this->validate($request, [
            'question' => 'required|string',
            'answer' => 'required|string',
            ],['question.required'=>'Question field is required.','answer.required'=>'Answer field is required.']);
        $faqObj = Faq::find($request->input('faq_id'));
        $faqObj->question = $request->input('question');
        $faqObj->answer = $request->input('answer');
        $data = $faqObj->save();
        if($data) {
            return redirect('admin/faqs')->with('success', 'FAQs Updated Successfully.');
        } else {
            return redirect('admin/faqs')->with('success', 'Something went wrong. Please try again.');
        }
    }

    protected function delete_faq($id)
    {
        Faq::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'FAQs Deleted Successfully.');
    }

    protected function status_faq($id,$status)
    {
        $faqObj = Faq::find($id);
        $faqObj->status = $status;
        $data = $faqObj->save();
        if($data) {
            return redirect()->back()->with('success', 'FAQs status has been updated.');
        } else {
            return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    /*
    * -------------------------------------------------------------
    * Working On Wedding Stories Module
    * -------------------------------------------------------------
    */
    protected function wedding_stories(Request $request)
    {
        $query = \App\WeddingStory::orderBy('created_at', 'asc');
        if ($request->input('search') != null) {
            $query->where('place', 'like', '%'.$request->input('search').'%');
            $query->orWhere('title', 'like', '%'.$request->input('search').'%');
            $query->orWhere('description', 'like', '%'.$request->input('search').'%');
        }
        $data = $query->get();
        return view('admin/wedding_stories/list', [
            'stories' => $data
        ]);
    }

    protected function add_wedding_stories()
    {
        return view('admin/wedding_stories/add');
    }

    protected function edit_wedding_stories($id)
    {
        $faqData = \App\WeddingStory::where('id', $id)->first()->toArray();
        return view('admin/wedding_stories/edit', [
            'story_data'=>$faqData,
        ]);
    }

    protected function edit_wedding_stories_data(Request $request)
    {
        $this->validate($request, [
                'title' => 'required|string',
                'description' => 'string',
                'image' => 'image|max:2048',
            ],[
                'title.required' => 'Title field is required.',
                'description.required' => 'Description field is required.',
        ]);
        $storyObj = \App\WeddingStory::find($request->input('story_id'));
        if($request->file('image') != null){
            $image = $request->file('image');
            $input['image'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/stories');
            $image->move($destinationPath, $input['image']);
            $storyObj->image = $input['image'];
        }
        $storyObj->title = $request->input('title');
        $storyObj->place = $request->input('place');
        $storyObj->description = $request->input('description');
        $data = $storyObj->save();
        if($data){
            return redirect('admin/wedding-stories')->with('success', 'Story Updated Successfully.');
        } else {
            return redirect('admin/wedding-stories')->with('success', 'Something went wrong. Please try again.');
        }
    }

    protected function save_wedding_stories(Request $request){
        $pageObj = new \App\WeddingStory;
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'string',
            'image' => 'required|image|max:2048',
        ],[
            'title.required' => 'Title field is required.',
            'description.required' => 'Description field is required.',
            'image.required' => 'Banner image field is required.',
        ]);
        $image = $request->file('image');
        $input['image'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/stories');
        $image->move($destinationPath, $input['image']);
        $pageObj->title = $request->input('title');
        $pageObj->place = $request->input('place');
        $pageObj->description = $request->input('description');
        $pageObj->image = $input['image'];
        $pageObj->save();
        return redirect('/admin/wedding-stories')->with('success', 'Story Added Successfully.');
    }

    protected function delete_wedding_stories($id)
    {
        \App\WeddingStory::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Story Deleted Successfully.');
    }

    protected function status_wedding_stories($id,$status)
    {
        $faqObj = \App\WeddingStory::find($id);
        $faqObj->status = $status;
        $data = $faqObj->save();
        if($data){
            return redirect()->back()->with('success', 'Story status has been updated.');
        } else {
            return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    /*
    * -------------------------------------------------------------
    * Working On Contact Enquiry Module
    * -------------------------------------------------------------
    */
    
    protected function signup_details($id)
    {
        $request = Signup::find($id) or abort(404);
        return view('admin/enquiry/signup_detail', compact('request'));
    }
    
    protected function signup_enquiry()
    {
        $requests = Signup::orderBy('created_at','desc')->where('archived',0)->where('vendor_id')->get();
        return view('admin/enquiry/signup_list', compact('requests'));
    }

    protected function listClaimEnquiry()
    {
        $requests = Signup::with(['vendor'])->orderBy('created_at','desc')->where('archived',0)->whereNotNull('vendor_id')->get();
        return view('admin/enquiry/signup_list', compact('requests'));
    }
    
    protected function signup_delete($id)
    {
        $signup = Signup::where('id',$id)->delete();
        return redirect('admin/signup-enquiry');
    }
    
    protected function signup_reply($id)
    {
        
        $enquiry = Signup::where('id', $id)->first();
        return view('admin/enquiry/reply', [
            'data' => $enquiry
        ]);
        
    }
    
    
    protected function request_enquiry()
    {
        $enquiry = DB::table('contact_enquiries as CE')
                   ->leftJoin('vendor_companies as VC','CE.company_id','=','VC.id')
                   ->select('CE.*','VC.business_name','VC.business_name_slug','VC.vendor_id')
                   ->where('CE.form_data',2)->orderBy('CE.id','desc')->get();
        return view('admin/enquiry/request_list', [
            'enquiries' => $enquiry
        ]);
    }

    protected function contact_enquiry()
    {
        $enquiry = ContactEnquiry::orderBy('id', 'desc')->where('form_data',1)->get();
        return view('admin/enquiry/list', [
            'enquiries' => $enquiry
        ]);
    }

    protected function reply_enquiry($id)
    {
        $enquiry = ContactEnquiry::where('id', $id)->first();
        return view('admin/enquiry/reply', [
            'data' => $enquiry
        ]);
    }

    protected function send_reply_message(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required',
        ],[ 'name.required'=>'Name field is required.',
            'email.required'=>'Email address field is required.',
            'message.required'=>'Message field is required.'
        ]);
        ///////////////////////////////////////
        $enquiry = ContactEnquiry::where('id', $request->input('id'))->get()->toArray();
        if(isset($enquiry[0]) && !empty($enquiry[0])) {
            $reObj = new \App\ContactEnquiryReply;
            $reObj->enquiry_id = $request->input('id');
            $reObj->user_id = $enquiry[0]['user_id'];
            $reObj->name = $request->input('name');
            $reObj->email = $request->input('email');
            $reObj->company_id = ($enquiry[0]['company_id'] != null)?$enquiry[0]['company_id']:0;
            $reObj->reply_by = 0;
            $reObj->message = $request->input('message');
            $reObj->save();
        }
        ///////////////////////////////////////
        try {
            Mail::to($request->input('email'))->send(new EnquiryReply($request->all()));
            if(Mail::failures()) {
                return redirect()->back()->with('success', 'Something went wrong please try again.');
            } else {
                $enObj = ContactEnquiry::find($request->input('id'));
                $enObj->reply_status = 1;
                $enObj->save();
                return redirect()->back()->with('success', 'Reply Message Sent Successfully.');
            }
        } catch (\Exception $e) {
                return redirect()->back()->with('success', 'Something went wrong please try again.');
        }
    }

    protected function delete_enquiry($id)
    {
        ContactEnquiry::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Enquiry Deleted Successfully.');
    }

    /*
    * -------------------------------------------------------------
    * Working On Contact Enquiry Module
    * -------------------------------------------------------------
    */
    protected function newsletter()
    {
        $emails = UserNewsletter::orderBy('created_at', 'asc')->get();
        return view('admin/newsletter/list', [
            'emails' => $emails
        ]);
    }

    protected function delete_newsletter($id)
    {
        UserNewsletter::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Email Address Deleted Successfully.');
    }

    protected function download_newsletter()
    {
        $currentDate = date('d_M_Y');
        Excel::create('Newsletters_'.$currentDate, function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {
                $newsLetterRecords = UserNewsletter::select('email_id')->get()->toArray();
                $sheet->setOrientation('landscape');
                $sheet->fromArray($newsLetterRecords);
            });
        })->export('xlsx');
    }

    protected function staff(Request $request)
    {
        $query = Admin::orderBy('created_at', 'desc');
        if ($request->input('search') != null) {
            $query->where('name', 'like', '%'.$request->input('search').'%');
            $query->orWhere('email', 'like', '%'.$request->input('search').'%');
        }
        $staff = $query->with(['get_parentAdmin'])->get();
        $states = States::where('status',1)->get();
        $countries = Countries::where('status',1)->get();
        return view('admin/staff/list', ['staff' => $staff,'states' => $states,'countries' => $countries]);
    }

    public function postStaff(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'contact' => 'required|numeric',
            'address' => 'required',
            'postal_code' => 'required',
            'profile' => 'required|max:2048',
        ],[ 'firstname.required'=>'<br/>First Name is required.',
            'lastname.required'=>'<br/>Last Name is required.',
            'email.required'=>'<br/>Email address is required.',
            'password.required'=>'<br/>Password field is required.',
            'profile.required'=>'<br/>Profile picture is required.',
            'contact.required'=>'<br/>Contact field is required.',
            'address.required'=>'<br/>Address field is required.',
            'postal_code.required'=>'<br/>ZIP / Postal Code is required.',
        ]);
        if($validation->passes()) {
            $image = $request->file('profile');
            $new_name = rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/staff_images'), $new_name);

            $staffs = new Admin;
            $staffs->name = $request->firstname.' '.$request->lastname;
            $staffs->firstname = $request->firstname;
            $staffs->lastname = $request->lastname;
            $staffs->email = $request->email;
            $staffs->password = Hash::make($request->password);
            $staffs->parent_id = $request->parent_id;
            $staffs->contact = $request->contact;
            $staffs->address = $request->address;
            $staffs->postal_code = $request->postal_code;
            $staffs->state = $request->state;
            $staffs->country = $request->country;
            $staffs->profile = $new_name;
            $staffs->role = $request->role;
            $staffs->save();
            return response()->json([
                'message'   => 'Staff member created Successfully',
                'class_name'  => 'alert-success'
            ]);
        } else {
            return response()->json([
                'message'   => $validation->errors()->all(),
                'class_name'  => 'alert-danger'
            ]);
        }
    }

    public function editStaff($id=null)
    {
        $editData = Admin::with(['get_parentAdmin'])->where('id',$id)->first();
        $staff = Admin::with(['get_parentAdmin'])->orderBy('created_at', 'desc')->get();
        $states = States::where('status',1)->get();
        $countries = Countries::where('status',1)->get();
        return view('admin/staff/edit', ['staff'=>$staff, 'editData'=>$editData, 'states'=>$states, 'countries'=>$countries]);
    }

    public function updateStaff(Request $request)
    {
        $id = $request->id;
        $validation = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:admins,email,'.$id,
            'contact' => 'required|numeric',
            'address' => 'required',
            'postal_code' => 'required',
        ],[ 'firstname.required'=>'<br/>First Name is required.',
            'lastname.required'=>'<br/>Last Name is required.',
            'email.required'=>'<br/>Email address is required.',
            'contact.required'=>'<br/>Contact field is required.',
            'address.required'=>'<br/>Address field is required.',
            'postal_code.required'=>'<br/>ZIP / Postal Code is required.',
        ]);
        if($validation->passes()) {
            if($request->has('profile')) {
                $image = $request->file('profile');
                $new_name = rand().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/staff_images'), $new_name);
            }
            $staffs = Admin::find($id);
            $staffs->name = $request->firstname.' '.$request->lastname;
            $staffs->firstname = $request->firstname;
            $staffs->lastname = $request->lastname;
            $staffs->email = $request->email;
            if($request->has('password')) {
                $staffs->password = Hash::make($request->password);
            }
            $staffs->parent_id = $request->parent_id;
            $staffs->contact = $request->contact;
            $staffs->address = $request->address;
            $staffs->postal_code = $request->postal_code;
            $staffs->state = $request->state;
            $staffs->country = $request->country;
            if($request->has('profile')) {
                $staffs->profile = $new_name;
            }
            if($request->has('role') && !empty($request->role))
                $staffs->role = $request->role;
            $staffs->save();
            if($staffs) {
                return redirect('admin/staff')->with('success', 'Staff Member has been updated.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong. Please try again.');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    protected function status_staff($id,$status)
    {
        $socialObj = Admin::find($id);
        if($socialObj->role != 1)
            $socialObj->status = $status;
        $data = $socialObj->save();
        if($data) {
            return redirect()->back()->with('success', 'Staff status has been updated.');
        } else {
            return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }
    
    public function delete_staff($id){
        $socialObj = Admin::where('id',$id)->first();
        if($socialObj->role != 1){
            $socialObj = Admin::find($id);
            $status = false;
            if($socialObj->role != 1)
                $status = $socialObj->delete();
            return $status ? redirect()->back()->with('success', 'Staff status has been deleted successfully !!') : redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
        else
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    }

    public function staff_details($id=null)
    {
        $staff = Admin::with(['get_parentAdmin','get_staffMember'])->where('id',$id)->first();
        if(isset($staff) && !empty($staff)){
            return view('admin/staff/details', ['staff' => $staff]);
        } else {
            return redirect('admin/staff');
        }
    }

}