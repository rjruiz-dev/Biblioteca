<?php

use Faker\Generator as Faker;

$factory->define(App\Music_type::class, function (Faker $faker) {
    return [        
        'music_description'  => $faker->randomElement(['Culta', 'Popular']),    
    ];
});
