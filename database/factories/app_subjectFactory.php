<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\app_subject;
use Faker\Generator as Faker;

$factory->define(app_subject::class, function (Faker $faker) {

    return [
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'subject_name' => $faker->text,
        'department_id' => $faker->text
    ];
});
