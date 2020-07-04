<?php

use Faker\Generator as Faker;

$factory->define(App\Formats::class, function (Faker $faker) {
    return [
        'format_name' => $faker->randomElement(['16mm','35mm','betta','casete','CD','dvd','Laser Disc']),
    ];
});
