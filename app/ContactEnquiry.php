<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactEnquiry extends Model
{
   	public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

   	public function vendor_company() {
        return $this->belongsTo('App\VendorCompany', 'company_id');
    }

    public function replies() {
    	return $this->hasMany('App\ContactEnquiryReply', 'enquiry_id');
    }

    public function companyData() {
    	return $this->belongsTo('App\VendorCompany', 'company_id');
    }
}
