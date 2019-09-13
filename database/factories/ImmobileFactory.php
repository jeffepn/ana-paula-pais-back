<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Immobile\Immobile;
use Faker\Generator as Faker;
//Utility
use App\Utility\SiteUtility;

$factory->define(Immobile::class, function (Faker $faker, $data) {
    $dormitory = rand(1, 10);
    $suite = rand(1, $dormitory);
    $rent = (bool) rand(0, 1);
    $sale = (bool) rand(0, 1);
    $value_rent = 0;
    $value_sale = 0;
    if ($rent) {
        $value_rent = $faker->randomFloat(1, 0, 5000);
    }
    if ($sale) {
        $value_sale = $faker->randomFloat(1, 0, 2000000);
    }
    return [
        'slug' => 'AN-' . rand(111, 999),
        'type' => rand(1, count(SiteUtility::gettypesImmobile())),
        'neighborhood_id' => $data['neighborhood_id'],
        'rent' => $rent,
        'sale' => $sale,
        'value_rent' =>  $value_rent,
        'value_sale' => $value_sale,
        'dormitory' => $dormitory,
        'suite' =>    $suite,
        'bathroom' =>    $suite + 1,
        'garage' => rand(1, 10),
        'value_condominium' => $faker->randomFloat(1, 0, 300),
        'value_iptu' => $faker->randomFloat(1, 0, 300),
        'area_building' => $faker->randomFloat(1, 0, 300),
        'area_total' => $faker->randomFloat(1, 0, 300),
        'min_description' => $faker->text(rand(20, 50)),
        'description' => $faker->text(5000)
    ];
});