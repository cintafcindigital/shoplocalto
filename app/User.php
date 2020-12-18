<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','address','city','province','country','phone','event_date','event_role','mail_allow','provider','provider_id'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function wishlists() {
        return $this->hasMany('App\Wishlist');
    }

    public function user_albums() {
        return $this->hasOne('App\UserAlbum');
    }

    public function user_booked_vendor() {
        return $this->hasMany('App\UserBookedVendor');
    }

    public function user_budgets() {
        return $this->hasMany('App\userBudget');
    }

    public function user_partners() {
        return $this->hasOne('App\UserPartners');
    }

    public function user_estimated_budget() {
        return $this->hasOne('App\userTotalEstimateBudget');
    }

    public function user_verify_codes() {
        return $this->hasOne('App\UserVerifyCode');
    }

    public function user_photos() {
        return $this->hasManyThrough('App\UserAlbumPhoto','App\UserAlbum','user_id','album_id','id','id');
    }

    /* Community Relationship */
    public function all_discussions() {
        return $this->hasMany('App\CommunityDiscussion');
    }

    public function all_comments() {
        return $this->hasMany('App\DiscussionComment');
    }

    public function all_videos() {
        return $this->hasMany('App\CommunityVideo');
    }

    public function all_images() {
        return $this->hasMany('App\CommunityImage');
    }

    public function wedding_websites() {
        return $this->hasOne('App\weddingWebsite');
    }

    public function noOfBookedVendors()
    {
        return $this->hasMany('App\UserBookedVendor','user_id');
    }

    public function noOfAddedVendors()
    {
        return $this->hasMany('App\UserAddedVendor','user_id');
    }
}