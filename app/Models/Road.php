<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\Point;

class Road extends Model{

    use PostgisTrait;

    protected $table = 'roads';

    /**
    * The attributes that are mass assignable.
    *
    */

    protected $fillable = [
        'name'
    ];

    protected $postgisFields = [
        'geom'
    ];
}
