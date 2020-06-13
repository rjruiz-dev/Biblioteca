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
        factory(App\User::class, 10)->create();

        App\User::create([
            'name'      => 'Gonzalo',
            'surname'   => 'Nadal',
            'nickname'  => 'GB_Admin',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('123456'),
            'status_id' => factory(App\Statu::class)->create()->id,

        ]);
    }
}
