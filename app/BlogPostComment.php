<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPostComment extends Model
{
	protected $table = 'blog_post_comment';
    public function vendor()
    {
        return $this->belongsTo('App\Vendor','vendor_id','vendor_id');
    }
    public function blog()
    {
        return $this->belongsTo('App\BlogPost','blog_post_id','id');
    }
}