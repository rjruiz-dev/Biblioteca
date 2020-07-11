<?php

use Faker\Generator as Faker;

$factory->define(App\Multimedia::class, function (Faker $faker) {
    return [
         // 'documents_id' => $faker->randomElement(['1','2']),
         'documents_id'     => factory(App\Document::class)->create()->id,      
        //  'author'   => $faker->name,
         'subtitle'  => $faker->name,
         'second_author'  => $faker->name,
         'third_author'  => $faker->name,
         'isbn'  => $faker->name,
        //  'gender'  => $faker->name,
         'edition'  => $faker->name,
         'size'  => $faker->name,
    ];
});
