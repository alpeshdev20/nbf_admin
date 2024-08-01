<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\sgenre;
use Faker\Generator as Faker;

$factory->define(sgenre::class, function (Faker $faker) {

    return [
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'genre' => $faker->text,
        'subgenre' => $faker->text
    ];
});
