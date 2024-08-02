<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\book_publisher;
use Faker\Generator as Faker;

$factory->define(book_publisher::class, function (Faker $faker) {

    return [
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'user_id' => $faker->randomDigitNotNull,
        'publisher' => $faker->text,
        'active' => $faker->word
    ];
});
