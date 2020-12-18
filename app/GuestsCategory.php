<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class GuestsCategory extends Model
{
    public function Guestlist()
    {
        return $this->hasMany('App\GuestsList', 'group_id');
    }
    public function GuestlistNew()
    {
        return $this->hasMany('App\GuestsListNew', 'group_id');
    }

    public function groupCount()
    {
        return $this->hasMany('App\GuestsListNew', 'group_id');
    }
}