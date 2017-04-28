<?php

use Illuminate\Database\Seeder;
use App\Models\Trip;
use App\Models\GeoPoint;


class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //----------Recorrido N°1 ---------------
      $punto1 = GeoPoint::create(['latitude'=>'-42.785076', 'longitude'=>'-65.005561','order' => '1']);
      $punto2 = GeoPoint::create(['latitude'=>'-42.781499', 'longitude'=>'-65.017525','order' => '2']);
      $punto3 = GeoPoint::create(['latitude'=>'-42.783389', 'longitude'=>'-65.023125','order' => '3']);

      $trip1 = Trip::create([
          'name'=>'Recorrido 1',
          'description'=>'Vemos si llegamos a la casa de Demian'
      ]);
      $trip1->geopoints()->save($punto1);
      $trip1->geopoints()->save($punto2);
      $trip1->geopoints()->save($punto3);

      //----------Recorrido N°2 ---------------

      $punto4 = GeoPoint::create(['latitude'=>'-42.765440', 'longitude'=>'-65.042246','order' => '1']);
      $punto5 = GeoPoint::create(['latitude'=>'-42.766695', 'longitude'=>'-65.040116','order' => '2']);
      $punto6 = GeoPoint::create(['latitude'=>'-42.765135', 'longitude'=>'-65.035529','order' => '3']);
      $punto7 = GeoPoint::create(['latitude'=>'-42.767117', 'longitude'=>'-65.034334','order' => '4']);
      $punto8 = GeoPoint::create(['latitude'=>'-42.766791', 'longitude'=>'-65.0422839','order' => '5']);

      $trip2 = Trip::create([
          'name'=>'Recorrido 2',
          'description'=>'Vemos si llegamos a la Galesa'
      ]);
      $trip2->geopoints()->save($punto4);
      $trip2->geopoints()->save($punto5);
      $trip2->geopoints()->save($punto6);
      $trip2->geopoints()->save($punto7);
      $trip2->geopoints()->save($punto8);

      //----------Recorrido N°3 ---------------

      $punto9 = GeoPoint::create(['latitude'=>'-42.771438', 'longitude'=>'-65.036437','order' => '1']);
      $punto10 = GeoPoint::create(['latitude'=>'-42.769603', 'longitude'=>'-65.031114','order' => '2']);
      $punto11 = GeoPoint::create(['latitude'=>'-42.766754', 'longitude'=>'-65.026641','order' => '3']);
      $punto12 = GeoPoint::create(['latitude'=>'-42.775887', 'longitude'=>'-65.024195','order' => '4']);
      $punto13 = GeoPoint::create(['latitude'=>'-42.774946', 'longitude'=>'-65.025466','order' => '5']);

      $trip3 = Trip::create([
          'name'=>'Recorrido 3',
          'description'=>'Vemos si llegamos a algún sitio'
      ]);
      $trip3->geopoints()->save($punto9);
      $trip3->geopoints()->save($punto10);
      $trip3->geopoints()->save($punto11);
      $trip3->geopoints()->save($punto12);
      $trip3->geopoints()->save($punto13);
    }
}
