<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
// use Illuminate\Foundation\Testing\DatabaseMigrations;
// use Illuminate\Foundation\Testing\DatabaseTransactions;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\Point;
use Phaza\LaravelPostgis\PostgisConnection;

use App\Models\GeoPoint;

class GeoPointTest extends TestCase{
    public function testSave(){
        $punto1 = new GeoPoint();
        $punto1->order = '1';
        $punto1->geopoint = new Point(-42.78331734, -65.07126427);
        $punto1->save();
        $this->assertTrue(true);
    }

    public function testUpdate(){

    }

    public function testDelete(){

    }
}
