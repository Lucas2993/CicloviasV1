<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Trip;
use App\Models\GeoPoint;
use App\Models\TripPoint;
use App\Models\Journey;
use App\Services\RankingTrips;
use App\Services\stdClass;
use Phaza\LaravelPostgis\Geometries\Point;
use Phaza\LaravelPostgis\Geometries\LineString;

class JourneyFunctions{

/**
*Funcion encargada de retornar los Trayectos de Recorridos Similares cercano a un punto de origen y destino.
* @param long1 longitud del primer punto
* @param lat1 latitud del primer punto
* @param long2 longitud del segundo punto
* @param lat2 latitud del segundo punto
* @return \Illuminate\Http\Response
*/
public function getSimilarTripsJourney($long1,$lat1,$long2,$lat2){

  //Llamo a la consulta que retorna Recorridos a puntos de inicio y fin
  $queryRecCerc = "SELECT t.id
                  FROM trips t
                  WHERE ST_DWithin(ST_StartPoint(t.geom::geometry)::geography,ST_SetSRID(St_MakePoint(".$long1.",".$lat1."),4326)::geography,250) AND
                      ST_DWithin(ST_EndPoint(t.geom::geometry)::geography,ST_SetSRID(St_MakePoint(".$long2.",".$lat2."),4326)::geography,250)";

  $RecCercQuery= DB::raw($queryRecCerc);

  $resultQueryRC= DB::select($RecCercQuery);

  //Obtengo los id separados.
  $pila= array();
  $longitud = count($resultQueryRC);

  for ($i=0;$i<$longitud;$i++){

    array_push($pila,$resultQueryRC[$i]->id);

  }

  //Verifico si no cumplen
  if(count($pila)==0){
    return \Response::json(['error' => 'No hay Recorridos que cumplan los requisitos'], 404);
  }
  //Verifico si es uno solo para retornar
  elseif (count($pila)==1) {
    //Tengo que hacer ponderación para retornar
    return $this->unicoRecorrido($pila[0]);
  }
  else{
    $results= array();
    $results=(new RankingTrips)->getTramosRanking($pila);
    return $results;
    }
}

/**
*Funcion encargada de realizar un trayeco unico si el recorrido es unico
* @param id longitud del primer punto
* @return \Illuminate\Http\Response
*/
public function unicoRecorrido($id){

  $Trip = Trip::find($id);
  $points= array();

  foreach ($Trip->geom as $point) {
        array_push($points, $point);
    }

  $Tramo = new \stdClass();
  $Tramo->id = 1;
  $Tramo->geom = new LineString($points);
  $Tramo->ranking = 10;
  $Tramo->frequency = 1;
  $Tramo->density = 1;

  return $Tramo;

}

}
