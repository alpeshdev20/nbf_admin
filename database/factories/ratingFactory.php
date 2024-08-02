<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\rating;
use Faker\Generator as Faker;

$factory->define(rating::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'book_id' => $faker->word,
        'rating' => $faker->word,
        'comment' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
