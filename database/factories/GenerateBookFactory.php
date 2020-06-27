<?php

use Faker\Generator as Faker;

$factory->define(App\Generate_book::class, function (Faker $faker) {
    return [        
        'genre_book'  => $faker->randomElement(['Cuento', 'Novela', 'Poesia', 'Ensayo', 'Teatro', 'Sin Especificar']),    
    ];
});
