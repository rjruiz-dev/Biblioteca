<?php

use Faker\Generator as Faker;

$factory->define(App\Generate_musics::class, function (Faker $faker) {
        return [        
            'genre_music'  => $faker->randomElement(['folclore', 'reguetton', 'Heavy Metal']),    
        ];
});
