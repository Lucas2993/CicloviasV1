<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Centrality;
use App\Models\GeoPoint;

class CentralityTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGeoPoint(){
        // Se crea y persiste una nueva zona.
        $centrality = Centrality::create(['name' => 'Plaza','location' => 'Alta plaza']);
        // Se crean y persisten dos nuevos puntos.
        $point = GeoPoint::create(['latitude' => '-42.7672777','longitude' => '-65.036735', 'order' => '-1']);
        // Se asocian los nuevos puntos
        $centrality->geopoint()->save($point);
        // Se recupera la zona recientemente guardada.
        $centrality_db = Centrality::find($centrality->id);
        // Se recuperan los puntos.
        $point = $centrality_db->geopoint()->get()[0];
        // Se corrobora que los dos puntos asignados esten.
        $this->assertTrue($point['latitude'] == '-42.7672777');
        $this->assertTrue($point['longitude'] == '-65.036735');
        $this->assertTrue($point['order'] == '-1');

        // Se eliminan los datos usados.
        GeoPoint::destroy($point->id);
        Centrality::destroy($centrality->id);
    }
}
