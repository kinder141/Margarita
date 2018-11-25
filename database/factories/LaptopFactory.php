<?php

use App\Category;
use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Laptop::class, function (Faker $faker) {
    static $rams = [
        2048,
        4096,
        8192,
        16384,
    ];

    static $capacities = [
      128,
      256,
      512,
      1024,
      2048,
      4096,
    ];

    static $video = [
        'Nvidia Geforce GTX 560',
        'Nvidia Geforce GTX 1080',
        'Nvidia Geforce GTX 1050',
        'Nvidia Geforce GTX 1070',
        'Nvidia Geforce GTX 960',
        'Nvidia Geforce GTX 660',
        'Radeon Pro 555',
        'Radeon Pro 550',
        'Radeon Pro 560',
        'Radeon Pro 450',
        'Radeon Pro 460',
    ];

    static $display = [
        13.3,
        11.2,
        15.4,
        17.5,
    ];

    static $cpus = [
        'Core i3',
        'Core i5',
        'Core i7',
        'Core i9',
        'AMD',
        'Core Pentium',
    ];

    static $names = [
        'ASUS',
        'ACER',
        'APPLE',
        'LENOVO',
        'DELL',
    ];

    return [
        'name' => (isset($names)) ? $names[array_rand($names, 1)] . ' ' . str_replace(':', '', strtoupper($faker->macAddress)) : 'ACER' . ' ' . str_replace(':', '', strtoupper($faker->macAddress)),
        'cpu' => (isset($cpus)) ? $cpus[array_rand($cpus, 1)] : 'Core i5',
        'ram' => (isset($rams)) ? $rams[array_rand($rams, 1)] : 256,
        'video_card' => (isset($video)) ? $video[array_rand($video, 1)] : 'GTX 440',
        'capacity' => (isset($capacities)) ? $capacities[array_rand($capacities, 1)] : 128,
        'manufacture' => $faker->company,
        'battery' => rand(35, 75),
        'display' => (isset($display)) ? $display[array_rand($display, 1)] : 13.3,
        'price' => rand(100, 1000),
        'amount' => rand(0, 50),
        'video' => rand(0, 1)
    ];
});
