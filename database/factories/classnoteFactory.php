<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\classnote;
use Faker\Generator as Faker;

$factory->define(classnote::class, function (Faker $faker) {

    return [
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'cover' => $faker->text,
        'pdf_file' => $faker->text,
        'title' => $faker->text,
        'author_name' => $faker->text,
        'publisher_year' => $faker->text,
        'publication_year' => $faker->text,
        'genre' => $faker->text,
        'subgenre' => $faker->text,
        'language' => $faker->text,
        'no_of_page' => $faker->text,
        'isbn_code' => $faker->text,
        'summary' => $faker->text
    ];
});
