<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\app_publisher;
use Faker\Generator as Faker;

$factory->define(app_publisher::class, function (Faker $faker) {

    return [
        'company_name' => $faker->word,
        'address' => $faker->word,
        'city' => $faker->word,
        'postal_code' => $faker->word,
        'upload_address_proof' => $faker->word,
        'pan_card' => $faker->word,
        'aadhar_card' => $faker->word,
        'gst_or_tin_card' => $faker->word,
        'first_name' => $faker->word,
        'last_name' => $faker->word,
        'email' => $faker->word,
        'username' => $faker->word,
        'password' => $faker->word,
        'select_question' => $faker->word,
        'security_answer' => $faker->word,
        'check_box' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
