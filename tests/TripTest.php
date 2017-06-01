<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\LineString;
use Phaza\LaravelPostgis\Geometries\Point;
use Phaza\LaravelPostgis\Geometries\Polygon;
use Phaza\LaravelPostgis\PostgisConnection;

use App\Models\Trip;
use App\Services\CicloviasHelper;
// use App\Http\Controllers\TripController;
class TripTest extends TestCase{

    use WithoutMiddleware;

    public function testSave(){
        //----------Recorrido N°1 ---------------

        $puntos = array();

        $punto1 = new Point(-42.785433072287184,-65.00562071800232);
        array_push($puntos, $punto1);
        $punto2 = new Point(-42.78510236674321,-65.00694036483765);
        array_push($puntos, $punto2);
        $punto3 = new Point(-42.784976383214136,-65.00773429870605);
        array_push($puntos, $punto3);
        $punto4 = new Point(-42.78490573167801,-65.0084088742733);
        array_push($puntos, $punto4);
        $punto5 = new Point(-42.782913366452874,-65.01536250114441);
        array_push($puntos, $punto5);
        $punto6 = new Point(-42.78147877687065,-65.0175513460938);
        array_push($puntos, $punto6);
        $punto7 = new Point(-42.78338435801508,-65.02320544269719);
        array_push($puntos, $punto7);

        $linestring = new LineString($puntos);

        $trip1 = new Trip();

        $trip1->name = 'Recorrido 1';
        $trip1->description = 'UNPSJB a la casa de Demian';
        $trip1->distance_km = '1.5';
        $trip1->user = 'Demián Barry';
        $trip1->time = date(DATE_RFC2822);
        $trip1->duration = date("20:23");
        $trip1->geom = $linestring;

        $trip1->save();
    }

    // public function testModel(){
    //     // Se crean dos nuevos puntos y se los incluye en un arreglo.
    //     $point_1 = new GeoPoint(['latitude' => '-42.7672777','longitude' => '-65.036735', 'order' => '1']);
    //     $point_2 = new GeoPoint(['latitude' => '-42.036735','longitude' => '-65.7672777', 'order' => '2']);
    //     $points = array($point_1, $point_2);
    //     // Se crea un recorrido incorporando el arreglo de puntos.
    //     $trip = new Trip(['name' => 'Nuevo Recorrido','description' => 'Recorrido de Test', 'points' => $points]);
    //     // Se comprueba el funcionamiento del modelo.
    //     $this->assertTrue(count($trip->points) == 2);
    //     $this->assertTrue($trip->name == 'Nuevo Recorrido');
    //     $this->assertTrue($trip->description == 'Recorrido de Test');
    // }
    //
    // public function testSave(){
    //     // Se obtiene la cantidad de recorridos almacenadas antes de guardar un nuevo recorrido.
    //     $records_before = count(Trip::All());
    //     // Se crea y persiste una nueva recorrido.
    //     $trip = Trip::create(['name' => 'Nuevo recorrido','description' => 'Alto recorrido']);
    //     // Se obtiene la cantidad de recorridos almacenadas luego de guardar el nuevo recorrido.
    //     $records_after = count(Trip::All());
    //     // Se comprueba que el nuevo recorrido se haya guardado (deberia haber un recorrido mas almacenada).
    //     $this->assertTrue($records_after > $records_before);
    //
    //     // Se eliminan los datos usados.
    //     Trip::destroy($trip->id);
    // }
    //
    // public function testGeoPoints(){
    //     // Se crea y persiste una nuevo recorrido.
    //     $trip = Trip::create(['name' => 'Nuevo recorrido','description' => 'Otro recorrido']);
    //     // Se crean y persisten dos nuevos puntos.
    //     $point_1 = GeoPoint::create(['latitude' => '-42.7672777','longitude' => '-65.036735', 'order' => '1']);
    //     $point_2 = GeoPoint::create(['latitude' => '-42.036735','longitude' => '-65.7672777', 'order' => '2']);
    //     // Se asocian los nuevos puntos
    //     $trip->geopoints()->save($point_1);
    //     $trip->geopoints()->save($point_2);
    //     // Se recupera el recorrido recientemente guardada.
    //     $trip_db = Trip::find($trip->id);
    //     // Se recuperan los puntos.
    //     $points = $trip_db->geopoints()->get();
    //     // Se corrobora que los dos puntos asignados esten.
    //     $this->assertTrue(count($points) == 2);
    //     $this->assertTrue($points[0]->order == '1');
    //     $this->assertTrue($points[1]->order == '2');
    //
    //     // Se eliminan los datos usados.
    //     GeoPoint::destroy($point_1->id);
    //     GeoPoint::destroy($point_2->id);
    //     Trip::destroy($trip->id);
    // }

