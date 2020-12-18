<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class TicketReplies extends Model
{
	protected $table = 'tickets_replies';
    
    public function tickets()
    {
    	return $this->belongsTo('App\Ticket', 'tickets_id', 'id');
    }
}