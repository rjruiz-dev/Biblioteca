<?php

use Faker\Generator as Faker;

$factory->define(App\Document::class, function (Faker $faker) {    
    return [
        'adequacies_id' => $faker->randomElement(['1','2']),
        'lenguages_id' => $faker->randomElement(['1','2']),
        'document_types_id' => $faker->randomElement(['1','2']),
        'creators_id' => $faker->randomElement(['1','2',]),
        'document_subtypes_id' => $faker->randomElement(['1','2',]),
        'title'      => $faker->name,
        'original_title'   => $faker->title,
        'acquired'  => $faker->date($format = 'Y-m-d', $max = 'now'),
        'drop'  => $faker->date($format = 'Y-m-d', $max = 'now'),
        'document_status'    => $faker->name,
        'let_author'      => $faker->name,
        'cdu'  => $faker->e164PhoneNumber,
        'let_title'   => $faker->name,
        'assessment'  => $faker->numberBetween($min = 00, $max = 10),
        'desidherata'     => $faker->name, 
        'published' => $faker->state,
        'made_by' => $faker->company, 
        'year' => $faker->year($max = 'now'), 
        'volume'=> $faker->numerify('# Vol.'), 
        'quantity_generic' => $faker->numberBetween($min = 000, $max = 999),
        'collection'     => $faker->name,
        'location'=> $faker->name, 
        'observation' => $faker->sentence($nbWords = 6, $variableNbWords = true), 
        'note'     => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'synopsis' => $faker->sentence($nbWords = 6, $variableNbWords = true), 
        'photo'     => $faker->name,  
        'registry_number'  => $faker->unique()->numberBetween($min = 0000, $max = 9000),      
    ];
});
