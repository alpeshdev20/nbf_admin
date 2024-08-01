<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\advertisement;
use Faker\Generator as Faker;

$factory->define(advertisement::class, function (Faker $faker) {

    return [
        'image' => $faker->word,
        'heading' => $faker->word,
        'description' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
