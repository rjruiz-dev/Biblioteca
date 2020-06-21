<?php

use Faker\Generator as Faker;

$factory->define(App\Lenguage::class, function (Faker $faker) {
    return [        
        'leguage_description'  => $faker->randomElement(['Frances', 'Ingles', 'Español', 'Aleman', 'Italiano', 'Portuges']),    
    ];
});
