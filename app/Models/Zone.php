<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model{

  protected $table = 'zones';

  /**
 * The attributes that are mass assignable.
 *
 */
 protected $fillable = [
   'name', 'description', 'color', 'points'
 ];

  public function geopoints(){
      return $this->belongsToMany('App\Models\GeoPoint');
  }
}
