<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoListCategory extends Model
{
    public function get_maincategory() {
    	return $this->belongsTo('App\Category', 'cat_id');
    }
}
