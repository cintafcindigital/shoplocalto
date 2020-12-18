<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    
    public function parent() {
      return $this->belongsTo(static::class, 'parent_id');
   }

  public function children()
   {
     return $this->hasMany(static::class, 'parent_id');
  }
}