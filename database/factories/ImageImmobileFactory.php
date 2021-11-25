<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Immobile\ImageImmobile;

$factory->define(ImageImmobile::class, function (Faker $faker, $data) {
    $imageflag = rand(1, 5);
    return [
        'immobile_id' => $data['immobile_id'],
        'way' => 'images/properties/' . $imageflag . '.jpg',
        'alt' => '',
    ];
});
