<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userBudget extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'cat_id', 'concept','estimate_budget','final_cost','paid','pending','note','task_id','paid_date','paid_by','created_at','updated_at'
    ];
}
