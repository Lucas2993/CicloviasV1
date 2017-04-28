<?php




use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
// use Database\Seeds\CentralitySeeder;
// use Database\Seeds\ZoneSeeder;

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
      Model::reguard();
    }
}
