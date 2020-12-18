<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ReplyTemplate extends Model
{

	protected $table = 'message_reply_templates';

	 public function reply_images() {
        return $this->hasMany('App\EnquiryReplyimage', 'template_id');
    }

	public $timestamps = true;


}
