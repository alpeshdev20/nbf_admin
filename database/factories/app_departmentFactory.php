<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\app_department;
use Faker\Generator as Faker;

$factory->define(app_department::class, function (Faker $faker) {

    return [
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'department_name' => $faker->text,
        'genre_id' => $faker->text
    ];
});
