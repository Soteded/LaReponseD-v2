<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
        'pseudo' => $faker->name,
        'birthDate' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'telNbr' => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});