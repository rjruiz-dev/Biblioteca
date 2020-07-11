<?php

use Faker\Generator as Faker;

$factory->define(App\Generate_movie::class, function (Faker $faker) {
    return [        
        'genre_movie'  => $faker->randomElement(['genero movi 1', 'genero movi 2', 'genero movi 3', 'genero movi 4', 'genero movi 5']),    
    ];
});
