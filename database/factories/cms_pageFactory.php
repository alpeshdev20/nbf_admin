<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\cms_page;
use Faker\Generator as Faker;

$factory->define(cms_page::class, function (Faker $faker) {

    return [
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'page_name' => $faker->text,
        'content' => $faker->word,
        'active' => $faker->word
    ];
});
