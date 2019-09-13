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
        $city = factory(City::class)->create();
        factory(Neighborhood::class, 7)->create(['city_id' => $city->id]);
    }
}