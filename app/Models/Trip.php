<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model{

  protected $table = 'trips';

  /**
 * The attributes that are mass assignable.
 *
 */
 protected $fillable = [
   'name', 'description', 'bicyclist', 'day_time', 'distance_km', 'points'
 ];

  public function geopoints(){
      return $this->belongsToMany('App\Models\GeoPoint');
  }

  public function trippoint(){
    return $this->hasOne('App\Models\TripPoint');
  }
}
