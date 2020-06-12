<?php

use Faker\Generator as Faker;

$factory->define(App\Statu::class, function (Faker $faker) {
    return [       
        'state_description'  => $faker->randomElement(['Activo', 'Inactivo', 'Pendiente']),    
    ];
});

