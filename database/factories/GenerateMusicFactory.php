<?php

use Faker\Generator as Faker;

$factory->define(App\Generate_music::class, function (Faker $faker) {
    return [        
        'genre_music'  => $faker->randomElement(['Blues', 'Jazz', 'Pop', 'Salsa', 'Clásica', 'Rap']),    
    ];
});
