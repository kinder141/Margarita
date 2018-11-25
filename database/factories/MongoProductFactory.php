<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\MongoProduct::class, function (Faker $faker) {
    return [
        'product_id' => rand(0, 100),
        'category_id' => rand(0, 100),
        'mark' => 0,
        'count' => 0,
        'comments' => []
    ];
});
