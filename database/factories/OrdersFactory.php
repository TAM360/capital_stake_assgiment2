<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    $status = ['new', 'processed'];
    $num1 = $faker->numberBetween($min = 1000, $max = 9999);
    $num2 = $faker->numberBetween($min = 1000, $max = 9999);
    $num3 = $faker->numberBetween($min = 1000, $max = 9999);
    $randomInvoice = "{$num1}-{$num2}-{$num3}";
    return [
        'customer_id' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 1, $max = 200),
        'invoice_number' => $randomInvoice,
        'total_amount' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 100, $max = 1000),
        'status' => $status[$faker->numberBetween($min = 0, $max = 1)],
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
