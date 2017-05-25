<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\Point;

class Trip extends Model{

    use PostgisTrait;

    protected $table = 'trips';

    protected $fillable = [
        'name', 'description', 'user', 'time', 'distance_km'
    ];

    protected $postgisFields = ['geom'];
}
