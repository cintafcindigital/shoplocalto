<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorFeaturedProfile extends Model
{
    protected $table = 'vendor_featured_profiles';
    public function profiles()
    {
        return $this->belongsTo('App\FeaturedProfile','featured_profile_id');
    }
    public function vendor()
    {
        return $this->belongsTo('App\Vendor','vendor_id');
    }
}