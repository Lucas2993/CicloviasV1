<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;

/**
*Crontoller creado por JLDEVIA el 14/04/2017.
*H.U: Capa de centralidades.
*/
class Centrality extends Model
{
  protected $table = 'centralities';

  public function geoPoint(){
    return $this->hasOne('App\modelos\GeoPoint');
  }
}
