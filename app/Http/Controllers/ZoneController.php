<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;

class ZoneController extends Controller{

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index() {
        $Zones = Zone::all();
        return $Zones;
    }

    // /**
    // * Store a newly created resource in storage.
    // *
    // * @return Response
    // */
    // public function store() {
    //     $Zone = Zone::create(Request::all());
    //     return $Zone;
    // }
    //
    // /**
    // * Update the specified resource in storage.
    // *
    // * @param  int  $id
    // * @return Response
    // */
    // public function update($id) {
    //     $Zone = Zone::find($id);
    //     $Zone->name = Request::input('name');
    //     $Zone->description = Request::input('description');
    //     $Zone->color = Request::input('color');
    //     $Zone->save();
    //
    //     return $Zone;
    // }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id) {
        $Zone = Zone::find($id);

        return $Zone;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id) {
        Zone::destroy($id);
    }

    /*Función destinada a la genereción de datos para el dashboard del sistema.
    * Devuelve el ranking de las 10 zonas con la mayor cantidad de recorridos que la atraviesan.
    */
    public function getRankingZoneCrossTrips(){
      $query = 'select t2.id as id_zone, t2.name as zone, count(t1.id) as cant_trips
                from trips t1, zones t2
                where ST_Intersects(t1.geom, t2.geom)
                group by t2.id, t2.name
                order by cant_trips desc
                limit 10';

      $result = DB::select($query);

      return $result;
    }
}
