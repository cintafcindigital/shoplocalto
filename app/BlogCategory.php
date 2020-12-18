<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table = 'blog_categories';
    protected function getCategory()
    {
        $parent = \DB::table($this->table)->where("parent_id")->where('status',1)->get();
        $cats = [];
        foreach ($parent as $key => $value) {
            $cats[$value->id]['id'] = $value->id;
            $cats[$value->id]['name'] = $value->name;
            $child = \DB::table($this->table)->where("parent_id",$value->id)->where('status',1)->get();
            foreach ($child as $key2 => $value2) {
                $cats[$value->id]['child'][$key2]['id'] = $value2->id;
                $cats[$value->id]['child'][$key2]['name'] = $value2->name;
            }
        }
        return $cats;
    }
    public function posts()
    {
        return $this->belongsTo('App\BlogPost','id','blog_category_id');
    }
}