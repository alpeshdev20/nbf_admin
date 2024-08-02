<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\genre_highlight;
use Faker\Generator as Faker;

$factory->define(genre_highlight::class, function (Faker $faker) {

    return [
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'genre' => $faker->text
    ];
});
