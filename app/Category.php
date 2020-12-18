<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //////////////////// Get Category Details ///////////////////////
    protected function getCategory()
    {
        $parentCat = Category::select('id','title','slug','parent_id','is_parent',\DB::raw("(SELECT images FROM categories_images WHERE cat_id=categories.id LIMIT 1) AS image"))->where('status', 1)->where('is_parent',1)->get()->toArray();
        $dataCat = Category::select('id','title','slug','parent_id','is_parent',\DB::raw("(SELECT images FROM categories_images WHERE cat_id=categories.id LIMIT 1) AS image"))->where('status', 1)->where('is_parent','<>',1)->orderBy('title','asc')->get()->toArray();
        if(isset($parentCat) && !empty($parentCat)) {
            $catHandler = array();
            $j = 0;
            foreach($parentCat as $dcat) {
                $catHandler[$dcat['id']]['id'] = $dcat['id'];
                $catHandler[$dcat['id']]['title'] = $dcat['title'];
                $catHandler[$dcat['id']]['slug'] = $dcat['slug'];
                $catHandler[$dcat['id']]['image'] = $dcat['image'];
                foreach($dataCat as $ddcat) {
                    if($ddcat['parent_id'] == $dcat['id']) {
                        $catHandler[$dcat['id']]['child'][$j]['id'] = $ddcat['id'];
                        $catHandler[$dcat['id']]['child'][$j]['title'] = $ddcat['title'];
                        $catHandler[$dcat['id']]['child'][$j]['slug'] = $ddcat['slug'];
                        $catHandler[$dcat['id']]['child'][$j]['image'] = $ddcat['image'];
                        $j++;
                    }
                }
            }
            return $catHandler;
        }else{
            return array();
        }
    }

    protected function get_random_sub_cats()
    {
        $cats = Category::where('status',1)->where('is_parent','<>',1)->limit(10)->inRandomOrder();
        return $cats->get();
    }

    public function get_user_budget()
    {
        return $this->hasMany('App\userBudget', 'cat_id');
    }

    public function vendor_data()
    {
        return $this->hasMany('App\Vendor', 'cat_id', 'id');
    }

    protected function get_all_cateogires_with_count()
    {
        $parentCat = \DB::table('categories')
                        ->select('categories.id','categories.title','categories.slug','categories.parent_id','categories.is_parent',\DB::raw("(SELECT images FROM categories_images WHERE cat_id=categories.id LIMIT 1) AS image"))
                        ->leftJoin('vendor_category_relation',function($join){
                            $join->on('vendor_category_relation.category_id','=','categories.id')
                            ->groupBy('vendor_category_relation.category_id');
                        })->leftJoin('vendors',function($join){
                            $join->on('vendors.vendor_id','=','vendor_category_relation.vendor_id')
                        ->groupBy('vendor_id')
                                ->where('vendors.verified',1)
                                ->where('vendors.step_completed',4)
                                ->where('vendors.status',1);
                        })
                        ->where('categories.status', 1)
                        ->where('categories.is_parent',1)
                        ->groupBy('categories.id')
                        ->orderBy('categories.title','asc')
                        ->get()->toArray();
        $dataCat = \DB::table('categories')
                        ->select('categories.id','categories.title','categories.slug','categories.parent_id','categories.is_parent',\DB::raw("(SELECT images FROM categories_images WHERE cat_id=categories.id LIMIT 1) AS image"),\DB::raw("count(vendors.vendor_id) AS total"))
                        ->leftJoin('vendor_category_relation',function($join){
                            $join->on('vendor_category_relation.category_id','=','categories.id')
                            ->groupBy('vendor_category_relation.category_id');
                        })->leftJoin('vendors',function($join){
                            $join->on('vendors.vendor_id','=','vendor_category_relation.vendor_id')
                                ->where('vendors.verified',1)
                                ->where('vendors.step_completed',4)
                        ->groupBy('vendor_id')
                                ->where('vendors.status',1);
                        })
                        ->where('categories.status', 1)
                        ->where('categories.is_parent','<>',1)
                        ->groupBy('categories.id')
                        ->orderBy('categories.title','asc')
                        ->get()->toArray();
                        /*dd(\DB::table('categories')
                        ->select('categories.id','categories.title','categories.slug','categories.parent_id','categories.is_parent',\DB::raw("(SELECT images FROM categories_images WHERE cat_id=categories.id LIMIT 1) AS image"),\DB::raw("count(vendors.vendor_id) AS total"))
                        ->leftJoin('vendor_category_relation',function($join){
                            $join->on('vendor_category_relation.category_id','=','categories.id')
                            ->groupBy('vendor_category_relation.category_id');
                        })->leftJoin('vendors',function($join){
                            $join->on('vendors.vendor_id','=','vendor_category_relation.vendor_id')
                                ->where('vendors.verified',1)
                                ->where('vendors.step_completed',4)
                        ->groupBy('vendor_id')
                                ->where('vendors.status',1);
                        })
                        ->where('categories.status', 1)
                        ->where('categories.is_parent','<>',1)
                        ->groupBy('categories.id')
                        ->orderBy('categories.title','asc')->toSql());*/
        if(isset($parentCat) && !empty($parentCat)) {
            $catHandler = array();
            $j = 0;
            foreach($parentCat as $dcat) {
                $catHandler[$dcat->id]['id'] = $dcat->id;
                $catHandler[$dcat->id]['title'] = $dcat->title;
                $catHandler[$dcat->id]['slug'] = $dcat->slug;
                $catHandler[$dcat->id]['image'] = $dcat->image;
                // $catHandler[$dcat->id]['total'] = $dcat->total;
                foreach($dataCat as $ddcat) {
                    if($ddcat->parent_id == $dcat->id) {
                        $catHandler[$dcat->id]['child'][$j]['id'] = $ddcat->id;
                        $catHandler[$dcat->id]['child'][$j]['title'] = $ddcat->title;
                        $catHandler[$dcat->id]['child'][$j]['slug'] = $ddcat->slug;
                        $catHandler[$dcat->id]['child'][$j]['image'] = $ddcat->image;
                        $catHandler[$dcat->id]['child'][$j]['total'] = $ddcat->total;
                        $j++;
                    }
                }
            }
            return $catHandler;
        }else{
            return array();
        }
    }

    public function vendor_category_relation()
    {
        return $this->hasMany('App\VendorCategoryRelation');
    }
    
    public function vendor_category_relation2()
    {
        return $this->belongsToMany('App\Vendor', 'vendor_category_relation', 'category_id', 'id');
    }
    
    public function parent()
    {
        return $this->belongsTo('App\Category','parent_id');
    }

    public static function get_vendor_category($vendorId)
    {
        $parentCat = Category::select('categories.id','categories.title','categories.slug','categories.parent_id','categories.is_parent',\DB::raw("(SELECT images FROM categories_images WHERE cat_id=categories.id LIMIT 1) AS image"))->where('status', 1)->where('is_parent',1)->get()->toArray();
        $dataCat = \DB::table('categories')
                        ->select('categories.*',\DB::raw("(SELECT images FROM categories_images WHERE cat_id=categories.id LIMIT 1) AS image"),\DB::raw("(CASE WHEN vendor_category_relation.id IS NULL THEN 0 ELSE 1 END) AS checked"))
                        ->leftJoin("vendor_category_relation",function($join)use($vendorId){
                            $join->on('category_id','=','categories.id');
                            $join->where('vendor_category_relation.vendor_id','=',$vendorId);
                        })
                        ->where('status',1)
                        ->where('is_parent','<>',1)
                        ->get()->toArray();
        if(isset($parentCat) && !empty($parentCat)) {
            $catHandler = array();
            $j = 0;
            foreach($parentCat as $dcat) {
                $catHandler[$dcat['id']]['id'] = $dcat['id'];
                $catHandler[$dcat['id']]['title'] = $dcat['title'];
                $catHandler[$dcat['id']]['slug'] = $dcat['slug'];
                $catHandler[$dcat['id']]['image'] = $dcat['image'];
                foreach($dataCat as $ddcat) {
                    if($ddcat->parent_id == $dcat['id']) {
                        $catHandler[$dcat['id']]['child'][$j]['id'] = $ddcat->id;
                        $catHandler[$dcat['id']]['child'][$j]['title'] = $ddcat->title;
                        $catHandler[$dcat['id']]['child'][$j]['slug'] = $ddcat->slug;
                        $catHandler[$dcat['id']]['child'][$j]['image'] = $ddcat->image;
                        $catHandler[$dcat['id']]['child'][$j]['checked'] = $ddcat->checked;
                        $j++;
                    }
                }
            }
            return $catHandler;
        }else{
            return array();
        }
    }
}