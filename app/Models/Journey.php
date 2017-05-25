<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\Point;

class Journey extends Model{

    use PostgisTrait;
    
    protected $table = 'journeys';

    protected $fillable = ['peso'];

    protected $postgisFields = ['geom'];

}
