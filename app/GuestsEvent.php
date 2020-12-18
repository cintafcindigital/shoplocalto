<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class GuestsEvent extends Model
{
	protected $table = "guests_events";

    public function guestsInvitationCount()
    {
    	return $this->hasMany('App\GuestsInvitationEvents', 'invited_for');
    }
}