<?php 


namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\APIBaseController as APIBaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Slider;
use App\Page;
use App\Testimonial;
use App\Vendor;
use App\Category;
use App\ContactEnquiry;
use App\UserNewsletter;
use App\VendorCompany;
use App\VendorRating;
use DB;
use Auth;
use App\Mail\RequestEnquirySent;
use Illuminate\Support\Facades\Mail;


class WebsiteAPIController extends APIBaseController { 


	// Display the Testimonial page and showing all testimonial.

	 	protected function website_testimonial() {

	         $page = Page::where('id', 2)->first();
	         $testimonials = Testimonial::orderBy('created_at', 'asc')->where('status',1)->get();
	         if($testimonials) {
	         	return $this->sendResponse(['pageData'=>$page,'testimonials'=>$testimonials], 'Get successfully.');
	         }else {
	         	return $this->sendError(false, 'Something went wrong please try again.', $code = 422);
	         }
	    }

	// Display Terms page 

	    protected function website_terms()	{
	    	$page = Page::where('id', 11)->first();
	    	if($page) {
	    		return $this->sendResponse(['pageData'=>$page], 'Get successfully.');
	    	}
	    	else {
	    		return $this->sendError(false, 'Something went wrong please try again.', $code = 422);
	    	}
	    }

	// Display contact Page

	    protected function website_contact() {
	    	$page = Page::where('id', 4)->first();
         	if($page) {
	    		return $this->sendResponse(['pageData'=>$page], 'Get successfully.');
	    	}
	    	else {
	    		return $this->sendError(false, 'Something went wrong please try again.', $code = 422);
	    	}
	    }

	// Save Newsletter Data in database

	    protected function website_save_newsletter(Request $request) {

	    	if (UserNewsletter::where('email_id', '=', $request->email)->exists()) {
	    		return $this->sendError(false, 'Whoops, Already exists.', $code = 422);
	    	}else {
		    	$newsObj = new UserNewsletter;
		        $this->validate($request, [
		             'email' => 'required|email',
		         ],['email.required'=>'Email address field is required.']);
		        $newsObj->email_id = $request->input('email');
		        $data = $newsObj->save();
		        if($data){
		            return $this->sendResponse(true, 'Newsletter has been created.');
		        }else{
		            return $this->sendError(false, 'Whoops, looks like something went wrong.', $code = 422);
		        }
		    }
	    }

	// Save website contact page enquiry form

	    protected function website_sendEnquiry(Request $request) {

	    	//dd($request->all());
	    	$contactObj = new ContactEnquiry;
	        $this->validate($request, [
	             'name' => 'required|string',
	             'email' => 'required|email',
	         ],['name.required'=>'Name field is required.',
	         'email.required'=>'Email address field is required.']);

	        if($request->user_id == 0){
                $contactObj->user_id = 0;
            }else {
                $contactObj->user_id = $request->user_id;
            }

	        $contactObj->name = $request->input('name');
	        $contactObj->email = $request->input('email');
	        $contactObj->reason = $request->input('reason');
	        $contactObj->phone = $request->input('phone');
	        $contactObj->comment = $request->input('comment');
	        $contactObj->form_data = 1;
	        $data = $contactObj->save();
	        if($data){
	          return $this->sendResponse(true, 'Enquiry has been sent successfully.');
	        }else{
	          return $this->sendError(false, 'Whoops, looks like something went wrong.', $code = 422);
	        }

	    }

	// Get all vendor by category

	    public function get_vendorBycategory($cat_id) {
	    	$Vendors = Vendor::with('company_data','promotion_data', 'question_data', 'category_data', 'image_data', 'rating_data')->where('cat_id', $cat_id);
        	return $this->sendResponse($Vendors->get(), 'Vendors retrieved successfully.');
	    }

}

?>