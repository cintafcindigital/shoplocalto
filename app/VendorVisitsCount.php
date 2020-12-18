<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class VendorVisitsCount extends Model
{
    protected $table = 'vendor_visits_count';

    public function vendor_data()
    {
        return $this->belongsTo('App\Vendor','vendor_id','vendor_id');
    }

    public function user_data()
    {
        return $this->belongsTo('App\User','user_id');
    }
}