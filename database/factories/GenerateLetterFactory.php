<?php

use Faker\Generator as Faker;

$factory->define(App\Generate_letter::class, function (Faker $faker) {
    return [
        'title'   => $faker->title,
        'body'    => $faker->sentence($nbWords = 10, $variableNbWords = true),  
        'excerpt' => $faker->sentence($nbWords = 6, $variableNbWords = true)  
    ];
});
