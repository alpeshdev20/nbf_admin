<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\app_user;
use Faker\Generator as Faker;

$factory->define(app_user::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'email' => $faker->word,
        'password' => $faker->word,
        'mobile' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
