<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class SeatingChart extends Model
{

	protected $table = 'seating_chart';

	public $timestamps = true;

	public function  seatdata() {
		return $this->hasMany('App\SeatArrangement', 'chart_table_id');
	}

	public function seatingList() {
       

        return $this->belongsToMany('App\GuestsList', 'App\SeatArrangement', 'chart_table_id', 'gust_id');
    }

}
