<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class CommunityImage extends Model
{

	protected $table = 'community_images';

	public $timestamps = true;

	public function group() {
		return $this->belongsTo('App\CommunityGroup', 'group_id');
	}

	public function discussion() {
		return $this->belongsTo('App\CommunityDiscussion', 'discussion_id');
	}

	public function user() {
		return $this->belongsTo('App\User', 'user_id');
	}

}
