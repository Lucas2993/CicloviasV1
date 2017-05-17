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

Route::resource('api/journey', 'JourneyController', ['create', 'edit']);

Route::resource('api/zone','ZoneController', ['except' => ['create', 'edit']]);

Route::get('api/trip/closeToPoint/{latitude}/{longitude}', 'TripController@getCloseToPoint');

Route::resource('api/trip','TripController', ['except' => ['create', 'edit']]);

Route::get('api/trip/toDistance/{long}', 'TripController@getToDistance');
