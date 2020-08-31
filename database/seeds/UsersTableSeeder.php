<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        // factory(App\User::class, 10)->create();

        App\User::create([
            'name'      => 'Gonzalo',
            'surname'   => 'Nadal',
            'nickname'  => 'GB_Admin',
            'email'     => 'admin@gmail.com',
            'password'  => '123456',
            'membership' => '23.456.567',
            'status_id' => 1

        ]);
    }
}
