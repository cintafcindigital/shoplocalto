<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoAnswerList extends Model
{
    //
    protected $fillable = ['user_id', 'list_id', 'title','description','note','todo_date_id','todo_cat_id','task_status','created_at','updated_at'];
}
