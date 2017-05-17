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
}
