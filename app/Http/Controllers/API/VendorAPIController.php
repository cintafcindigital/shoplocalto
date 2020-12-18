<?php


namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\API\APIBaseController as APIBaseController;


use App\Page;
use App\Vendor;
use App\VendorImage;
use App\VendorCompany;
use App\VendorRating;

class VendorAPIController extends APIBaseController{  

	public function index()
    {    	
    	$Vendors = Vendor::with('company_data','promotion_data', 'question_data', 'category_data', 'image_data', 'rating_data');
        return $this->sendResponse($Vendors->get(), 'Vendors retrieved successfully.');      
    }
}