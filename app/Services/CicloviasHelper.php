<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Trip;
use App\Models\GeoPoint;
use App\Models\TripPoint;

class CicloviasHelper {

  /**
  * Función que devuelve la distancia euclideana entre dos puntos georeferenciales.
  * @param $lat1: latitud del punto 1 - double
  * @param $long1: longitud del punto 1 - double
  * @param $lat2: latitud del punto 2 - double
  * @param $long2: longitud del punto 2- double
  * @return la distancia calculada (en kilómetros) entre los dos puntos.
  */

  // TODO Para corregir...
  public function calculateDistance ($lat1, $long1, $lat2, $long2){
    $degtorad = 0.01745329;
    $radtodeg = 57.29577951;

    $dlong = ($long1 - $long2);
    $dvalue = (sin($lat1 * $degtorad) * sin($lat2 * $degtorad))
			       + (cos($lat1 * $degtorad) * cos($lat2 * $degtorad)
			        * cos($dlong * $degtorad));

    $dd = acos($dvalue) * $radtodeg;

    //$miles = ($dd * 69.16);
    $km = ($dd * 111.302);

    return $km;
  }

  /**
  * Funcion que retorna el largo en kilometros de un Recorrido.
  *
  * @param $trip
  * @return int $km
  */
  public function tripDistance($trip){
    //saco el numero de elementos
    $longitud = count($trip);
    $km=0;
    //Recorro todos los elementos
    for($i=1; $i<$longitud; $i++){
      $j= $i - 1;
      //Calculo la distancia entre los puntos del recorrido
      $km += $this->CalculateDistance($trip[$j].'latitude', $trip[$j].'longitude', $trip[$i].'latitude', $trip[$i].'longitude');
      }

    return $km;
  }

  /**
  *Funcion que retorna los Recorridos que estan dentro de un rango de una determinada Distancia.
  *
  *@param int $long
  *@param int $tolerance
  *@param array $result
  */
  public function getToDistance($long,$tolerance){
    //Variables que determinan el rango de distancia en la que puede estar los Recorridos.
    $longMin= $long - ($tolerance * 0.001);
    $longMax= $long + ($tolerance * 0.001);

    $result = array();
    $Trips = Trip::all();

    $result = array();
    $Trips = Trip::all();

    foreach($Trips as $trip){
      $trip_points = $trip->geom;

      $kmt = $this->tripDistance($trip_points);
      $kmr = round($kmt, 2);

        if($kmr >= $longMin && $kmr <= $longMax){
          $result[] = $trip;

        }
    }

    return $result;
  }

  /**
  * Funcion que retorna el largo en kilometros de un Recorrido.
  *
  * @param $id
  * @return int $km
  */
  public function tripIdDistance($id){
    //Busco recorrido por id
    $Trip = Trip::find($id);

    $points = $Trip->geom;

    //saco el numero de elementos
    $longitud = count($points);
    $km=0;
    //Recorro todos los elementos
    for($i=1; $i<$longitud; $i++){
      $j= $i - 1;
      //Calculo la distancia entre los puntos del recorrido
      $km +=  $this->CalculateDistance($points[$j].'latitude', $points[$j].'longitude', $points[$i].'latitude', $points[$i].'longitude');
      }
    return $km;
  }

  /**
  * Función que devuelve el punto normalizado del punto representado por los valores (latitud y longitud)
  * pasados como parámetro.
  */
  public function normalizeGeoPoint($lat, $long){

    $qrySql = 'select punto, ST_Distance(ST_GeomFromText(t2.punto), ST_MakePoint('.$long.','.$lat.')) as distancia
    from (
    	SELECT ST_AsText((ST_DumpPoints(r.geom::geometry)).geom) as punto
    	FROM roads r
    	WHERE r.id in
    		(select t1.road
    		   from(
    			select r.id as road, ST_Distance(r.geom, ST_MakePoint('.$long.', '.$lat.')) as distance
    			from roads r
    			where ST_DWithin(r.geom, ST_MakePoint('.$long.', '.$lat.'), 150)) as t1
    		   order by t1.distance
    		   limit 4)
    		) as t2
    order by distancia ASC
    limit 1;';

    $result = DB::select(DB::raw($qrySql));
    
    return $result;

  }
}//fin de la clase
