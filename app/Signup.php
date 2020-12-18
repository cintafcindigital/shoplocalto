<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Signup extends Model
{
    protected $table = 'signup_requests';
    public function vendor()
	{
        return $this->belongsTo('App\Vendor','vendor_id');
	}
}