<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class ReviewReply extends Model
{
	protected $table = 'vendor_review_reply';
	public $timestamps = true;
}