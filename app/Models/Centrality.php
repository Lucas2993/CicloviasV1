<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\Point;

/**
*Crontoller creado por JLDEVIA el 14/04/2017.
*H.U: Capa de centralidades.
*/
class Centrality extends Model{

    use PostgisTrait;

    protected $table = 'centralities';

    /**
    * The attributes that are mass assignable.
    *
    */
    protected $fillable = [
        'name', 'location'
    ];

    protected $postgisFields = [
        'geom'
    ];

}
