<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [        
        'course_name'   => $faker->randomElement(['1° Bachillerato', '1° BUP', '1° ESO', '2° Bachillerato', '2° BUP', '2° ESO']),    
        'group'         => $faker->randomElement(['Si', 'No']),    
    ];
});
