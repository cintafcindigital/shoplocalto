<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $table = 'locations';
    public function children()
   {
     return $this->hasMany('App\VendorCompany', 'location_id');
  }
}