<?php

use Faker\Generator as Faker;
use Faker\Provider\pt_BR\Company;

$factory->define(App\Supplier::class, function (Faker $faker) {
    return [
            'name' => $faker->company,
            'cnpj' => 97377559000177,
            'address' => $faker->address,
        ];
});
