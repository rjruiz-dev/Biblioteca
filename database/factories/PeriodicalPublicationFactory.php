<?php

use Faker\Generator as Faker;

$factory->define(App\Periodical_publication::class, function (Faker $faker) {
    return [
        'books_id' => $faker->randomElement(['1','2']),
        'periodicities_id' => $faker->randomElement(['1','2']),     
        'volume_number_date'      => $faker->title,
        'issn'   => $faker->isbn10,        
    ];
});
