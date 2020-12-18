<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class VendorCategoryRelation extends Model
{
	protected $table = 'vendor_category_relation';
	public function category_data()
	{
        return $this->belongsTo('App\Category','category_id');
	}
	public function vendor()
	{
        return $this->belongsTo('App\Vendor','vendor_id');
	}
	protected function get_category_by_vendor($vendor_id,$parent_id)
    {
    	$sql = \DB::table('categories')
    			->join("$this->table",'category_id','=','categories.id')
    			->select('categories.*')
    			->where('categories.status',1)
    			->where('categories.parent_id',$parent_id)
    			->where('vendor_id',$vendor_id);
    	return $sql->get();
    }
    public function getVendorCategory()
    {
        return $this->hasOne('App\Category','category_id');
    }
}