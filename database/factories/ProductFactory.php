<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
    return [
        'name' => $faker->productName,
        'amount' => $faker->randomFloat(2, 1, 100),
        'description' => $faker->text(200),
        'department'=>$faker->department,
        'status' => 'have enough',
    ];
});
