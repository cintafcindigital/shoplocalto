<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class WeddingdressDesigner extends Model
{
	protected $table = 'weddingdress_designer';
	public $timestamps = true;

	public function productData() {
	    return $this->hasMany('App\WeddingdressProduct', 'designer_id');
	}
}