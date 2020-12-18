<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class WeddingdressProduct extends Model
{
	protected $table = 'weddingdress_products';
	public $timestamps = true;

	public function imageData() {
	    return $this->hasMany('App\WeddingdressProductImages', 'product_id');
	}

	public function designerData() {
	    return $this->belongsTo('App\WeddingdressDesigner', 'designer_id');
	}

	public function collectionData() {
	    return $this->belongsTo('App\WeddingdressCollections', 'collection_id');
	}

	public function necklineData() {
	    return $this->belongsTo('App\WeddingdressTypes', 'neckline_type');
	}

	public function silhouetteData() {
	    return $this->belongsTo('App\WeddingdressTypes', 'silhouette_type');
	}
}