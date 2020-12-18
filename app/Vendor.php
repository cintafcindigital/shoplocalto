<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\VendorImage;
//Trait for sending notifications in laravel
use Illuminate\Notifications\Notifiable;
//Notification for Seller
use App\Notifications\VendorResetPasswordNotification;

class Vendor extends Authenticatable
{
    use Notifiable;
    protected $guard        = 'vendor';
    protected $table        = 'vendors';
    protected $primaryKey   = 'vendor_id';
    protected $appends      = ['mask_phone','mask_mobile'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'contact_person', 'email', 'telephone', 'mobile', 'fax' ,'website' ,'cat_id' , 'password',
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function company_data()
    {
        return $this->hasOne('App\VendorCompany','vendor_id');
    }

    public function social_details()
    {
        return $this->hasOne('App\VendorSocialMedia','vendor_id');
    }

    public function promotion_data()
    {
        return $this->hasOne('App\VendorPromotion','vendor_id');
    } 

    public function question_data()
    {
        return $this->hasMany('App\VendorQuestion','vendor_id');
    } 

    public function category_data()
    {
        return $this->hasOne('App\Category','id','cat_id');
    } 

    public function image_data()
    {
        return $this->hasMany('App\VendorImage','vendor_id')->orderBy('vendor_images.is_logo','asc');
    } 

    public function faqs()
    {
        return $this->hasMany('App\VendorFaq','vendor_id');
    }

    public function noOfCouples()
    {
        return $this->hasMany('App\UserBookedVendor','vendor_id');
    }

    public function location()
    {
        return $this->hasMany('App\VendorLocation','vendor_id');
    }

    public function videos()
    {
        return $this->hasMany('App\VendorVideo','vendor_id');
    }

    public function deals()
    {
        return $this->hasMany('App\VendorDeal','vendor_id');
    }

    public function rating_data()
    {
        $instance = $this->hasMany('App\VendorRating','vendor_id');
        $instance->where('vendor_ratings.status','=', 1);
        return $instance;
    }

    public function categories() 
    {
        return $this->belongsToMany('App\Category','vendor_category_relation','vendor_id','category_id');
    }
    
    public function profiles() 
    {
        return $this->belongsToMany('App\FeaturedProfile','vendor_featured_profiles','vendor_id','id');
    }

    public function vendor_categories()
    {
        return $this->hasMany('App\VendorCategoryRelation','vendor_id');
    }
    
    //////////////////// Vendor Full Data Backend ///////////////////////////
    protected function getAll($vendor_id)
    {
        $fullData['vendor_data'] = Vendor::where('vendor_id',$vendor_id)->first();
        if(isset($fullData['vendor_data']) && !empty($fullData['vendor_data'])) {
            $fullData['company_data'] = Vendor::find($vendor_id)->company_data()->first();
            $fullData['promotion_data'] = Vendor::find($vendor_id)->promotion_data()->first();
            $fullData['question_data'] = Vendor::find($vendor_id)->question_data()->first();
            $fullData['image_data'] = Vendor::find($vendor_id)->image_data()->get();
            $fullData['rating_data'] = Vendor::find($vendor_id)->rating_data()
            ->leftJoin('users', 'users.id', '=', 'vendor_ratings.user_id')
            ->select('vendor_ratings.*', 'users.name as user_name')->orderBy('id', 'DESC')->get();
            $fullData['categories'] = \DB::table('categories')->select('categories.*',\DB::raw('categories2.title AS parent_category'))->join('vendor_category_relation','categories.id','=','vendor_category_relation.category_id')->where('vendors.vendor_id',$vendor_id)->join('vendors','vendor_category_relation.vendor_id','=','vendors.vendor_id')->leftjoin(\DB::raw("categories AS categories2"),'categories.parent_id','=','categories2.id')->get()->toArray();
        }
        return $fullData;
    }

    ///////// Finding Avg Rating for Vendor Backend ////////////
    protected function getRating($vendor_id)
    {
        $data['avg_rating'] = Vendor::find($vendor_id)->rating_data()->get();
        return $data;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    //Send password reset notification
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new VendorResetPasswordNotification($token));
    }

    /**
     * Get all vendor register question according to category.
     *
     * @param  int  $vendor_id
     * @param  int  $cat_id
     * @return array
     */
    public function getAllQuestions($vendor_id,$cat_id)
    {
        $allQuestion = DB::table('assign_questions as AQ')
                      ->leftJoin('frequently_questions as FQ','AQ.question_id','=','FQ.id')
                      ->leftJoin('question_fields as QF','FQ.id','=','QF.question_id')
                      ->where('AQ.cat_id',$cat_id)
                      ->where('FQ.status',1)
                      ->get()->toArray();
        return $allQuestion;
    }

    public function getMaskPhoneAttribute()
    {
        $data = $this->attributes['telephone'];
        return preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $data);
    }
    public function getMaskMobileAttribute()
    {
        $data = $this->attributes['mobile'];
        return preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $data);
    }
}