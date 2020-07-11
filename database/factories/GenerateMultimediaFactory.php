<?php

use Faker\Generator as Faker;

$factory->define(App\Generate_multimedia::class, function (Faker $faker) {
    return [
        'genre_multimedia'  => $faker->randomElement(['gene mult 1', 'gene mult 2', 'gene mult 3']),    
    ];
});
