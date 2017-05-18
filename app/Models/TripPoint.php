<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripPoint extends Model{
    protected $table = 'trips_points';

    /**
   * The attributes that are mass assignable.
   *
   */
   protected $fillable = [
     'trip_id', 'geo_point_id', 'order'
   ];

}
