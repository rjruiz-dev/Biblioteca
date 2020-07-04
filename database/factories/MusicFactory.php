<?php

use Faker\Generator as Faker;

$factory->define(App\Music::class, function (Faker $faker) {
    return [
        // 'documents_id' => $faker->randomElement(['1','2']),
        'documents_id'     => factory(App\Document::class)->create()->id, 
        'generate_musics_id' => $faker->randomElement(['1','2']),     
        'formats_id'      => $faker->randomElement(['1','2','3','4','5']),
        'sound'   => $faker->name,
        'producer'  => $faker->name,
    ]; 
});
