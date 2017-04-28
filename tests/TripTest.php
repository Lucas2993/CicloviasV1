<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\GeoPoint;
use App\Models\Trip;

class TripTest extends TestCase
{
  public function testModel(){
      // Se crean dos nuevos puntos y se los incluye en un arreglo.
      $point_1 = new GeoPoint(['latitude' => '-42.7672777','longitude' => '-65.036735', 'order' => '1']);
      $point_2 = new GeoPoint(['latitude' => '-42.036735','longitude' => '-65.7672777', 'order' => '2']);
      $points = array($point_1, $point_2);
      // Se crea un recorrido incorporando el arreglo de puntos.
      $trip = new Trip(['name' => 'Nuevo Recorrido','description' => 'Recorrido de Test', 'points' => $points]);
      // Se comprueba el funcionamiento del modelo.
      $this->assertTrue(count($trip->points) == 2);
      $this->assertTrue($trip->name == 'Nuevo Recorrido');
      $this->assertTrue($trip->description == 'Recorrido de Test');
  }

  public function testSave(){
      // Se obtiene la cantidad de recorridos almacenadas antes de guardar un nuevo recorrido.
      $records_before = count(Trip::All());
      // Se crea y persiste una nueva recorrido.
      $trip = Trip::create(['name' => 'Nuevo recorrido','description' => 'Alto recorrido']);
      // Se obtiene la cantidad de recorridos almacenadas luego de guardar el nuevo recorrido.
      $records_after = count(Trip::All());
      // Se comprueba que el nuevo recorrido se haya guardado (deberia haber un recorrido mas almacenada).
      $this->assertTrue($records_after > $records_before);

      // Se eliminan los datos usados.
      Trip::destroy($trip->id);
  }

  public function testGeoPoints(){
      // Se crea y persiste una nuevo recorrido.
      $trip = Trip::create(['name' => 'Nuevo recorrido','description' => 'Otro recorrido']);
      // Se crean y persisten dos nuevos puntos.
      $point_1 = GeoPoint::create(['latitude' => '-42.7672777','longitude' => '-65.036735', 'order' => '1']);
      $point_2 = GeoPoint::create(['latitude' => '-42.036735','longitude' => '-65.7672777', 'order' => '2']);
      // Se asocian los nuevos puntos
      $trip->geopoints()->save($point_1);
      $trip->geopoints()->save($point_2);
      // Se recupera el recorrido recientemente guardada.
      $trip_db = Trip::find($trip->id);
      // Se recuperan los puntos.
      $points = $trip_db->geopoints()->get();
      // Se corrobora que los dos puntos asignados esten.
      $this->assertTrue(count($points) == 2);
      $this->assertTrue($points[0]->order == '1');
      $this->assertTrue($points[1]->order == '2');

      // Se eliminan los datos usados.
      GeoPoint::destroy($point_1->id);
      GeoPoint::destroy($point_2->id);
      Trip::destroy($trip->id);
  }

}
