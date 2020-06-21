<?php

use Faker\Generator as Faker;

$factory->define(App\Adequacy::class, function (Faker $faker) {
    return [        
        'adequacy_description'  => $faker->randomElement(['Sin Especificar', 'Todos', 'Jovenes', 'Mayores de 7 años', 'Mayores de 13 años', 'Adultos']),    
    ];
});
