<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestsList extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name','attendance','menu','group_id','gender','age_type', 'email', 'phone', 'address', 'city' ,'country' ,'postal_code' , 'note','created_at','updated_at'
    ];

    public function tableSeat() {
    	return $this->hasOne('App\SeatArrangement', 'gust_id');
    }

     public function getGroup() {
        return $this->belongsTo('App\GuestsCategory', 'group_id');
    }
}
