<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ExternalApp;
use Faker\Generator as Faker;

$factory->define(ExternalApp::class, function (Faker $faker) {

    return [
        'name' => $faker->text,
        'url' => $faker->text,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
