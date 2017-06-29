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

Route::resource('api/trip','TripController', ['except' => ['create', 'edit', 'update']]);

Route::get('api/trip/toDistance/{longMin}/{longMax}', 'TripController@getToDistance');

Route::get('api/trip/generateTrips/{quantity}/{min_distance}/{max_distance}/{mode}', 'TripController@generateTrips');

Route::get('api/trip/closeToCentrality/{latitude}/{longitude}', 'TripController@getCloseToCentrality');

Route::get('api/journey/getJourneysByZone/{zone_id}', 'JourneyController@getJourneysByZone');

Route::get('api/trip/getTripsByZone/{zone_id}', 'TripController@getTripsByZone');

Route::get('api/trip/getTripsByOriginDestinationZone/{origin_zone_id}/{destination_zone_id}', 'TripController@getTripsByOriginDestinationZone');

Route::get('api/rankinged/{pondMin}/{pondMax}', 'TripsRankingedController@tramosRanking');

Route::get('api/dashboard/amountTrips', 'TripController@getAmountTrips');

Route::get('api/dashboard/rankingCentralitiesByTrips', 'CentralityController@rankingCentralitiesByTrips');

Route::get('api/dashboard/centralitiesByZone', 'CentralityController@countCentralitiesByZone');

Route::get('api/dashboard/tripsByLength', 'TripController@getTripsByLength');

Route::get('api/dashboard/rankingZoneCrossTrips', 'ZoneController@getRankingZoneCrossTrips');

Route::resource('api/road', 'RoadController',['except' => ['create', 'edit', 'store', 'update']]);

Route::get('api/journey/getSimilarTripsJourney/{$long1}/{$lat1}/{$long2}/{$lat2}', 'JourneyController@getSimilarTripsJourney');
