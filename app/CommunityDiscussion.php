<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class CommunityDiscussion extends Model
{

	protected $table = 'community_discussions';

	public $timestamps = true;

	public function images() {
		return $this->hasMany('App\CommunityImage', 'discussion_id');
	}

	public function videos() {
		return $this->hasMany('App\CommunityVideo', 'discussion_id');
	}

	public function userinfo() 
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function groupinfo() 
    {
    	return $this->belongsTo('App\CommunityGroup', 'group_id');
    }

     public function discussion_comment() 
    {
    	return $this->hasMany('App\DiscussionComment', 'discussion_id');
    }

     public function discussion_views() 
    {
        return $this->hasMany('App\DiscussionView', 'discussion_id');
    }

}
