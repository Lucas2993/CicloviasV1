<?php

namespace App\Http\Controllers;

use Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Phaza\LaravelPostgis\Geometries\Point;

use App\Models\Centrality;

/**
  *Crontoller creado por JLDEVIA el 14/04/2017.
  *H.U: Capa de centralidades.
*/

class CentralityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $centralities = Centrality::all();
        // Se obtienen los puntos correspodientes.
        return $centralities;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $v = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'type' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'latitude' => 'required|numeric|min:-85|max:85',
                'longitude' => 'required|numeric|min:-180|max:180',
        ]);

        if ($v->fails()){
            $messages  = $v->errors()->getMessages();
            $errors = [];
            foreach ($messages as $message) {
                array_push($errors, $message);
            }
            // return ['errors' => $errors];
            return response()->json(['errors' => $errors], 400);

        }

        $params = $request->all();

        $centrality = new Centrality();
        $centrality->name = $params['name'];
        $centrality->type = $params['type'];
        $centrality->location = $params['location'];

        $point = new Point($params['latitude'], $params['longitude']);

        $centrality->geom = $point;
        $centrality->save();

        return $centrality;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $centrality = Centrality::find($id);
        return $centrality;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request){
        $v = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'type' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'latitude' => 'required|numeric|min:-85|max:85',
                'longitude' => 'required|numeric|min:-180|max:180',
        ]);

        if ($v->fails()){
            $messages  = $v->errors()->getMessages();
            $errors = [];
            foreach ($messages as $message) {
                array_push($errors, $message);
            }
            // return ['errors' => $errors];
            return response()->json(['errors' => $errors], 400);

        }

        $centrality = Centrality::find($id);

        $centrality->name = $request->input('name');
        $centrality->type = $request->input('type');
        $centrality->location = $request->input('location');
        $centrality->geom = new Point($request->input('latitude'), $request->input('longitude'));
        $centrality->save();

        return $centrality;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $centrality = Centrality::find($id);
        Centrality::destroy($id);
        return $centrality;
    }

    public function getTypesCentralities(){
        $query =   "SELECT distinct(c.type)
                    FROM centralities c";

        $typesCentralitiesQuery= DB::raw($query);

        $resultQuery = DB::select($typesCentralitiesQuery);

        $typesCentralitiesResults = array();
        foreach ($resultQuery as $single_result) {
            array_push($typesCentralitiesResults, $single_result);
        }
        // echo "cant de tipos de centralidad: ".count($typesCentralitiesResults);
        return $typesCentralitiesResults;
    }

    /*
    * Función destinada a la genereción de datos para el dashboard del sistema.
    * Devuelve la cantidades de centralidades por zona.
    */
    public function countCentralitiesByZone(){
      $query = 'select t1.id as id_zone, t1.name as zone, count(t2.id) as centralidades
                from zones t1 left join centralities t2 on ST_Contains(t1.geom::geometry, t2.geom::geometry)
                group by t1.id, t1.name';

      $result = DB::select($query);

      return $result;
    }

    /*
    * Función destinada a la genereción de datos para el dashboard del sistema.
    * Devuelve ranking de las diez primeras centralidades según la cantidad de recorridos que pasan a menos de 300 mts.
    */
    public function rankingCentralitiesByTrips(){
      $query = 'select t1.id as id_centrality, t1.name as centrality, count(t2.id) as cant_trips
                from centralities t1, trips t2
                where ST_DWithin(t1.geom, t2.geom, 300)
                group by t1.id, t1.name
                order by count(t2.id) desc
                limit 10';

      $result = DB::select($query);

      return $result;
    }
}//CentralityController
