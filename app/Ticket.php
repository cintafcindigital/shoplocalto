<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
	protected $table = 'tickets';
    
    public function tickets_replies()
    {
    	return $this->hasMany('App\TicketReplies', 'tickets_id');
    }
}