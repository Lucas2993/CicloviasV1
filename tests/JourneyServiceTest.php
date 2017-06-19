<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\CicloviasHelper;
use App\Services\JourneyService;

class JourneyServiceTest extends TestCase
{
    /**
     * Test del generador de trayectos.
     * @test
     * @return void
     */
    public function generateJourneys()
    {
      $helper = new CicloviasHelper();
      $service = new JourneyService($helper);

      $service->generateJourneysFromTrips(4, 0.3);

      $this->seeInDatabase('journeys',[
        'ref_datalog'=>'4'
      ]);
    }
}
