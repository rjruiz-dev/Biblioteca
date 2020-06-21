<?php

use Faker\Generator as Faker;

$factory->define(App\gender::class, function (Faker $faker) {
    return [        
        'description_genre'  => $faker->randomElement(['Cuento', 'Novela', 'Poesia', 'Acción', 'Drama', 'Aventura', 'Clasica', 'Blues']),    
    ];
});
