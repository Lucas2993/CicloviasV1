<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\Point;

/**
  *Crontoller creado por JLDEVIA el 14/04/2017.
  *H.U: Capa de centralidades.
*/
class GeoPoint extends Model{

  use PostgisTrait;
  
  protected $table = 'geo_points';

  protected $fillable = [
    'order'
  ];

  protected $postgisFields = [
        'geopoint'
    ];

  public function zones(){
      return $this->belongsToMany('App\Models\Zone');
  }

  public function trips(){
      return $this->belongsToMany('App\Models\Trip');
  }

  public function roads(){
      return $this->belongsToMany('App\Models\Road');
  }

  public function trippoint(){
    return $this->hasOne('App\Models\TripPoint');
  }
}
