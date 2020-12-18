<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorPromotion extends Model
{
    //

      public function vendor_data()
    {
        return $this->belongsTo('App\Vendor');
    }
}
