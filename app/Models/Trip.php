<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\Point;

class Trip extends Model{

    use PostgisTrait;

  /**
  * The attributes that are mass assignable.
  *
  */

  protected $table = 'trips';

  protected $fillable = [
        'name', 'description', 'user', 'time', 'distance_km', 'duration', 'frequency'
    ];

    protected $postgisFields = ['geom'];
}
