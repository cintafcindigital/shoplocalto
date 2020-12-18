<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
	protected static function get_social_media_id($slug)
	{
		$sql = SocialMedia::where('slug',$slug)->first();
		return $sql->id;
	}
	public function business_social_data()
	{
        return $this->belongsTo('App\BusinessSocialMedia','social_media_id');
	}
}