    /**
    * Test de service GET "api/trip/closeToPoint/{latitude}/{longitude}" que recupera los puntos cercanos
    * al punto pasado como parametro. Por cercano se entiende menos de 300 mts.
    * Creado por JLDEVIA.
    * @test
    * @return void
    */
    /**  public function getCloseToPoint(){
    $this->generarDatosPrueba();

    $this->getJson('api/trip/closeToPoint/-42.780875/-65.038786')
    ->seeJson([
    'name' => 'Recorrido 2',
]);
}
*/
//}
// private function generarDatosPrueba(){
//     /*-------Recorrido 1------------*/
//     $trip = Trip::create(['name' => 'Recorrido 1','description' => 'Por la costanera']);
//
//     $punto1 = new GeoPoint([
//         'latitude' => '-42.763750',
//         'longitude' => '-65.034813',
//         'order' => '1'
//     ]);
//
//     $punto2 = new GeoPoint([
//         'latitude' => '-42.766617',
//         'longitude' => '-65.032968',
//         'order' => '2'
//     ]);
//
//     $punto3 = new GeoPoint([
//         'latitude' => '-42.769571',
//         'longitude' => '-65.031133',
//         'order' => '3'
//     ]);
//
//     $punto4 = new GeoPoint([
//         'latitude' => '-42.769449',
//         'longitude' => '-65.030656',
//         'order' => '4'
//     ]);
//
//     $punto5 = new GeoPoint([
//         'latitude' => '-42.771575',
//         'longitude' => '-65.028677',
//         'order' => '5'
//     ]);
//
//     $trip->geopoints()->save($punto1);
//     $trip->geopoints()->save($punto2);
//     $trip->geopoints()->save($punto3);
//     $trip->geopoints()->save($punto4);
//     $trip->geopoints()->save($punto5);
//     /*-------------------------------*/
//
//     /*-------Recorrido 2------------*/
//     $trip = Trip::create(['name' => 'Recorrido 2','description' => 'De mi casa a la facultad']);
//
//     $punto1 = new GeoPoint([
//         'latitude' => '-42.781429',
//         'longitude' => '-65.040457',
//         'order' => '1'
//     ]);
//
//     $punto2 = new GeoPoint([
//         'latitude' => '-42.779508',
//         'longitude' => '-65.034846',
//         'order' => '2'
//     ]);
//
//     $punto3 = new GeoPoint([
//         'latitude' => '-42.783492',
//         'longitude' => '-65.032099',
//         'order' => '3'
//     ]);
//
//     $punto4 = new GeoPoint([
//         'latitude' => '-42.780767',
//         'longitude' => '-65.024127',
//         'order' => '4'
//     ]);
//
//     $punto5 = new GeoPoint([
//         'latitude' => '-42.782413',
//         'longitude' => '-65.023033',
//         'order' => '5'
//     ]);
//
//     $punto6 = new GeoPoint([
//         'latitude' => '-42.780846',
//         'longitude' => '-65.018055',
//         'order' => '6'
//     ]);
//
//     $punto7 = new GeoPoint([
//         'latitude' => '-42.782822',
//         'longitude' => '-65.015008',
//         'order' => '7'
//     ]);
//
//     $punto8 = new GeoPoint([
//         'latitude' => '-42.785050',
//         'longitude' => '-65.005556',
//         'order' => '8'
//     ]);
//
//     $trip->geopoints()->save($punto1);
//     $trip->geopoints()->save($punto2);
//     $trip->geopoints()->save($punto3);
//     $trip->geopoints()->save($punto4);
//     $trip->geopoints()->save($punto5);
//     $trip->geopoints()->save($punto6);
//     $trip->geopoints()->save($punto7);
//     $trip->geopoints()->save($punto8);
//     /*-------------------------------*/
//
//     /*-------Recorrido 3------------*/
//     $trip = Trip::create(['name' => 'Recorrido 3','description' => 'De la terminal a la plaza del centro']);
//
//     $punto1 = new GeoPoint([
//         'latitude' => '-42.765430',
//         'longitude' => '-65.040688',
//         'order' => '1'
//     ]);
//
//     $punto2 = new GeoPoint([
//         'latitude' => '-42.764098',
//         'longitude' => '-65.039454',
//         'order' => '2'
//     ]);
//
//     $punto3 = new GeoPoint([
//         'latitude' => '-42.765157',
//         'longitude' => '-65.038781',
//         'order' => '3'
//     ]);
//
//     $punto4 = new GeoPoint([
//         'latitude' => '-42.767016',
//         'longitude' => '-65.037579',
//         'order' => '4'
//     ]);
//
//     $trip->geopoints()->save($punto1);
//     $trip->geopoints()->save($punto2);
//     $trip->geopoints()->save($punto3);
//     $trip->geopoints()->save($punto4);
//     /*-------------------------------*/
//
//     /*-------Recorrido 4------------*/
//     $trip = Trip::create(['name' => 'Recorrido 4','description' => 'De la Helice hasta la plaza del centro']);
//
//     $punto1 = new GeoPoint([
//         'latitude' => '-42.767016',
//         'longitude' => '-65.037579',
//         'order' => '1'
//     ]);
//
//     $punto2 = new GeoPoint([
//         'latitude' => '-42.767016',
//         'longitude' => '-65.037579',
//         'order' => '2'
//     ]);
//
//     $punto3 = new GeoPoint([
//         'latitude' => '-42.768577',
//         'longitude' => '-65.031735',
//         'order' => '3'
//     ]);
//
//     $punto4 = new GeoPoint([
//         'latitude' => '-42.769510',
//         'longitude' => '-65.034440',
//         'order' => '4'
//     ]);
//
//     $punto5 = new GeoPoint([
//         'latitude' => '-42.767431',
//         'longitude' => '-65.035749',
//         'order' => '5'
//     ]);
//
//     $trip->geopoints()->save($punto1);
//     $trip->geopoints()->save($punto2);
//     $trip->geopoints()->save($punto3);
//     $trip->geopoints()->save($punto4);
//     $trip->geopoints()->save($punto5);
//     /*-------------------------------*/
//
// }
//
// public function testTripDistance(){
//
//     // Se crean dos nuevos puntos y se los incluye en un arreglo.
//     $point_1 = new GeoPoint(['latitude' => '-42.7672777','longitude' => '-65.036735', 'order' => '1']);
//     $point_2 = new GeoPoint(['latitude' => '-42.036735','longitude' => '-65.7672777', 'order' => '2']);
//     $points = array($point_1, $point_2);
//     //Control de metros o kilometros
//     $distancia = (new TripController)->tripDistance($points);
//     //var_dump ($distancia);
//     $this->assertTrue($distancia > 0);
//
// }
//
public function testTripToDistance(){
    $trips= (new CicloviasHelper)->getToDistance(0.80, 50);
    $countstrip = count($trips);

//     //var_dump ($countstrip);
    $this->assertTrue($countstrip > 0);


}
//
public function testTripIdDistance(){
    //Control de metros o kilometros
    $distancia = (new CicloviasHelper)->tripIdDistance('1');
    var_dump ($distancia);
    $this->assertTrue($distancia > 0.0);
}


}
