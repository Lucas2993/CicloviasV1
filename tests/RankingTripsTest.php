<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;

use App\Services\RankingTrips;
use App\Models\Trip;


class RankingTripsTest extends TestCase{

  use WithoutMiddleware;

  public function testPrueba(){

    $trips= (new RankingTrips)->rankingedTrips();
    $countstrip = count($trips);

    $this->assertTrue($countstrip > 50);
  }

  public function testPrueba1(){
    $trips= (new RankingTrips)->rankingedTrips1();
    $countstrip = count($trips);

    $this->assertTrue($countstrip == 1);
  }

  public function testPruebaQuery(){
    $distanceTrip2 = (new RankingTrips)->rankingedTripsQuery();

    $this->assertTrue($distanceTrip2 > 900);
  }
}
