<?php

use Faker\Generator as Faker;
use App\Models\Proveedor;

$factory->define(Proveedor::class, function (Faker $faker) {
    return [
        'razon_social' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'ruc' => $faker->unique()->biasedNumberBetween('1111111111','99999999999'),
        'representante' => $faker->name, // secret
        'telefono' => '976836164',
        'direccion' => $faker->name,
        'referencias' => $faker->paragraph, 
        'estado' => 1,
    ];

});
