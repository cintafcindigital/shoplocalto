<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Vendor;
use App\VendorCompany;
use App\Category;
use DB;

class ReportsController extends Controller
{
    public function couples_report(Request $request)
    {
        $fromDate = date('Y-m-01');
        $toDate = date('Y-m-d');
        $name = $request->name;
        $category = $request->category;
        if($category == 'weekly') {
            $monday = strtotime("last monday");
            $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
            $sunday = strtotime(date("Y-m-d",$monday)." +6 days");
            $fromDate = date("Y-m-d",$monday);
            $toDate = date("Y-m-d",$sunday);
        } elseif($category == 'today') {
            $fromDate = $toDate = date('Y-m-d');
        }
        if($name != null && $name != '') {
            $query = User::with(['noOfBookedVendors', 'noOfAddedVendors'=>function($q){
                        $q->with(['vendorData','vendorCompanyData']);
                }])->whereBetween('event_date',[$fromDate,$toDate])->where(function($q) use($name){
                    $q->where('name', 'like', '%'.$name.'%');
                    $q->orWhere('email', 'like', '%'.$name.'%');
                })->orderBy('created_at', 'desc');
        } else {
            $query = User::with(['noOfBookedVendors', 'noOfAddedVendors'=>function($q){
                        $q->with(['vendorData','vendorCompanyData']);
            }])->whereBetween('event_date',[$fromDate,$toDate])->orderBy('created_at', 'desc');
        }
        $users = $query->get();
        return view('admin/reports/couples_report', ['users' => $users]);
    }

    public function vendors_report(Request $request)
    {
        $fromDate = date('Y-m-01 00:00:00');
        $toDate = date('Y-m-d 23:59:59');
        $name = $request->name;
        $category = $request->category;
        //  print_r($category);
        // die;
        if($category == 'weekly') {
            $monday = strtotime("last monday");
            $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
            $sunday = strtotime(date("Y-m-d",$monday)." +6 days");
            $fromDate = date("Y-m-d",$monday).' 00:00:00';
            $toDate = date("Y-m-d",$sunday).' 23:59:59';
        } elseif($category == 'today') {
            $fromDate = date('Y-m-d').' 00:00:00';
            $toDate = date('Y-m-d').' 23:59:59';
        }
        $catVendors = array();
        if($name != null && $name != '') {
            $compData = VendorCompany::leftJoin('vendors','vendor_companies.vendor_id','=','vendors.vendor_id')->select('vendor_companies.vendor_id')->where('vendors.username','like','%'.$name.'%')->orWhere('vendors.contact_person','like','%'.$name.'%')->orWhere('vendors.email','like','%'.$name.'%')->orWhere('vendor_companies.province','like','%'.$name.'%')->orWhere('vendor_companies.city','like','%'.$name.'%')->orWhere('vendor_companies.business_name','like','%'.$name.'%')->get();
            foreach($compData as $cp) {
                if(!in_array($cp->vendor_id, $catVendors)) {
                    array_push($catVendors,$cp->vendor_id);
                }
            }
            if(count($catVendors) > 0) {
                $query = Vendor::whereIn('vendor_id', $catVendors)->where('parent_vendor_id', 0)->where('status',1)->where('freelisting','No')->whereBetween('created_at',[$fromDate,$toDate])->orderBy('created_at', 'desc');
            } else {
                $query = Vendor::where('parent_vendor_id', 0)->where('status',1)->where('freelisting','No')->whereBetween('created_at',[$fromDate,$toDate])->orderBy('created_at', 'desc');
            }
        } else {
            $query = Vendor::where('parent_vendor_id', 0)->where('status',1)->where('freelisting','No')->whereBetween('created_at',[$fromDate,$toDate])->orderBy('created_at', 'desc');
        }
        $query->select('vendors.*',DB::raw("(select avg(average_rating) from vendor_ratings where status = 1 and vendor_id = vendors.vendor_id) as avg_rating"));
        $vendors = $query->with(['noOfCouples','category_data','image_data','company_data'])->get();
        $cat=DB::table('vendor_category_relation AS v')->select('c.title','c.id','v.vendor_id')->join('categories AS c','c.id','=','v.category_id')->get();
        // print_r($cat);
        // die;
        return view('admin/reports/vendors_report', ['vendors' => $vendors,'cate'=>$cat]);
    }

    public function sites_report(Request $request)
    {
        return view('admin/reports/sites_report');
    }
}