<?php
namespace App\Http\Controllers;

use View;
use DB;
use Illuminate\Http\Request;
use App\PromoCode;
use App\Vendor;
use App\User;

class PromoCodeController extends Controller
{
	public function __construct()
    {
    	$this->middleware('auth:admin');
        $data['new_users'] = User::whereDate('created_at', DB::raw('CURDATE()'))->count();
        $data['new_vendors'] = Vendor::whereDate('created_at', DB::raw('CURDATE()'))->where('freelisting','No')->count();
        View::share('slideBar',$data);
    }
	public function promocodes()
	{
		$promocodes = PromoCode::with('vendor')->get();
		return view('admin.promocode.promocodes',['promocodes' => $promocodes]);
	}
	public function addCode()
	{
		return view('admin.promocode.add_promocode');
	}
	public function savePromocode(Request $request)
	{
		$this->validate($request, [
            'name' => 'required|string|unique:promocode'
        ],
        [
        	'name.required' => 'Code field is required !!',
        	'name.unique' => 'Your entered code is already exists !!'
        ]);
		$promocode = new PromoCode;
		$promocode->name = $request->name;
		if($promocode->save())
			return redirect('admin/promocodes')->with('success','Successfully generated promocode !!');
		else
			return redirect('admin/promocodes')->with('error','Something went wrong !!');
	}
}