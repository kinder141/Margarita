<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Smartphone::class, function (Faker $faker) {
    static $rams = [
        256,
        512,
        1024,
        2048,
        4096,
    ];

    static $capacities = [
        16,
        32,
        64,
        128,
        256,
    ];

    static $display = [
        4.0,
        4.5,
        4.7,
        5.0,
        5.5,
        6.0,
    ];

    static $cpus = [
        'MEDIATEK',
        'Core M',
        'SNAPDRAGON',
        'APPLE A'
    ];

    static $names = [
        'ASUS',
        'ACER',
        'APPLE',
        'LENOVO',
        'SAMSUNG',
        'MEIZU',
        'ONEPLUS'
    ];

    return [
        'name' => (isset($names)) ? $names[array_rand($names, 1)] . ' ' . str_replace(':', '', strtoupper($faker->macAddress)) : 'ACER' . ' ' . str_replace(':', '', strtoupper($faker->macAddress)),
        'cpu' => (isset($cpus)) ? $cpus[array_rand($cpus, 1)] : 'Core i5',
        'ram' => (isset($rams)) ? $rams[array_rand($rams, 1)] : 256,
        'capacity' => (isset($capacities)) ? $capacities[array_rand($capacities, 1)] : 128,
        'manufacture' => $faker->company,
        'battery' => rand(35, 75),
        'display' => (isset($display)) ? $display[array_rand($display, 1)] : 13.3,
        'price' => rand(100, 1000),
        'amount' => rand(0, 50),
        'sd_card' => rand(0, 1),
    ];
});
