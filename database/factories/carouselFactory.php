<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\carousel;
use Faker\Generator as Faker;

$factory->define(carousel::class, function (Faker $faker) {

    return [
        'banner_image' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
