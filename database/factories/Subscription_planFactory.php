<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Subscription_plan;
use Faker\Generator as Faker;

$factory->define(Subscription_plan::class, function (Faker $faker) {

    return [
        'name' => $faker->text,
        'price' => $faker->randomDigitNotNull,
        'description' => $faker->text,
        'validity' => $faker->word,
        'status' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
