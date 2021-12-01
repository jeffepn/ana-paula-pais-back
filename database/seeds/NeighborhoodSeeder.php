<?php

use Illuminate\Database\Seeder;
//Models
use App\Models\Address\City;
use App\Models\Address\Neighborhood;

class NeighborhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = City::create(['name' => 'Poços de Caldas']);
        Neighborhood::create(['city_id' => $city->id, 'name' => "Centro"]);
        Neighborhood::create(['city_id' => $city->id, 'name' => "Jd. Vitória"]);
        Neighborhood::create(['city_id' => $city->id, 'name' => "Santa Ângela"]);
        Neighborhood::create(['city_id' => $city->id, 'name' => "Dom Bosco"]);
        Neighborhood::create(['city_id' => $city->id, 'name' => "Contry Club"]);
        Neighborhood::create(['city_id' => $city->id, 'name' => "Jd dos Estados"]);
        Neighborhood::create(['city_id' => $city->id, 'name' => "São Geraldo"]);
        Neighborhood::create(['city_id' => $city->id, 'name' => "São José"]);
        Neighborhood::create(['city_id' => $city->id, 'name' => "Quisisana"]);
        Neighborhood::create(['city_id' => $city->id, 'name' => "Caio Junqueira"]);
        Neighborhood::create(['city_id' => $city->id, 'name' => "Jd Tiradentes"]);
    }
}
