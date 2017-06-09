<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//route to add
Route::get('/','AngularAppController@index');

/**
*Agregado por JLDEVIA el 14/04/2017.
*H.U: Capas de centralidades.
*/
Route::resource('api/centrality', 'CentralityController', ['except' => ['create', 'edit']]);

Route::resource('api/journey', 'JourneyController', ['except' => ['create', 'edit', 'store', 'update']]);

Route::resource('api/zone','ZoneController', ['except' => ['create', 'edit', 'store', 'update']]);

Route::get('api/trip/closeToPoint/{latitude}/{longitude}', 'TripController@getCloseToPoint');

Route::resource('api/trip','TripController', ['except' => ['create', 'edit', 'store', 'update']]);

Route::get('api/trip/toDistance/{longMin}/{longMax}', 'TripController@getToDistance');

Route::get('api/trip/generateTrips/{quantity}/{max_distance}', 'TripController@generateTrips');

Route::get('api/trip/closeToCentrality/{latitude}/{longitude}', 'TripController@getCloseToCentrality');

Route::get('api/trip/getTripsByZone/{zone_id}', 'TripController@getTipsByZone');
