<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class UserAddedVendor extends Model
{
	protected $table = 'user_added_vendors';


	public function vendorData()
    {
        return $this->hasMany('App\Vendor','vendor_id','vendor_id');
    } 

    public function vendorCompanyData()
    {
        return $this->hasMany('App\VendorCompany','vendor_id','vendor_id');
    } 
}
