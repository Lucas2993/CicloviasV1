<?php

namespace App\Http\Controllers;

use Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\Centrality;
use App\Models\GeoPoint;

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

        $params_points = $request->all();
        $params_centrality = $request->all();

        unset($params_points['name']);
        unset($params_points['location']);
        unset($params_centrality['latitude']);
        unset($params_centrality['longitude']);

        $params_points['order'] = '-1';

        $centrality = Centrality::create($params_centrality);
        $point = GeoPoint::create($params_points);
        $centrality->geopoint()->save($point);
        $centrality->point = $centrality->geopoint()->get()[0];
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
        $centrality->point = $centrality->geopoint()->get()[0];
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
        $centrality->location = $request->input('location');
        $centrality->save();

        $point = $centrality->geopoint()->get()[0];

        $point->latitude = $request->input('latitude');
        $point->longitude = $request->input('longitude');

        $centrality->geopoint()->save($point);
        $centrality->point = $centrality->geopoint()->get()[0];
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
        $centrality->point = $centrality->geopoint()->get()[0];
        Centrality::destroy($id);
        return $centrality;
    }
}
