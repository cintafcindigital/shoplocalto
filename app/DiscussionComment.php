<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class DiscussionComment extends Model
{

	protected $table = 'discussion_comments';

	public $timestamps = true;

	public function comment_users() {
		return $this->belongsTo('App\User', 'user_id');
	}

	public function comment_images() {
		return $this->hasMany('App\CommunityImage', 'comment_id');
	}

	public function comment_videos() {
		return $this->hasMany('App\CommunityVideo', 'comment_id');
	}

}