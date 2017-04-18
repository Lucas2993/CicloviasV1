<?php




use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
// use Database\Seeds\CentralitySeeder;

class DatabaseSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
      Model::unguard();
      //$this->call(CentralitySeeder::class);
      $this->call(ZoneSeeder::class);
      Model::reguard();

    }
}
