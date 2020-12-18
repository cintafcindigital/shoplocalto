<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoListDate extends Model
{
    public function getlist() {
    	return $this->hasMany("App\TodoList", "todo_date_id");
    }
}
