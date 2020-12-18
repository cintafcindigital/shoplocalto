<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class WeddingdressAddToFavourites extends Model
{
	protected $table = 'weddingdress_addtofavourites';
	public $timestamps = true;

	public function userData() {
	    return $this->belongsTo('App\User', 'user_id');
	}

	public function designerData() {
	    return $this->belongsTo('App\WeddingdressDesigner', 'designer_id');
	}

	public function productData() {
	    return $this->hasMany('App\WeddingdressProduct', 'dress_id');
	}
}