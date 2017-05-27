<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\Point;

class Zone extends Model{

    use PostgisTrait;

    protected $table = 'zones';

    protected $fillable = [
        'name', 'description', 'color'
    ];

    protected $postgisFields = [
        'geom'
    ];
}
