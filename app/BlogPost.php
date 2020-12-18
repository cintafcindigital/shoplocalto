<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
	protected $table = 'blog_posts';

	/*public function category()
	{
		return $this->belongsTo("App\BlogCategory","");
	}*/
	public function categories()
    {
        return $this->belongsTo('App\BlogCategory','blog_category_id','id');
    }
    public function user()
    {
        return $this->belongsTo('App\Admin','user_id');
    }
    public function vendor()
    {
        return $this->belongsTo('App\Vendor','vendor_id');
    }
}