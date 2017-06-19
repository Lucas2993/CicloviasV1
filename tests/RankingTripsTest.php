<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;

use App\Services\RankingTrips;
use App\Models\Trip;


class RankingTripsTest extends TestCase{

  use WithoutMiddleware;

  public function testPrueba(){

    $trips= (new RankingTrips)->rankingedTrips();
    $countstrip = count($trips);

    $this->assertTrue($countstrip > 7);
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

  public function testPruebaQuery2(){
    $setTripsEq = (new RankingTrips)->rankingedTripsQuery2();
    // echo "cjtoRecuperado: ".$setTripsEq;

    $this->assertTrue(count($setTripsEq) == 5);
  }

  // public function testPruebaTripsSimil(){
  //   $tramos = (new RankingTrips)->getCoordenatesTripsSimil();
  //
  //   $this->assertTrue(count($tramos) == 4);
  // }

  public function testPruebaTramosRankinged(){
    $arrayIds = array(4,5,6,7,8);
    // $arrayIds = array(4,5,6);
    $tramos = (new RankingTrips)->getTramosRanking($arrayIds);
    // se toma solo 3 recorridos en este caso
    $this->assertTrue(count($tramos) == 4);
  }
}
