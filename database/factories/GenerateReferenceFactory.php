<?php

use Faker\Generator as Faker;

$factory->define(App\Generate_reference::class, function (Faker $faker) {
    return [        
        'reference_description'  => $faker->randomElement(['Cine', 'Clipper', 'Disco', 'Esclavitud', 'Piano', 'Siglo XIX']),    
    ];
});
