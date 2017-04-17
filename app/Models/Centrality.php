<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
*Crontoller creado por JLDEVIA el 14/04/2017.
*H.U: Capa de centralidades.
*/
class Centrality extends Model
{
  protected $table = 'centralities';

  /**
 * The attributes that are mass assignable.
 *
 */
 protected $fillable = [
   'name', 'location', 'point'
 ];

  public function geopoint(){
    return $this->hasOne('App\Models\GeoPoint');
  }
}
