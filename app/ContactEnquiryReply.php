<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class ContactEnquiryReply extends Model
{
    
    protected $fillable = [
        'enquiry_id', 'user_id', 'name','email','company_id','reply_by','title','message','is_read'
    ];

    public function user() {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function reply_images() {
        return $this->hasMany('App\EnquiryReplyimage', 'enquiry_reply_id');
    }
    
    protected function update_as_read($userId){
       return  DB::table('contact_enquiry_replies')->where('user_id',$userId)->update(['is_read'=>'1']);
    }
    
    public function get_unread_inbox($userId){
       return  DB::table('contact_enquiry_replies')->where([['user_id'=>$userId],['is_read'=>'0']])->count();
    }
}
