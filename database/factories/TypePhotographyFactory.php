<?php

use Faker\Generator as Faker;

$factory->define(App\type_photography::class, function (Faker $faker) {
    return [    
        'photography_description'  => $faker->randomElement(['Diapositivas', 'Catálogos', 'Negativos']),
    ];
});
