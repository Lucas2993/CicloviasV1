<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
