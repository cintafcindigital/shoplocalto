<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class WeddingdressTypes extends Model
{
	protected $table = 'weddingdress_types';
	public $timestamps = true;

	public function neckProductData() {
	    return $this->hasMany('App\WeddingdressProduct', 'neckline_type');
	}

	public function silhProductData() {
	    return $this->hasMany('App\WeddingdressProduct', 'silhouette_type');
	}
}