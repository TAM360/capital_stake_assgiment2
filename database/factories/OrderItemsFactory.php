<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderItem;
use Faker\Generator as Faker;

$factory->define(OrderItem::class, function (Faker $faker) {
    return [
        'order_id' => $faker->numberBetween($min = 1, $max = 50),
        'product_id' => $faker->numberBetween($min = 1, $max = 100),
        'quantity' => $faker->numberBetween($min = 1, $max = 10),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
