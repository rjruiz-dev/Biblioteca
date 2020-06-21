<?php

use Faker\Generator as Faker;

$factory->define(App\Document_type::class, function (Faker $faker) {
    return [        
        'document_description'  => $faker->randomElement(['Libro', 'Cine', 'Multimedia', 'Musica', 'Fotografia']),    
    ];
});
