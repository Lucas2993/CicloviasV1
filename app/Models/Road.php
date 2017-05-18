<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Road extends Model{
    protected $table = 'roads';

    /**
    * The attributes that are mass assignable.
    *
    */
    protected $fillable = [
        'name', 'points'
    ];

    public function geopoints(){
        return $this->belongsToMany('App\Models\GeoPoint');
    }
}
