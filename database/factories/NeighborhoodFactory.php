<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Address\Neighborhood;
use Faker\Generator as Faker;

$factory->define(Neighborhood::class, function (Faker $faker, $data) {
    return [
        'city_id' => $data['city_id'],
        'name' => $faker->citySuffix
    ];
});