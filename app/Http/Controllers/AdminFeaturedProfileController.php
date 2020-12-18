<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\FeaturedProfile;
use App\Vendor;
use App\Subscription;
use App\Category;
use App\ContactEnquiry;
use App\VendorFeaturedProfile;
use App\VendorCompany;

use DB;

class AdminFeaturedProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function listProfiles()
    {
        $profiles = FeaturedProfile::all();
        return view('admin.featured.list',['profiles' => $profiles]);
    }
    public function viewForm($id = null)
    {
        $profile = FeaturedProfile::find($id);
        return view('admin.featured.add',['profile' => $profile]);
    }
    public function saveRequest($id = null,Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|string|max:255',
            'amount'    => 'required|numeric|regex:/^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$/',
            // 'days' => 'required|int',
            'weeks' => 'required|regex:/^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$/'
        ]);
        if($id == null){
            $profile = new FeaturedProfile;
            $msg = "added";
        }
        else{
            $profile = FeaturedProfile::find($id);
            $msg = "updated";
        }
        $profile->name = $request->name;
        $profile->amount = $request->amount;
        // $profile->days = ((int) $request->weeks) * 7;
        $profile->weeks = $request->weeks;
        $profile->status = $request->status == 1;
        if($profile->save())
            return redirect('admin/featured-profiles')->with('success',"Successfully $msg featured profile !!");
        else
            return redirect()->back()->with('error',"Something went wrong. Please try again later !!");
    }
    public function getVendorProfiles(Request $request)
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
                $query = Vendor::whereIn('vendor_id', $catVendors)->where('parent_vendor_id', 0)->orderBy('created_at', 'desc');
            } else {
                $query = Vendor::where('parent_vendor_id', 0)->orderBy('created_at', 'desc');
            }
        } else {
            $query = Vendor::where('parent_vendor_id', 0)->orderBy('created_at', 'desc');
        }
        $query->select('vendors.*',DB::raw("(select avg(average_rating) from vendor_ratings where status = 1 and vendor_id = vendors.vendor_id) as avg_rating"),DB::raw("(SELECT GROUP_CONCAT(categories.title) FROM categories JOIN vendor_category_relation ON vendor_category_relation.category_id = categories.id WHERE vendor_category_relation.vendor_id = vendors.vendor_id) AS categories"));
        if($category != null && $category != '') {
            $query->join('vendor_category_relation','vendor_category_relation.vendor_id','=','vendors.vendor_id');
            $query->where('vendor_category_relation.category_id',$category);
        }
        $subscription = Subscription::get();
        $currentDate = date('Y-m-d');
        $query->where(DB::raw("EXISTS (SELECT vendor_featured_profiles.vendor_id FROM vendor_featured_profiles WHERE vendors.vendor_id AND '$currentDate' BETWEEN vendor_featured_profiles.start_date AND vendor_featured_profiles.due_date)"));
        $vendors = $query->with(['noOfCouples','image_data','company_data','profiles'])->paginate(20);
        // $vendors = Vendor::with('profiles')->withCount('profiles')->having('profiles_count','>',0);;
        // dd($vendors->toSql());
        // dd($vendors->paginate(20));
        $categories = Category::where('status', 1)->get();
        $enCount = ContactEnquiry::select('company_id',DB::raw('count(company_id) as enCount'))->where('form_data',2)->groupBy('company_id')->get()->toArray();
        return view('admin.featured.profiles',[
            'vendors' => $vendors,
            'categories' => $categories,
            'enCount' => $enCount,            
            'subscription'=>$subscription
        ]);
    }
    public function changeStatus($id,$status)
    {
        $profile = FeaturedProfile::find($id);
        $profile->status = $status;
        if($profile->save())
            return redirect()->back()->with('success',"Successfully changed status of featured profile !!");
        else
            return redirect()->back()->with('success',"Something went wrong. Please try again later !!");
    }
    public function deleteProfile($id)
    {
        $profile = FeaturedProfile::find($id);
        if($profile->delete())
            return redirect()->back()->with('success',"Successfully deleted featured profile !!");
        else
            return redirect()->back()->with('error',"Something went wrong. Please try again later !!");
    }
}