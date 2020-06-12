<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'status_id' => factory(App\Statu::class)->create()->id,
        'name'      => $faker->name,
        'surname'   => $faker->lastName,
        'nickname'  => $faker->userName,
        'gender'    => $faker->randomElement(['Femenino', 'Masculino']),
        'address'   => $faker->secondaryAddress,
        'postcode'  => $faker->postcode,
        'phone'     => $faker->e164PhoneNumber, 
        'user_photo'=> $faker->imageUrl($width = 150, $heigth = 150), 
        'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'), 
        'email'     => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10),
    ];
});
