<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class CommunityGroup extends Model
{

	protected $table = 'community_groups';

	public $timestamps = true;

	public function joinedUsers()
    {
        return $this->hasMany('App\JoinCommunity', 'group_id');
    }
    public function userData() 
    {
    	return $this->belongsToMany('App\User', 'join_community_groups', 'group_id', 'user_id');
    }
    public function groupImages()
    {
        return $this->hasMany('App\CommunityImage', 'group_id');
    }
    public function groupVideos()
    {
        return $this->hasMany('App\CommunityVideo', 'group_id');
    }

}
