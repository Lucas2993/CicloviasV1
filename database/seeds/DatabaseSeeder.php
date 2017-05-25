<?php




use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
      Model::unguard();

      $this->call(CentralitySeeder::class);
      $this->call(ZoneSeeder::class);
      $this->call(TripSeeder::class);
      $this->call(JourneySeeder::class);
      $this->call(RoadSeeder::class);
      $this->call(NamesSeeder::class);

      Model::reguard();
    }
}
