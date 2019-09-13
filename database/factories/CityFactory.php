<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Address\City;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        'name' => $faker->city
    ];
});