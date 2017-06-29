<?php

namespace App\Http\Controllers;

use Phaza\LaravelPostgis\Geometries\LineString;
use Phaza\LaravelPostgis\Geometries\Point;
use Phaza\LaravelPostgis\Geometries\Geometry;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Journey;
use App\Services\JourneyFunctions;

class JourneyController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $journeys = Journey::all();

        return $journeys;
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id){
        $journey = Journey::find($id);
        return $journey;
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $journey = Journey::find($id);
        $journey->peso = $request->input( ['peso']);
        $journey->save();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        Journey::destroy($id);
    }

    public function getJourneysByZone($zone_id){
        $query = "SELECT j.id as id
                FROM journeys j, zones z
                WHERE z.id = ".$zone_id."
                AND ST_Intersects(j.geom, z.geom) = 't'
                ORDER BY j.id ASC";

        $journeysZoneQuery= DB::raw($query);

        $resultQuery = DB::select($journeysZoneQuery);

        $journeysResults = array();
        foreach ($resultQuery as $single_result) {
            array_push($journeysResults, Journey::find($single_result->id));
        }

        echo(get_class($journeysResults[0]->geom));

        // return $journeysResults;
    }

    /**
      *Funcion encargada de retornar los Trayectos de Recorridos Similares
      *
      * @return \Illuminate\Http\Response
      */
      public function getSimilarTripsJourney($long1,$lat1,$long2,$lat2){
          return (new JourneyFunctions)->getSimilarTripsJourney($long1,$lat1,$long2,$lat2);

    }

}
