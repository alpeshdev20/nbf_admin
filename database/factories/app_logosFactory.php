<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\app_logos;
use Faker\Generator as Faker;

$factory->define(app_logos::class, function (Faker $faker) {

    return [
        'file_path' => $faker->text,
        'text_1' => $faker->word,
        'text_2' => $faker->word,
        'text_3' => $faker->word
    ];
});
