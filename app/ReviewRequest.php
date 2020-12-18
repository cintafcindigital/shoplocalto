<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class ReviewRequest extends Model
{
	protected $table = 'vendor_review_requets';
	public $timestamps = true;
}