<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorsForTask extends Model
{
     protected $fillable = [
        'vendor_id', 'user_id', 'list_id',
    ];
}
