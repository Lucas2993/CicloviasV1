<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Trip;


class TripController extends Controller
{

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
  * @param  json $point
  * @return Response
  */
  public function getCloseToPoint($latitude, $longitude){
    $result = array();

    $lat = $latitude;
    $long = $longitude;

    echo($lat."\n");
    echo($long."\n");

    //Constantes utilizadas para acotar la busqueda de recorridos.
    $min_lat = $lat + 0.0035;
    $max_lat = $lat - 0.0035;
    $min_long = $long + 0.0046;
    $max_long = $long - 0.0046;

    /*
      TODO: Crear consulta para acotar la busqueda de recorridos cercanos al punto de interes.
    */

    $trips = Trip::with('geopoints')->get();

    foreach($trips as $trip){
      $points = $trip->geopoints()->get();
      foreach( $points as $point){
        $distancia = $this->CalculateDistance($lat, $long, $point->latitude, $point->longitude);
        if ($distancia <= 0.3) {
          $result[] = $trip;
          break;
        }
      }
    }
    return $result;
  }

  private function calculateDistance($lat1, $long1, $lat2, $long2){
    $degtorad = 0.01745329;
    $radtodeg = 57.29577951;

    $dlong = ($long1 - $long2);
    $dvalue = (sin($lat1 * $degtorad) * sin($lat2 * $degtorad))
			       + (cos($lat1 * $degtorad) * cos($lat2 * $degtorad)
			        * cos($dlong * $degtorad));

    $dd = acos($dvalue) * $radtodeg;

    $miles = ($dd * 69.16);
    $km = ($dd * 111.302);

    return $km;
  }
}
