<?php

namespace App\Http\Controllers;

use Phaza\LaravelPostgis\Geometries\LineString;
use Phaza\LaravelPostgis\Geometries\Point;
use Phaza\LaravelPostgis\Geometries\Geometry;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Road;

class RoadController extends Controller{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(){
        $roads = Road::all();
        return $roads;
    }

    public function create(){
            //
    }

    public function store(Request $request){
            //
    }

    public function show($id){
        $road = Road::find($id);
        return $road;
    }

    public function edit($id){
            //
    }

    public function update(Request $request, $id){
        $road = Road::find($id);
        // $road->peso = $request->input( ['peso']);
        $road->save();
    }

    public function destroy($id){
        Road::destroy($id);
    }

}
