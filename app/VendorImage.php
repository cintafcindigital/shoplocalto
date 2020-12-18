<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Vendor;

class VendorImage extends Model
{
    //
    protected $guard = 'vendor';

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vendor_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_id', 'vendor_folder', 'image', 'is_logo', 'status',
    ];

    public function vendor_data()
    {
        return $this->belongsTo(Vendor::class);
    }

}
