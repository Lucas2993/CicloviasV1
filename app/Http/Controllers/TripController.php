<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Trip;
use App\Services\CicloviasHelper;


class TripController extends Controller
{
  private $clvHelperService;

  //Se declara contructor para inyectar service "CicloviasHelper"
  function __construct (CicloviasHelper $helper){
    $this->clvHelperService = $helper;
  }

  /**
  * Display a listing of the resource.
  *
  * @return Response
  */
  public function index() {
      $Trips = Trip::all();
      // Se obtienen los puntos correspodientes.
      foreach($Trips as $trip){
          $trip->points = $trip->geopoints()->get();
      }
      return $Trips;
  }

  /**
  * Store a newly created resource in storage.
  *
  * @return Response
  */
  public function store() {
      $Trip = Trip::create(Request::all());
      return $Trip;
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  int  $id
  * @return Response
  */
  public function update($id) {
      $Trip = Trip::find($id);
      $Trip->name = Request::input('name');
      $Trip->description = Request::input('description');
      $Trip->save();

      return $Trip;
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  int  $id
  * @return Response
  */
  public function show($id) {
      $Trip = Trip::find($id);

      return $Trip;
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return Response
  */
  public function destroy($id) {
      Trip::destroy($id);
  }

  /**
  * Devuelve los recorridos cercanos al punto pasado como parámetro.
  *
  * @param  $point(latitude, longitude)
  * @return Response
  */
  public function getCloseToPoint($latitude, $longitude){
    $result = array();

    $lat = $latitude;
    $long = $longitude;

    //Constantes utilizadas para acotar la busqueda de recorridos.
    $min_lat = $lat + 0.0035;
    $max_lat = $lat - 0.0035;
    $min_long = $long + 0.0046;
    $max_long = $long - 0.0046;

    $trips = Trip::with(['geopoints' => function($query) use ($min_lat, $max_lat, $min_long, $max_long){
        $query->where('latitude', '>=', $max_lat)
              ->where('latitude', '<=', $min_lat)
              ->where('longitude', '>=', $max_long)
              ->where('longitude', '<=', $min_long);
    }])->get();

    foreach($trips as $trip){
      $points = $trip->geopoints()->get();
      foreach($points as $point){
        $distancia = $this->clvHelperService
                          ->CalculateDistance($lat, $long, $point->latitude,$point->longitude);
        if ($distancia <= 0.3) {
          $result[] = $trip;
          $trip->points = $trip->geopoints;
          unset($trip->geopoints);
          break;
        }
      }
    }
    return $result;
  }

/**
* Funcionalidad movida a la clase Services\CicloviasHelper.
*/
//   private function calculateDistance($lat1, $long1, $lat2, $long2){
//     $degtorad = 0.01745329;
//     $radtodeg = 57.29577951;
//
//     $dlong = ($long1 - $long2);
//     $dvalue = (sin($lat1 * $degtorad) * sin($lat2 * $degtorad))
// 			       + (cos($lat1 * $degtorad) * cos($lat2 * $degtorad)
// 			        * cos($dlong * $degtorad));
//
//     $dd = acos($dvalue) * $radtodeg;
//
//     $miles = ($dd * 69.16);
//     $km = ($dd * 111.302);
//
//     return $km;
//   }
//
// /**
// *Funcion que retorna los Recorridos que estan dentro de un rango de una determinada Distancia.
// *
// *@param int $long
// *@param array $result
// */
// public function getToDistance($long){
//   //Variables que determinan el rango de distancia en la que puede estar los Recorridos.
//   $longMin= $long - 0.05;
//   $longMax= $long + 0.05;
//
//   $result = array();
//   $Trips = Trip::all();
//
//   foreach($Trips as $trip){
//     $points = $trip->geopoints()->get();
//     $trip->points= $points;
//     $kmt = $this->tripDistance($points);
//     $kmr = round($kmt, 2);
//       if($kmr >= $longMin && $kmr <= $longMax){
//         $result[] = $trip;
//
//       }
//   }
//
//   return $result;
// }
//
//
//   /**
//   * Funcion que retorna el largo en kilometros de un Recorrido.
//   *
//   * @param $trip
//   * @return int $km
//   */
// public function tripDistance($trip){
//   //saco el numero de elementos
//   $longitud = count($trip);
//   $km=0;
//   //Recorro todos los elementos
//   for($i=1; $i<$longitud; $i++){
//     $j= $i - 1;
//     //Calculo la distancia entre los puntos del recorrido
//     $km += $this->CalculateDistance($trip[$j]->latitude, $trip[$j]->longitude, $trip[$i]->latitude, $trip[$i]->longitude);
//     }
//
//   return $km;
// }
//
// /**
// * Funcion que retorna el largo en kilometros de un Recorrido.
// *
// * @param $id
// * @return int $km
// */
// public function tripIdDistance($id){
// //Busco recorrido por id
// $Trip = Trip::find($id);
//
// $points = $Trip->geopoints()->get();
// //saco el numero de elementos
// $longitud = count($points);
// $km=0;
// //Recorro todos los elementos
// for($i=1; $i<$longitud; $i++){
//   $j= $i - 1;
//   //Calculo la distancia entre los puntos del recorrido
//   $km +=  $this->CalculateDistance($points[$j]->latitude, $points[$j]->longitude, $points[$i]->latitude, $points[$i]->longitude);
//   }
// return $km;
// }
}
