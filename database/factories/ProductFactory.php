<?php

use Faker\Generator as Faker;
use App\Supplier;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
    		'suppliers_id' =>factory('App\Supplier')->create(),
            'name' => $faker->word,
            'description' => $faker->paragraph,
            'cost' => rand(0, 1000) + (rand(0, 10) / 10),
            'quantity' => rand(10, 1000)
            
        ];
});
