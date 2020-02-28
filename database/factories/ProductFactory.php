<?php

/** @var Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->sentence,
        'sku' => $faker->word,
        'price' => rand(4000, 9000),
        'quantity' => rand(4000, 9000)
    ];
});
