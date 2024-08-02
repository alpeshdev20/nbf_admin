<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\admlogin;
use Faker\Generator as Faker;

$factory->define(admlogin::class, function (Faker $faker) {

    return [
        'id' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'name' => $faker->text,
        'email' => $faker->text,
        'email_verified_at' => $faker->text,
        'password' => $faker->text,
        'remember_token' => $faker->text
    ];
});
