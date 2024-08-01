<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\admin;
use Faker\Generator as Faker;

$factory->define(admin::class, function (Faker $faker) {

    return [
        'email' => $faker->word,
        'password' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
