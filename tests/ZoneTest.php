<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\GeoPoint;
use App\Models\Zone;

class ZoneTest extends TestCase{
    use WithoutMiddleware;

    public function testModel(){
        // Se crean dos nuevos puntos y se los incluye en un arreglo.
        $point_1 = new GeoPoint(['latitude' => '-42.7672777','longitude' => '-65.036735']);
        $point_2 = new GeoPoint(['latitude' => '-42.036735','longitude' => '-65.7672777']);
        $points = array($point_1, $point_2);
        // Se crea una zona incorporando el arreglo de puntos.
        $zone = new Zone(['name' => 'Nueva zona','description' => 'Alta zona', 'points' => $points]);
        // Se comprueba el funcionamiento del modelo.
        $this->assertTrue(count($zone->points) == 2);
        $this->assertTrue($zone->name == 'Nueva zona');
        $this->assertTrue($zone->description == 'Alta zona');
    }

    public function testSave(){
        // Se obtiene la cantidad de zonas almacenadas antes de guardar la zona nueva.
        $records_before = count(Zone::All());
        // Se crea y persiste una nueva zona.
        $zone = Zone::create(['name' => 'Nueva zona','description' => 'Alta zona']);
        // Se obtiene la cantidad de zonas almacenadas luego de guardar la zona nueva.
        $records_after = count(Zone::All());
        // Se comprueba que la nueva zona se haya guardado (deberia haber una zona mas almacenada).
        $this->assertTrue($records_after > $records_before);

        // Se eliminan los datos usados.
        Zone::destroy($zone->id);
    }

    public function testGeoPoints(){
        // Se crea y persiste una nueva zona.
        $zone = Zone::create(['name' => 'Nueva zona','description' => 'Alta zona']);
        // Se crean y persisten dos nuevos puntos.
        $point_1 = GeoPoint::create(['latitude' => '-42.7672777','longitude' => '-65.036735']);
        $point_2 = GeoPoint::create(['latitude' => '-42.036735','longitude' => '-65.7672777']);
        // Se asocian los nuevos puntos
        $zone->geopoints()->save($point_1);
        $zone->geopoints()->save($point_2);
        // Se recupera la zona recientemente guardada.
        $zone_db = Zone::find($zone->id);
        // Se recuperan los puntos.
        $points = $zone_db->geopoints()->get();
        // Se corrobora que los dos puntos asignados esten.
        $this->assertTrue(count($points) == 2);

        // Se eliminan los datos usados.
        // GeoPoint::destroy($point_1->id);
        // GeoPoint::destroy($point_2->id);
        // Zone::destroy($zone->id);
    }
}
