<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\user;
use Faker\Generator as Faker;

$factory->define(user::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'email' => $faker->word,
        'mobile' => $faker->word,
        'password' => $faker->word,
        'OTP' => $faker->word,
        'token' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
