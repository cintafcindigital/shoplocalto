<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorCompany extends Model
{

     protected $guard = 'vendor';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_id', 'country', 'city', 'postal_code', 'address' ,'business_name' ,'business_detail' , 'business_address',
    ];

    public function vendor_data()
    {
        return $this->belongsTo('App\Vendor', 'vendor_id');
    }

    public function wishlists(){
        return $this->hasMany('App\Wishlist');
    }

}
