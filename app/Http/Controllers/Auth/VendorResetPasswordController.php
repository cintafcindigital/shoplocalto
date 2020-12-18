<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use View;
use Illuminate\Foundation\Auth\ResetsPasswords;

//Auth Facade
use Illuminate\Support\Facades\Auth;

//Password Broker Facade
use Illuminate\Support\Facades\Password;

class VendorResetPasswordController extends Controller
{
    //Seller redirect path
    protected $redirectTo = '/dashboard';

    //trait for handling reset Password
    use ResetsPasswords;

    public function __construct()
    {
        $pageData = Page::select('id','url','title','image','image_description','description','meta_title','meta_description','meta_keyword')->where('id', 12)->first();
        View::share('pageData', $pageData);
    }

    //Show form to seller where they can save new password
    public function showResetForm(Request $request, $token = null)
    {
        return view('vendor.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    //returns Password broker of seller
    public function broker()
    {
        return Password::broker('vendors');
    }

    //returns authentication guard of seller
    protected function guard()
    {
        return Auth::guard('vendor');
    }

}