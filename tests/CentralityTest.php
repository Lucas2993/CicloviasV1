<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\LineString;
use Phaza\LaravelPostgis\Geometries\Point;
use Phaza\LaravelPostgis\Geometries\Polygon;
use Phaza\LaravelPostgis\PostgisConnection;

use App\Models\Centrality;

class CentralityTest extends TestCase
{
    use WithoutMiddleware;

    public function testSave(){
        $centralidad1 = new Centrality();
        $centralidad1->name = 'Escuela Nro. 42';
        $centralidad1->location = '25 De Mayo 1090';
        $centralidad1->geom = new Point(-42.775144, -65.029309);

        $centralidad1->save();
    }

    // public function testGeoPoint(){
    //     // Se crea y persiste una nueva zona.
    //     $centrality = Centrality::create(['name' => 'Plaza','location' => 'Alta plaza']);
    //     // Se crean y persisten dos nuevos puntos.
    //     $point = GeoPoint::create(['latitude' => '-42.7672777','longitude' => '-65.036735', 'order' => '-1']);
    //     // Se asocian los nuevos puntos
    //     $centrality->geopoint()->save($point);
    //     // Se recupera la zona recientemente guardada.
    //     $centrality_db = Centrality::find($centrality->id);
    //     // Se recuperan los puntos.
    //     $point = $centrality_db->geopoint()->get()[0];
    //     // Se corrobora que los dos puntos asignados esten.
    //     $this->assertTrue($point['latitude'] == '-42.7672777');
    //     $this->assertTrue($point['longitude'] == '-65.036735');
    //     $this->assertTrue($point['order'] == '-1');
    //
    //     // Se eliminan los datos usados.
    //     GeoPoint::destroy($point->id);
    //     Centrality::destroy($centrality->id);
    // }
    //
    // public function testApiShow(){
    //     // Se crea y persiste una nueva zona.
    //     $centrality = Centrality::create(['name' => 'Plaza','location' => 'Alta plaza']);
    //     // Se crean y persisten dos nuevos puntos.
    //     $point = GeoPoint::create(['latitude' => '-42.7672777','longitude' => '-65.036735', 'order' => '-1']);
    //     // Se asocian los nuevos puntos.
    //     $centrality->geopoint()->save($point);
    //     // Se solicita ver una centralidad a la api.
    //     $response = $this->get('/api/centrality/'.$centrality->id);
    //     // Se verifica que es correcto y la respuesta es como se espera.
    //     $response->assertResponseStatus(200)
    //             ->seeJson([
    //                 'id' => $centrality->id,
    //                 'name' => 'Plaza',
    //                 'location' => 'Alta plaza',
    //             ]);
    //
    //     // Se eliminan los datos usados.
    //     GeoPoint::destroy($point->id);
    //     Centrality::destroy($centrality->id);
    // }
    //
    // public function testApiStore(){
    //     // Se establece el set de datos a utilizar
    //     $data = ['name' => 'Plaza',
    //             'location' => 'Alta plaza',
    //             'latitude' => '-42.7672777',
    //             'longitude' => '-65.036735'];
    //     // Se obtiene la cantidad de registros almacenados antes de realizar la operacion.
    //     $records_before = count(Centrality::All());
    //     // Se solicita guardar la nueva centralidad a traves de la api.
    //     $response = $this->call('POST','/api/centrality', $data);
    //     // Se verifica que la operacion haya sido exitosa.
    //     $this->assertEquals(200, $response->status());
    //     // Se obtienen la cantidad de registros almacenados luego de realizar la operacion.
    //     $records_after = count(Centrality::All());
    //     // Se obtienen los datos de la respuesta para verificar los datos almacenados.
    //     $json = json_decode($response->content());
    //     // Se verifican los datos devueltos por la peticion.
    //     $this->assertEquals('Plaza', $json->name);
    //     $this->assertEquals('Alta plaza', $json->location);
    //     // Se comprueba que el nuevo registro fue almacenado.
    //     $this->assertTrue($records_before < $records_after);
    //     // Se descartan los cambios realizados
    //     Centrality::destroy($json->id);
    // }
    //
    // public function testApiAll(){
    //     // Se determina la cantidad de registros almacenados.
    //     $records_in_db = count(Centrality::All());
    //     // Se solicitan los registros almacenados a traves de la api.
    //     $response = $this->call('GET','/api/centrality');
    //     // Se verifica que la operacion haya sido exitosa.
    //     $this->assertEquals(200, $response->status());
    //     // Se obtienen los resultados en formato JSON.
    //     $json = json_decode($response->content());
    //     // Se comprueba que se hayan obtenido correctamente todos los registros.
    //     $this->assertTrue($records_in_db == count($json));
    // }
    //
    // public function testApiDelete(){
    //     // Se crea y persiste una nueva zona.
    //     $centrality = Centrality::create(['name' => 'Plaza','location' => 'Alta plaza']);
    //     // Se crean y persisten dos nuevos puntos.
    //     $point = GeoPoint::create(['latitude' => '-42.7672777','longitude' => '-65.036735', 'order' => '-1']);
    //     // Se asocian los nuevos puntos
    //     $centrality->geopoint()->save($point);
    //     // Se determina la cantidad de registros alamacenados antes de la operacion.
    //     $records_before = count(Centrality::All());
    //     // Se realiza el borrado del registro, recientemente guardado, mediante la api
    //     $response = $this->call('DELETE','/api/centrality/'.$centrality->id);
    //     // Se verifica que la operacion haya sido exitosa.
    //     $this->assertEquals(200, $response->status());
    //     // Se determina la cantidad de registros alamacenados despues de la operacion.
    //     $records_after = count(Centrality::All());
    //     // Se verifica que se haya borrado.
    //     $this->assertTrue($records_before > $records_after);
    //     // Se descartan los cambios realizados.
    //     Centrality::destroy($centrality->id);
    // }
    //
    // public function testApiUpdate(){
    //     // Se crea y persiste una nueva zona.
    //     $centrality = Centrality::create(['name' => 'Plaza','location' => 'Alta plaza']);
    //     // Se crean y persisten dos nuevos puntos.
    //     $point = GeoPoint::create(['latitude' => '-42.7672777','longitude' => '-65.036735', 'order' => '-1']);
    //     // Se asocian los nuevos puntos
    //     $centrality->geopoint()->save($point);
    //     // Se establecen los datos con una variacion en uno de sus atributos.
    //     $data = ['name' => 'Plaza1',
    //             'location' => 'Alta plaza',
    //             'latitude' => '-42.7672777',
    //             'longitude' => '-65.036735'];
    //     // Se solicita actualizar el registro mediante los datos anteriormente establecidos.
    //     $response = $this->call('PUT','/api/centrality/'.$centrality->id, $data);
    //     // Se verifica que la operacion haya sido exitosa.
    //     // Se obtiene el registro cambiado para verificar los cambios.
    //     $this->assertEquals(200, $response->status());
    //     $new_centrality = Centrality::find($centrality->id);
    //     // Se verifica que los cambios hayan sido realizados.
    //     $this->assertTrue($new_centrality->name == 'Plaza1');
    //     $this->assertTrue($centrality->name != $new_centrality->name);
    //     // Se descartan los cambios realizados.
    //     Centrality::destroy($centrality->id);
    // }
}
