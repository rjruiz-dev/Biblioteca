<?php

use Faker\Generator as Faker;

$factory->define(App\Generate_film::class, function (Faker $faker) {
    return [        
        'genre_film'  => $faker->randomElement(['Acción', 'Aventura', 'Bélico', 'Biografía', 'Drama', 'Sin Especificar']),    
    ];
});
