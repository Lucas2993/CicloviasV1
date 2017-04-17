<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        return $centralities;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $centrality = Centrality::create(Request::all());
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
    public function update( $id){
        $centrality = Centrality::find($id);
        $centrality->name = Request::input('name');
        $centrality->location = Request::input('location');
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
        Centrality::destroy($id);
    }
}
