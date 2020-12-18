<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class WeddingideasPost extends Model
{

	protected $table = 'weddingideas_posts';

	public $timestamps = true;

	public function parentCategory() {
	    return $this->belongsTo('App\WeddingideasCategory', 'parent_cat_id');
	}

	public function subCategory() {
	    return $this->belongsTo('App\WeddingideasCategory', 'sub_cat_id');
	}

}

?>