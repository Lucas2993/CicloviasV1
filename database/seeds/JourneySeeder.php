<?php

use Illuminate\Database\Seeder;
use App\Models\Journey;
use App\Models\GeoPoint;

class JourneySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /*
      ****Trayecto 1**********
      */
      $trayecto1 = Journey::create( [
        'peso' => '5.0'
      ]);

      $puntos = array();

      $punto1 = new Geopoint([
          'latitude' => '-42.781552',
          'longitude' => '-65.040751',
          'order' => '1'
      ]);

      array_push($puntos, $punto1);

      $punto2 = new Geopoint([
          'latitude' => '-42.780304',
          'longitude' => '-65.037001',
          'order' => '2'
      ]);

      array_push($puntos, $punto2);

      $punto3 = new Geopoint ([
        'latitude' => '-42.780406',
        'longitude' => '-65.037389',
        'order' => '3'
      ]);

      array_push($puntos, $punto3);

      $punto4 = new Geopoint ([
        'latitude' => '-42.779473',
        'longitude' => '-65.034723',
        'order' => '4'
      ]);

      array_push($puntos, $punto4);

      $punto5 = new Geopoint ([
        'latitude' => '-42.781904',
        'longitude' => '-65.033147',
        'order' => '5'
      ]);

      array_push($puntos, $punto5);

      $punto6 = new Geopoint ([
        'latitude' => '-42.779132',
        'longitude' => '-65.025103',
        'order' => '6'
      ]);

      array_push($puntos, $punto6);

      foreach ($puntos as $punto)
      {
        $trayecto1->points()->save($punto);
      }
      ///////////////////////////////////

      /*
      ****Trayecto 2**********
      */
      $trayecto2 = Journey::create( [
        'peso' => '4.0'
      ]);

      $puntos = array();

      $punto1 = new Geopoint([
          'latitude' => '-42.771879',
          'longitude' => '-65.029648',
          'order' => '1'
      ]);

      array_push($puntos, $punto1);

      $punto2 = new Geopoint([
          'latitude' => '-42.769587',
          'longitude' => '-65.031118',
          'order' => '2'
      ]);

      array_push($puntos, $punto2);

      $punto3 = new Geopoint ([
        'latitude' => '-42.770485',
        'longitude' => '-65.033811',
        'order' => '3'
      ]);

      array_push($puntos, $punto3);

      $punto4 = new Geopoint ([
        'latitude' => '-42.767043',
        'longitude' => '-65.036000',
        'order' => '4'
      ]);

      array_push($puntos, $punto4);

      foreach ($puntos as $punto)
      {
        $trayecto2->points()->save($punto);
      }
      ///////////////////////////////////

      /*
      ****Trayecto 3**********
      */
      $trayecto3 = Journey::create( [
        'peso' => '0'
      ]);

      $puntos = array();

      $punto1 = new Geopoint([
          'latitude' => '-42.768000',
          'longitude' => '-65.037019',
          'order' => '1'
      ]);

      array_push($puntos, $punto1);

      $punto2 = new Geopoint([
          'latitude' => '-42.770957',
          'longitude' => '-65.035158',
          'order' => '2'
      ]);

      array_push($puntos, $punto2);

      $punto3 = new Geopoint ([
        'latitude' => '-42.770957',
        'longitude' => '-65.035158',
        'order' => '3'
      ]);

      array_push($puntos, $punto3);

      $punto4 = new Geopoint ([
        'latitude' => '-42.782815',
        'longitude' => '-65.014988',
        'order' => '4'
      ]);

      array_push($puntos, $punto4);

      $punto5 = new Geopoint ([
        'latitude' => '-42.785066',
        'longitude' => '-65.005608',
        'order' => '5'
      ]);

      array_push($puntos, $punto5);

      foreach ($puntos as $punto)
      {
        $trayecto2->points()->save($punto);
      }
      ///////////////////////////////////

    }
}
