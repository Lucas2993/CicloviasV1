<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
  *Crontoller creado por JLDEVIA el 14/04/2017.
  *H.U: Capa de centralidades.
*/
class GeoPoint extends Model
{
  protected $table = 'geo_points';

  protected $fillable = [
    'latitude', 'longitude'
  ];

  public function zones(){
      return $this->belongsToMany('App\Models\Zone');
  }
}
