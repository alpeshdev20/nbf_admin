<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\flaged_genre;
use Faker\Generator as Faker;

$factory->define(flaged_genre::class, function (Faker $faker) {

    return [
        'genre_id' => $faker->word,
        'genre_name' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
