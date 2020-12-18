<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Page extends Model
{

    /*
    * Getting Hot deals for home/inner pages
    * Return @array
    */

    protected function get_hot_deals(){
        $hotDeals = DB::table('vendor_promotions as VP')->select('VP.*','VE.username','VE.cat_id','VC.business_name','VC.business_name_slug','VC.province','VC.city',
            DB::raw('(select image from vendor_images where vendor_images.vendor_id = VP.vendor_id LIMIT 1) as image'),
            DB::raw('(select CASE WHEN CTT.slug IS NULL THEN CT.slug ELSE CONCAT(CTT.slug,"/",CT.slug) END as full_slug from categories AS CT left join categories as CTT ON CT.parent_id = CTT.id where CT.id = VE.cat_id) as full_slug'))
            ->orderBy(DB::raw('CAST(VP.promotion_amount AS SIGNED)'),'desc')
            ->leftJoin('vendors as VE','VP.vendor_id', '=' ,'VE.vendor_id')
            ->leftJoin('vendor_companies as VC','VE.vendor_id','=','VC.vendor_id')
            ->where('VP.status','=','1')
            ->whereNull('VP.offer_wedding')
            ->limit(4)->get()->toArray();
        $defNum = 0;
        foreach($hotDeals as $nm => $hv) {
            $catImgs = DB::table('categories_images')->select('images','description')->where('cat_id',$hv->cat_id)->get();
            if(count($catImgs) > 0) {
                $hotDeals[$nm]->cat_image = $catImgs[$defNum]->images;
                if(($defNum+1) == count($catImgs)) {
                    $defNum = 0;
                } else {
                    $defNum++;
                }
            } else {
                $hotDeals[$nm]->cat_image = 'no-photo.jpg';
            }
        }
        return $hotDeals;
    }

    protected function home_vendors(){
        $homeVendors = DB::table('vendors as VE')->select('VE.featured_image','VE.cat_id','VE.vendor_id','VE.username','VE.profile','VC.business_name','VC.business_name_slug','VC.province','VC.city','VC.business_detail',
            DB::raw('(select image from vendor_images where vendor_images.vendor_id = VE.vendor_id LIMIT 1) as image'),
            DB::raw('(select CASE WHEN CTT.slug IS NULL THEN CT.slug ELSE CONCAT(CTT.slug,"/",CT.slug) END as full_slug from categories AS CT left join categories as CTT ON CT.parent_id = CTT.id where CT.id = VE.cat_id) as full_slug'),
            DB::raw('(select title from categories CT1 where CT1.id = VE.cat_id) as cat'),DB::raw("(SELECT substring_index(GROUP_CONCAT(categories.title SEPARATOR ','), ',', 3) FROM categories JOIN vendor_category_relation ON categories.id = vendor_category_relation.category_id WHERE vendor_category_relation.vendor_id = VE.vendor_id LIMIT 1) AS category"))
            ->leftJoin('vendor_companies as VC','VE.vendor_id','=','VC.vendor_id')
            ->where('VE.status','=','1')
            ->where('VE.verified','=','1')
            ->where('VE.freelisting','=','No')
            ->where('VE.display_home_page','=','1')
            ->get()->toArray();
            // ->limit(8)
        $defNum = 0;
        foreach($homeVendors as $nm => $hv) {
            $catImgs = DB::table('categories_images')->select('images','description')->where('cat_id',$hv->cat_id)->get();
            if(count($catImgs) > 0) {
                $homeVendors[$nm]->cat_image = $catImgs[$defNum]->images;
                $homeVendors[$nm]->description = $catImgs[$defNum]->description;
                if(($defNum+1) == count($catImgs)) {
                    $defNum = 0;
                } else {
                    $defNum++;
                }
            } else 
                $homeVendors[$nm]->cat_image = 'no-photo.jpg';
        }
        return $homeVendors;
    }

    protected function top_locations(){
        $locations = DB::table('vendor_companies as VC')->select('province','city',DB::raw('count(city) as total_count'))
         ->orderBy('total_count','desc')->groupBy('VC.city')->limit(5)->get()->toArray();
        return $locations;
    }

    protected function get_wedding_stories(){
        $stories = DB::table('wedding_stories as VC')->get()->toArray();
        return $stories;
    }

}
