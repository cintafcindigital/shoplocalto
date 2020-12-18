<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use App\Vendor;
use App\User;
use App\Countries;
use App\UserBookedVendor;
use App\UserAddedVendor;
use App\ContactEnquiry;
use App\weddingWebsite;

class AdminUserController extends Controller
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
        $data['new_vendors'] = Vendor::whereDate('created_at', DB::raw('CURDATE()'))->count();
        View::share('slideBar',$data);
    }


     /*
    * -------------------------------------------------------------
    * Working On Vendor Module
    * -------------------------------------------------------------
    */
    protected function users(Request $request){
        $query = User::with(['noOfBookedVendors', 'noOfAddedVendors'=>function($q){
            $q->with(['vendorData','vendorCompanyData']);
        }])->orderBy('created_at', 'desc');
        if ($request->input('search') != null) {
            $query->where('name', 'like', '%'.$request->input('search').'%');
            $query->orWhere('email', 'like', '%'.$request->input('search').'%');
        }
        $users = $query->get();
        return view('admin/users/list', [
            'users' => $users
        ]);
    }   

    
    protected function status_user($id,$status)
    {
        $socialObj = User::find($id);
        $socialObj->status = $status;
        $data = $socialObj->save();
        if($data){
          return redirect()->back()->with('success', 'User status has been updated.');
        }else{
          return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

     protected function edit_user($id)
    {
        $dataVal = User::orderBy('created_at', 'asc')->where('id',$id)->first();
        $countryData = Countries::get()->toArray(); 
        if(isset($dataVal) && !empty($dataVal)){
            return view('admin/users/edit', [
                'data' => $dataVal->toArray(),
                'countries'=>$countryData
            ]);
        }else{
           return redirect('admin/users');
        }
    }

    protected function user_details($id){
        $userData = User::find($id);
        $bookedVendorData = UserBookedVendor::with(['vendor','vendorCompanyData'])->where('user_id',$id)->get();
        $addedVendorData = UserAddedVendor::with(['vendorData','vendorCompanyData'])->where('user_id',$id)->get();   
        $chatMessage = ContactEnquiry::with(['vendor_company'=>function($q){ $q->with(['vendor_data'=>function($p){$p->with('category_data');}]); }, 'replies'])->where('form_data',2)->where('user_id',$id)->orderBy('id','desc')->get();
        $weddingWebsite = weddingWebsite::where('user_id',$id)->get();
        if(isset($userData) && !empty($userData)){
            return view('admin/users/details', [
                'users' => $userData,
                'bookedVendorData' => $bookedVendorData,
                'addedVendorData' => $addedVendorData,
                'chatMessage' => $chatMessage,
                'weddingWebsite' => $weddingWebsite,
            ]);
        }else{
           return redirect('admin/users');
        }
        

    }
    
    protected function edit_user_save(Request $request){

        $this->validate($request, [
          'name' => 'required',
          ],['name.required' => ' Name field is required.',
        ]);
        
        $socialObj = User::find($request->input('user_id'));

        $userId = $request->input('user_id');

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/USER_'.$userId);

            $image->move($destinationPath, $name);

            $socialObj->profile_image = $name;
        }

        $socialObj->name = $request->input('name');
        $socialObj->phone = $request->input('phone');
        $socialObj->address = $request->input('address');
        $socialObj->event_role = $request->input('event_role');
        $socialObj->event_date = $request->input('event_date');
        $socialObj->country = $request->input('country');
        $data = $socialObj->save();
        if($data){
          return redirect()->back()->with('success', 'User has been updated.');
        }else{
          return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }

    }
}
