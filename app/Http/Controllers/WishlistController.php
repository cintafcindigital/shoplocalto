<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wishlist;
use App\VendorCompany;
use App\UserBookedVendor;
use Auth;

class WishlistController extends Controller
{

    public function __construct() {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
      $wishlists = Wishlist::where("user_id", "=", $user->id)->orderby('id', 'desc')->paginate(10);
      return view('frontend.wishlist', compact('user', 'wishlists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id'=>'required',
            'company_id' =>'required',
        ],['user_id.required'=>'User not found','company_id.required'=>'Item for whislist! Not Found.']);
        $status = Wishlist::where('user_id',Auth::user()->id)->where('company_id',$request->company_id)->first();
        if(isset($status->user_id) and isset($request->company_id)) {
            return response()->json(['error'=>false,'msg'=>'This item is already in your wishlist!']);
        } else {
            $wishlist = new Wishlist;
            $wishlist->user_id = $request->user_id;
            $wishlist->company_id = $request->company_id;
            $wishlist->save();
            //// Add Vendor to User dashboard......
            $companyDt = VendorCompany::where('id',$request->company_id)->first();
            $userId = \Auth::user()->id;
            $bookObj = UserBookedVendor::firstOrNew(array('user_id' => $userId,'vendor_id'=>$companyDt->vendor_id));
            $bookObj->user_id = $userId;
            $bookObj->vendor_id = $companyDt->vendor_id;
            $bookObj->book_status = 3;
            $data = $bookObj->save();

            return response()->json(['error'=>false,'msg'=>'Added to your wishlist.']);
        }
    }

    /**
     * Remove vendor/venues from wishlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        $this->validate($request, [
            'user_id'=>'required',
            'company_id' =>'required',
        ],['user_id.required'=>'User not found','company_id.required'=>'Item for whislist! Not Found.']);
        $wishlist = Wishlist::where([['company_id','=', $request->company_id],['user_id','=',$request->user_id]])->delete();
        //// Remove Vendor to User dashboard......
        $companyDt = VendorCompany::where('id',$request->company_id)->first();
        $userId = \Auth::user()->id;
        $bookObj = UserBookedVendor::where('user_id',$userId)->where('vendor_id',$companyDt->vendor_id)->first();
        UserBookedVendor::destroy($bookObj->id);

        return response()->json(['error'=>false,'msg'=>'Successfully remove from your wishlist.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();

        return redirect()->route('wishlist.index')
          ->with('flash_message',
           'Item successfully deleted');
    }
}
