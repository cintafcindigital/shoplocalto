<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\weddingWebsite;
use App\UserAlbum;
use App\UserAlbumPhoto;
class WeddingWebsiteController extends Controller
{
      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = null)
    {
    	$weddingData = weddingWebsite::where('website_link',$slug)->get()->toArray();
    	$userId = $weddingData[0]['user_id'];
        $partnerData = \App\UserPartners::where('user_id',$userId)->get()->toArray();
    	if(isset($weddingData[0]) && !empty($weddingData[0])){
	     	return view('website.web',['websiteData'=>$weddingData[0],'partnerData'=>$partnerData]);
    	}else{
    		return redirect('web');
    	}
    	
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function album($slug = null)
    {
        $albumData = UserAlbum::where('album_link',$slug)->get()->toArray();
        $userId = \Auth::user()->id;
        if(isset($albumData[0]) && !empty($albumData[0])){
            $photos = UserAlbumPhoto::where('album_id',$albumData[0]['id'])->get()->toArray();
            /*echo"<pre>";
            print_r($photos);
            die;*/
            return view('website.album',['albumData'=>$albumData[0],'photos'=>$photos]);
        }else{
            return redirect('album');
        }
    }


}
