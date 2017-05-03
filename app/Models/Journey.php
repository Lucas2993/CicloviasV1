<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journey extends Model
{
  protected $table = 'journeys';

  protected $fillable = ['peso'];

  public function points(){
    return $this->belongsToMany('App\Models\GeoPoint');
  }

}
