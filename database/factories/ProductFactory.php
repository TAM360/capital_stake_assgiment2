<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Product;

$factory->define(Product::class, function (Faker $faker) {
    $categories = ['Branded Foods ', 'Households ', 'Veggies & Fruits ', 'Kitchen ', 'Bread & Bakery '];
    $index = $faker->numberBetween(0, 4);
    $randomNumber = $faker->numberBetween(0, 100);
    return [
        'name' => $categories[$index]." {$randomNumber}",
        'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
        'in_stock' => $faker->boolean($chanceOfGettingTrue = 50) ,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
