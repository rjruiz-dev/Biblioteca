<?php

use Faker\Generator as Faker;

$factory->define(App\Music::class, function (Faker $faker) {
    return [
        'documents_id'          => $faker->randomElement(['1','2']),
        // 'music_types_id' => $faker->randomElement(['1','2']),
        'generate_musics_id'    => $faker->randomElement(['1','2']),     
        'generate_formats_id'   => $faker->randomElement(['1', '2', '3', '4', '5', '6']), 
        'sound'                 => $faker->name,       
        'producer'              => $faker->name,
      
    ];
});
