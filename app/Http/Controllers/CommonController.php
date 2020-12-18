<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SocialSetting;
use View;

class CommonController extends Controller
{
   public function __construct()
   {
    //its just a dummy data object.
    $socials = SocialSetting::orderBy('created_at', 'asc')->where('status',1)->get();
    // Sharing is caring
    View::share('socials', $socials);
   }
}
