<?php

use Faker\Generator as Faker;

$factory->define(App\Generate_format::class, function (Faker $faker) {
    return [        
        'genre_format'  => $faker->randomElement(['Beta', 'Cassette', 'Cd', 'Dvd', 'Vhs', 'Sin Especificar']),    
    ];
});
