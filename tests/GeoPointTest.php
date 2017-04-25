<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\GeoPoint;

class GeoPointTest extends TestCase{
    public function testModel(){
        $point = new GeoPoint(['latitude' => '-42.7672777','longitude' => '-65.036735', 'order' => '1']);

        // Se comprueba el funcionamiento del modelo.
        $this->assertTrue($point->latitude == '-42.7672777' && $point->longitude == '-65.036735' && $point->order == '1');
    }

    public function testSave(){
        // Se obtiene la cantidad de puntos almacenados antes de guardar el punto nuevo.
        $records_before = count(GeoPoint::All());
        // Se crea y persiste un nuevo punto.
        $point = GeoPoint::create(['latitude' => '-42.7672777','longitude' => '-65.036735','order' => '1']);
        // Se obtiene la cantidad de puntos almacenados luego de guardar el punto nuevo.
        $records_after = count(GeoPoint::All());
        // Se comprueba que el nuevo punto se haya guardado (deberia haber un punto mas almacenado).
        $this->assertTrue($records_after > $records_before);

        // Se elimina el punto creado (rollback).
        GeoPoint::destroy($point['id']);
    }

    public function testUpdate(){
        // Se crea y persiste un nuevo punto.
        $point = GeoPoint::create(['latitude' => '-42.7672777','longitude' => '-65.036735','order' => '1']);

        $point_db = GeoPoint::find($point['id']);
        // Se cambian los valores establecidos.
        $point_db->latitude = '-42';
        $point_db->longitude = '-65';
        $point_db->order = '2';

        $point_db->save(); // Se registran las modificaciones

        // Se recupera de nuevo el punto guardado.
        $point_db_after = GeoPoint::find($point['id']);

        // Se comprueba que se haya modificado correctamente en la base de datos.
        $this->assertTrue($point_db_after->latitude == $point_db->latitude);
        $this->assertTrue($point_db_after->longitude == $point_db->longitude);
        $this->assertTrue($point_db_after->order == $point_db->order);

        // Se elimina el punto creado (rollback).
        GeoPoint::destroy($point['id']);
    }

    public function testDelete(){
        // Se crea y persiste un nuevo punto.
        $point = GeoPoint::create(['latitude' => '-42.7672777','longitude' => '-65.036735', 'order' => '1']);
        // Se obtiene la cantidad de puntos almacenados antes de eliminar el nuevo punto.
        $records_before = count(GeoPoint::All());

        GeoPoint::destroy($point['id']);

        // Se obtiene la cantidad de puntos almacenados luego de borrar el punto nuevo.
        $records_after = count(GeoPoint::All());
        // Se comprueba que el nuevo punto haya sido eliminado de la base de datos.
        $this->assertTrue($records_after < $records_before);
    }
}
