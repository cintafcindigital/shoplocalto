<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorFaq extends Model
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
    protected $fillable = [];

    public function vendor_data()
    {
        return $this->belongsTo('App\Vendor');
    }

}
