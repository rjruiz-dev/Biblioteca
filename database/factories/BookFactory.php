<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'documents_id' => $faker->randomElement(['1','2']),
        'generate_books_id' => $faker->randomElement(['1','2']),     
        'subtitle'      => $faker->title,
        'second_author_id' => $faker->randomElement(['1','2']),     
        'third_author_id' => $faker->randomElement(['1','2']),     
        'translator'  => $faker->name,
        'edition'    => $faker->company,
        'size'      => $faker->name,
        'isbn'    => $faker->isbn10,
    ];
});
