<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Centrality;
use App\Models\Trip;

/**
*
*/
class RankingTrips{

  public function rankingedTrips(){
    // obtenemos todos los recorridos de la base de datos
    // $tripsRecovered = new stdClass();

    $trips = Trip::all();

    return $trips;
  }

  public function rankingedTrips1(){

    $trips = DB::table('trips')
        ->select('trips.*')
        ->where('distance_km', '=', 1)
        ->get();

    echo'Paso la prueba 1';

    return $trips;
  }

  public function rankingedTripsQuery(){
    // $polygon = DB::connection('pgsql')
    // ->select(DB::raw("SELECT row_to_json(fc)
    //      FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
    //      FROM (SELECT 'Feature' As type
    //         , ST_AsGeoJSON(ST_Transform(geom,4326))::json As geometry
    //         , row_to_json((SELECT l FROM (SELECT areal) As l
    //           )) As properties
    //        FROM jbb2013 As lg, (SELECT geom from points where customer_id in (1,2,3) as pts WHERE ST_Intersects(lg.geom, pts.geom) As f )  As fc;")
    //     );

    $query = "SELECT ST_Length(geom) AS km_trips
              FROM trips
              WHERE id = 2";

    // distancia en metros
    $distanceQuery = DB::raw($query);

    $distancesRecovered = DB::select($distanceQuery);

    // Se convierte el tipo de array devuelto por la base de datos a un array convensional.
    $auxDistance = $distancesRecovered[0];

    echo "\n distancia rec 2 = ".$auxDistance->km_trips;

    return $auxDistance->km_trips;
  }

  public function rankingedTripsQuery2(){
    // traemos un cjto de recorridos para analizar
    $query = "SELECT *
              FROM trips
              WHERE id > 3";

    $preQuery = DB::raw($query);
    $setTrips = DB::select($preQuery);

    // Se convierte el tipo de array devuelto por la base de datos a un array convensional.
    $aux = array();
    foreach($setTrips as $trip){
        array_push($aux, $trip);
    }

    $aux1 = array();
    array_push($aux1, $setTrips[0]);

    echo "rdo aux1: ".count($aux1);

    return $aux;
  }

}
