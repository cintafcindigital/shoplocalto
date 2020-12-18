<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    public function getcategory() {
    	return $this->belongsTo("App\TodoListCategory", "todo_cat_id");
    }
}
