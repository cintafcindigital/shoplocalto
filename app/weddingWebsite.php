<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class weddingWebsite extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'website_link', 'banner_image','couple_name','title','description','background_color','note','wedding_date','created_at','updated_at'
    ];
}
