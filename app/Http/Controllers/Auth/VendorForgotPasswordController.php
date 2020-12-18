<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use View;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

//Password Broker Facade
use Illuminate\Support\Facades\Password;

class VendorForgotPasswordController extends Controller
{
    //Sends Password Reset emails
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $pageData = Page::select('id','url','title','image','image_description','description','meta_title','meta_description','meta_keyword')->where('id', 12)->first();
        View::share('pageData', $pageData);
    }

    //Shows form to request password reset
    public function showLinkRequestForm()
    {
        return view('vendor.auth.passwords.email');
    }

    public function broker()
    {
         return Password::broker('vendors');
    }
}
