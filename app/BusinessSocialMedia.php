<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class BusinessSocialMedia extends Model
{
	protected $table = 'business_social_media';

	public function social_data()
	{
        return $this->belongsTo('App\SocialMedia','social_media_id');
	}
}