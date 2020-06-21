<?php

use Faker\Generator as Faker;

$factory->define(App\Book_type::class, function (Faker $faker) {
    return [        
        'book_type_description'  => $faker->randomElement(['Literatura', 'Publicacíon Periódica', 'Otros']),    
    ];
});
