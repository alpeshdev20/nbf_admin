<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\material_upload;
use Faker\Generator as Faker;

$factory->define(material_upload::class, function (Faker $faker) {

    return [
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'material_type' => $faker->text,
        'cover' => $faker->text,
        'file' => $faker->text,
        'title' => $faker->text,
        'author_name' => $faker->text,
        'publisher_name' => $faker->text,
        'publication_year' => $faker->text,
        'genre' => $faker->text,
        'subgenre' => $faker->text,
        'language' => $faker->text,
        'length' => $faker->text,
        'isbn_code' => $faker->text,
        'summary' => $faker->text
    ];
});
