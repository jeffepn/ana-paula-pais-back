<?php

use Illuminate\Database\Seeder;
//Models
use App\Models\Immobile\Immobile;
use App\Models\Immobile\ImageImmobile;

class ImmobileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i <= 30; $i++) {
            $immobile =  factory(Immobile::class)->create(['neighborhood_id' => rand(1, 11)]);
            factory(ImageImmobile::class, rand(3, 6))->create(['immobile_id' => $immobile->id]);
        }
    }
}
