<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class VendorBill extends Model
{
	protected $table = 'vendor_bills';

	public function carddata()  {
		return $this->belongsTo('App\PaymentMethod','card_id');
	}

	public function vendor()  {
		return $this->belongsTo('App\Vendor','vendor_id');
	}
}