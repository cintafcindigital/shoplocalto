<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class GuestsListNew extends Model
{
    protected $table = 'guests_lists_new';
    protected $fillable = [
        'user_id', 'related_id', 'firstname', 'lastname', 'age_type', 'gender', 'group_id', 'need_hotel', 'email', 'phone_no', 'mobile_no', 'address', 'city_town', 'country', 'postal_code', 'note', 'created_at', 'updated_at'
    ];

    public function guestsInvitation()
    {
    	return $this->hasMany('App\GuestsInvitationEvents', 'guest_id');
    }

    public function tableSeat()
    {
        return $this->hasOne('App\SeatArrangement', 'gust_id');
    }

    public function getGroup()
    {
        return $this->belongsTo('App\GuestsCategory', 'group_id');
    }
}