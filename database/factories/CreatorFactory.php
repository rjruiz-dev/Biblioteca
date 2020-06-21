<?php

use Faker\Generator as Faker;

$factory->define(App\Creator::class, function (Faker $faker) {
    return [
        'document_types_id' => $faker->randomElement(['1','2','3','4','5']),    
        'creator_name'      => $faker->name
        
    ];
});
