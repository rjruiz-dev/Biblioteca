<?php

use Faker\Generator as Faker;

$factory->define(App\Document_subtype::class, function (Faker $faker) {
    return [
        'document_types_id'  => $faker->randomElement(['1', '2', '3']),  
        'subtype_name'  => $faker->randomElement(['Literatura', 'Publicacíon Periódica', 'Otros']),  
    ];
});
