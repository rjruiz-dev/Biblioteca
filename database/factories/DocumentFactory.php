<?php

use Faker\Generator as Faker;

$factory->define(App\Document::class, function (Faker $faker) {    
    return [
        'adequacies_id' => $faker->randomElement(['1','2']),
        'lenguages_id' => $faker->randomElement(['1','2']),
        'document_types_id' => $faker->randomElement(['1','2']),
        'creators_id' => $faker->randomElement(['1','2',]),
        'title'      => $faker->name,
        'original_title'   => $faker->name,
        'acquired'  => $faker->date($format = 'Y-m-d', $max = 'now'),
        'document_status'    => $faker->name,
        'let_author'      => $faker->name,
        'cdu'  => $faker->e164PhoneNumber,
        'let_title'   => $faker->name,
        'assessment'  => $faker->name,
        'desidherata'     => $faker->name, 
        'published' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'made_by' => $faker->name, 
        'year' => $faker->date($format = 'Y-m-d', $max = 'now'), 
        'volume'=> $faker->name, 
        //'quantity' => $faker->name, 
        'collection'     => $faker->name,
        'location'=> $faker->name, 
        'observation' => $faker->name, 
        'note'     => $faker->name,
        'synopsis' => $faker->name, 
        'photo'     => $faker->name,
        'registry number'  => $faker->name,  
    ];
});
