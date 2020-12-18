<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPartners extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'user_id','name', 'gender','avatar',"partner_name",'partner_gender','partner_avatar','wedding_date','venue','created_at','updated_at'
    ];
}
