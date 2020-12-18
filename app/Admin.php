<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

	 protected $guard = 'admin';
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function get_parentAdmin()
    {
        return $this->hasOne('App\Admin', 'id', 'parent_id');
    }

    public function get_staffMember()
    {
        return $this->hasMany('App\Admin', 'parent_id', 'id');
    }
}
