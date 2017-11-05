<?php

use Faker\Generator as Faker;

$factory->define(App\Contato::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'user_id' => factory('App\User')->create(),
        'email' => $faker->email,
        'informacoes' => $faker->paragraph
    ];
});
