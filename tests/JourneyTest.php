<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Journey;
use App\Models\GeoPoint;

class JourneyTest extends TestCase
{

    use DatabaseMigrations;

    /**
    * Test de service GET "api/journey" que devuelve el listado completo de trayectos.
    * Creado por JLDEVIA.
    * @test
    * @return void
    */
    public function getJourneys()
    {
        $this->crearDatosPrueba();

        $this->json('GET', 'api/journey')
              ->seeJson([
                'id'=> 1,
                'peso'=>'5.0',
                'latitude'=> '-42.781552'
              ]);
    }

    /**
    * Test de service GET "api/journey/{id}" que devuelve el trayecto con el id pasado como
    * parámetro.
    * Creado por JLDEVIA.
    * @test
    * @return void
    */
    public function showJourney()
    {
      $this->crearDatosPrueba();

      $this->json('GET', 'api/journey/1')
            ->seeJson([
              'peso' => '5.0',
              'latitude' => '-42.780304'
            ]);
    }

    /**
    * Test de service DELETE "api/journey/{id}" que elimina el trayecto pasado como parámetro.
    * Creado por JLDEVIA.
    * @test
    * @return void
    */
    public function destroyJourney()
    {
      $this->crearDatosPrueba();

      $response = $this->call('DELETE', 'api/journey/1');

      $this->assertResponseOk();
    }

    /**
    * Test de service PUT "api/journey/{id}" que actualiza el trayecto pasado como parámetro.
    * Creado por JLDEVIA.
    * @test
    * @return void
    */
    public function updateJourney()
    {
      $this->crearDatosPrueba();

      $this->json('PUT', 'api/journey/1', ['peso'=>'4.5']);
      $this->assertResponseOk();
    }

    private function crearDatosPrueba()
    {
      /*
       Se crean trayectos
      */
      $trayecto1 = Journey::create( [
        'peso' => '5.0'
      ]);

      $punto1 = new Geopoint([
          'latitude' => '-42.781552',
          'longitude' => '-65.040751',
          'order' => '1'
      ]);

      $punto2 = new Geopoint([
          'latitude' => '-42.780304',
          'longitude' => '-65.037001',
          'order' => '2'
      ]);

      $trayecto1->points()->save($punto1);
      $trayecto1->points()->save($punto2);

    }

}
