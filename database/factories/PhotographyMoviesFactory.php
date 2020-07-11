<?php

use Faker\Generator as Faker;

$factory->define(App\photography_movies::class, function (Faker $faker) {
    return [
        'photography_movies_name'  => $faker->randomElement(['ph movie 1', 'ph movie 2', 'ph movie 3']),    
   
    ];
});
