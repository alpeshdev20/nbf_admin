<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\app_material;
use Faker\Generator as Faker;

$factory->define(app_material::class, function (Faker $faker) {

    return [
        'book_name' => $faker->word,
        'book_image' => $faker->word,
        'publisher' => $faker->word,
        'year' => $faker->word,
        'book_pdf' => $faker->word,
        'length' => $faker->word,
        'summary' => $faker->text,
        'tags' => $faker->text,
        'author' => $faker->text,
        'language' => $faker->text,
        'material_type' => $faker->randomDigitNotNull,
        'genre_id' => $faker->randomDigitNotNull,
        'department_id' => $faker->randomDigitNotNull,
        'subject_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
