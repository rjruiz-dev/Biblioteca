<?php

use Faker\Generator as Faker;

$factory->define(App\Generate_subjects::class, function (Faker $faker) {
    return [        
        'subject_name'  => $faker->randomElement(['Algebra', 'Análisis', 'Comercio']),    
        'cdu'           => $faker->randomElement(['960', '62', '93', '06', '22', '804']),    
    ];
});