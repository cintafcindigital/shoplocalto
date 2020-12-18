<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class WeddingideasCategory extends Model
{
	protected $table = 'weddingideas_categories';
	public $timestamps = true;
	public function subCategories() {
	    return $this->hasMany('App\WeddingideasCategory', 'parent_id');
	}
}