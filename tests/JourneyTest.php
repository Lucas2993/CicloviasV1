<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\LineString;
use Phaza\LaravelPostgis\Geometries\Point;
use Phaza\LaravelPostgis\Geometries\Polygon;
use Phaza\LaravelPostgis\PostgisConnection;

use App\Models\Journey;

class JourneyTest extends TestCase
{
    public function testSave(){
        $journey1 = new Journey();
        $journey1->peso = '5.0';

        $puntos = array();

        $punto1 = new Point(-42.781552,-65.040751);
        array_push($puntos, $punto1);
        $punto2 = new Point(-42.780304,-65.037001);
        array_push($puntos, $punto2);
        $punto3 = new Point(-42.780406,-65.037389);
        array_push($puntos, $punto3);
        $punto4 = new Point(-42.779473,-65.034723);
        array_push($puntos, $punto4);
        $punto5 = new Point(-42.781904,-65.033147);
        array_push($puntos, $punto5);
        $punto6 = new Point(-42.779132,-65.025103);
        array_push($puntos, $punto6);

        $journey1->geom = new LineString($puntos);
        $journey1->save();
        $this->assertTrue(true);
    }
}
