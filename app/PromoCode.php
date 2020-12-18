<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $table = 'promocode';
    public function vendor()
    {
    	return $this->belongsTo('App\Vendor','vendor_id');
    }
}