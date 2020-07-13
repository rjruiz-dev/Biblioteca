<?php

use Faker\Generator as Faker;

$factory->define(App\Movies::class, function (Faker $faker) {
    return [
        'documents_id'          => $faker->randomElement(['1','2']),
        'generate_films_id'     => $faker->randomElement(['1','2']),  
        'generate_formats_id'   => $faker->randomElement(['1', '2', '3', '4', '5', '6']),     
        'subtitle'              => $faker->title,
        // 'director'              => $faker->name,
        'distribution'          => $faker->state,
        // 'original_title'        => $faker->name,
        'script'                => $faker->name,
        'specific_content'      => $faker->sentence,
        // 'photography'           => $faker->imageUrl($width = 150, $heigth = 150), 
        'awards'                => $faker->name,
        'distributor'           => $faker->company,
       
    ];
});
