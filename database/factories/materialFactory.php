<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\material;
use Faker\Generator as Faker;

$factory->define(material::class, function (Faker $faker) {

    return [
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'material_type' => $faker->text
    ];
});
