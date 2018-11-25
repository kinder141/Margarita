<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Television::class, function (Faker $faker) {

    static $frequency = [
        100,
        150,
        200,
        300,
        400,
    ];

    static $display = [
        42.0,
        45.2,
        55.4,
        65.5,
        75.5,
    ];

    static $cpus = [
        'Core i3',
        'Core i5',
        'Core i7',
        'Core i9',
        'Core Pentium',
    ];

    static $names = [
        'LG',
        'SONY',
        'SAMSUNG',
        'SHARP',
    ];

    if (isset($names)) {
        $name = $names[array_rand($names, 1)];
    } else {
        $name = 'SONY';
    }

    return [
        'name' => $name . ' ' . str_replace(':', '', strtoupper($faker->macAddress)),
        'cpu' => (isset($cpus)) ? $cpus[array_rand($cpus, 1)] : 'Core i5',
        'frequency' => (isset($frequency)) ? $frequency[array_rand($frequency, 1)] : 100,
        'manufacture' => $name,
        'display' => (isset($display)) ? $display[array_rand($display, 1)] : 13.3,
        'price' => rand(100, 1000),
        'amount' => rand(0, 50),
    ];
});
