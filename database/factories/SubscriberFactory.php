<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Subscriber;
use Faker\Generator as Faker;

$factory->define(Subscriber::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'email' => $faker->word,
        'plan_name' => $faker->word,
        'plan_validity' => $faker->word,
        'mobile' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
