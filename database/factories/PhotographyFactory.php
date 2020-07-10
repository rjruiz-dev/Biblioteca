<?php

use Faker\Generator as Faker;

$factory->define(App\Photography::class, function (Faker $faker) {
    return [
        'documents_id'          => $faker->randomElement(['1','2']),         
        'generate_formats_id'   => $faker->randomElement(['1', '2', '3', '4', '5', '6']), 
        'subtitle'              => $faker->title,
        'second_author'         => $faker->name,
        'third_author'          => $faker->name,
        'producer'              => $faker->name,
        'edition'               => $faker->company,
    ];
});
