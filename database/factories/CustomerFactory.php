<?php

/** @var Factory $factory */

use App\Models\Customer;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'status' => $faker->randomElement(['active', 'inactive'])
    ];
});
