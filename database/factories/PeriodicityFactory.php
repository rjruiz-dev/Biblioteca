<?php

use Faker\Generator as Faker;

$factory->define(App\Periodicity::class, function (Faker $faker) {
    return [        
        'periodicity_name'  => $faker->randomElement(['Semanal', 'Quincenal']),    
    ];
});