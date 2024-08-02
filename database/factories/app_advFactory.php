<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\app_adv;
use Faker\Generator as Faker;

$factory->define(app_adv::class, function (Faker $faker) {

    return [
        'image' => $faker->word,
        'material' => $faker->word,
        'active' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
