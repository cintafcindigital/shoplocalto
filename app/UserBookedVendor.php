<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBookedVendor extends Model
{
     protected $fillable = [
        'user_id', 'vendor_id', 'book_status','rating','price','add_note'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function vendor()
    {
        return $this->hasMany('App\Vendor','vendor_id','vendor_id');
    }

    public function vendorCompanyData()
    {
        return $this->hasMany('App\VendorCompany','vendor_id','vendor_id');
    }
}
