<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Subscription;
use Faker\Generator as Faker;

$factory->define(Subscription::class, function (Faker $faker) {

    return [
        'user_id' => $faker->text,
        'transaction_id' => $faker->text,
        'subscription_plan_id' => $faker->text,
        'plan_validity' => $faker->text,
        'bank_ref_no' => $faker->text,
        'order_status' => $faker->text,
        'failure_message' => $faker->text,
        'payment_mode' => $faker->text,
        'card_name' => $faker->text,
        'status_code' => $faker->text,
        'status_message' => $faker->text,
        'currency' => $faker->word,
        'amount' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
