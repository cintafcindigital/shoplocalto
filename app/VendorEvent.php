<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorEvent extends Model
{
   //
    protected $guard = 'vendor';

     /**
     * The table associated with the model.
     *
     * @var string
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_id', 'event_spaces', 'min_price_per_guest', 'min_number_guest', 'max_number_guest','included_in_package','venue_location','note','status',
    ];

    public function vendor_data()
    {
        return $this->belongsTo('App\Vendor');
    }

}
