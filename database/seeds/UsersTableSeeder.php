<?php

use Illuminate\Database\Seeder;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        // factory(App\User::class, 3)->create();
        // App\User::create([
        //     'name'      => 'Gonzalo',
        //     'surname'   => 'Nadal',
        //     'nickname'  => 'GB_Admin',
        //     'email'     => 'admin@gmail.com',
        //     'password'  => '123456',
        //     'membership' => '23.456.567',
        //     'status_id' => 1

        // ]);

        // Create roles
        $adminRole = Role::create(['name' => 'Admin']);
        $librarianRole = Role::create(['name' => 'Librarian']);
        $partnerRole = Role::create(['name' => 'Partner']);

        // $adminRole = Role::create(['name' => 'Admin', 'display_name' => 'Administrador']);
        // $librarianRole = Role::create(['name' => 'Librarian', 'display_name' => 'Bibliotecario']);
        // $partnerRole = Role::create(['name' => 'Partner', 'display_name' => 'Socio']);

        // Create permissions
        $viewsLoanButtonPermission  = Permission::create([
            'name' => 'View loanbutton',
            // 'display_name' => 'Ver boton de prestamo'
        ]);
       

        // create users
        $admin = new User;
        $admin->name = 'Gonzalo';
        $admin->surname = 'Nadal';
        $admin->nickname = 'GB_Admin';
        $admin->membership = '23.456.567';
        $admin->email = 'rjruizsf@gmail.com';        
        $admin->password = '123456';    
        $admin->status_id = 1;
        $admin->save();

        $admin->assignRole($adminRole);
        
        $librarian = new User;
        $librarian->name = 'Luis';
        $librarian->surname = 'Gomes';
        $librarian->nickname = 'lucho';
        $librarian->membership = '23.456.467';
        $librarian->email = 'luis@gmail.com';       
        $librarian->password = '123456';   
        $librarian->status_id = 1; 
        $librarian->save();

        $librarian->assignRole($librarianRole);

        $partner = new User;
        $partner->name = 'Jorge';
        $partner->surname = 'Perez';
        $partner->nickname = 'jorge_12';
        $partner->membership = '23.456.967';
        $partner->email = 'jorge@gmail.com';        
        $partner->password = '123456';    
        $partner->status_id = 1;
        $partner->save();

        $partner->assignRole($partnerRole);

       
    }
}
