<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class ReviewTemplate extends Model
{
	protected $table = 'vendor_review_template';
	public $timestamps = true;
}