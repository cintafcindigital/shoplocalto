<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class VendorInvoice extends Model
{
	protected $table = 'vendor_invoices';

	public function subscription() {
		return $this->belongsTo('App\Subscription','subscription_id');
	}

	public function vendor_data() {
	    // return $this->belongsTo('App\Vendor','vendor_id','vendor_id');
		return $this->belongsTo('App\Vendor','vendor_id');
	}
	
	public function featured_profile() {
		return $this->belongsTo('App\FeaturedProfile','featured_profile_id');
	}

	public function vendor_bills() {
		return $this->hasMany('App\VendorBill','vendor_id','vendor_id');
		// return $this->belongsTo('App\VendorBill','vendor_id','vendor_id');
	}

    public function image_data()
    {
        return $this->hasMany('App\VendorImage','vendor_id','vendor_id')->orderBy('vendor_images.is_logo','asc');
    } 
}