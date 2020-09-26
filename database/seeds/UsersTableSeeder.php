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
        $viewMoviesPermission   = Permission::create([
            'name' => 'View movies',
            // 'display_name' => 'Ver Ordenes'
        ]);
        $createMoviesPermission = Permission::create([            
            'name' => 'Create movies',
            // 'display_name' => 'Crear Ordenes'
        ]);
        $updateMoviesPermission = Permission::create([
            'name' => 'Update movies',
            // 'display_name' => 'Actualizar Ordenes'
        ]);
        $deleteMoviesPermission = Permission::create([            
            'name' => 'Delete movies',
            // 'display_name' => 'Eliminar Ordenes'
        ]);
        $copyMoviesPermission = Permission::create([
            'name' => 'Copy',
            // 'display_name' => 'Ver boton de prestamo'
        ]);
        $statusMoviesPermission = Permission::create([
            'name' => 'Status',
            // 'display_name' => 'Ver boton de prestamo'
        ]);
        $desidherataMoviesPermission = Permission::create([
            'name' => 'Desidherata',
            // 'display_name' => 'Ver boton de prestamo'
        ]);
        $downloadMoviesLoanButtonPermission = Permission::create([
            'name' => 'Download',
            // 'display_name' => 'Ver boton de prestamo'
        ]);


        // Create users
        $admin = new User;
        $admin->name = 'Gonzalo';
        $admin->surname = 'Nadal';
        $admin->nickname = 'GB_Admin';
        $admin->membership = 1;
        $admin->email = 'admin@gmail.com';        
        $admin->password = '123456';   
        $admin->birthdate = '2020-09-25';   
        $admin->status_id = 3;
        $admin->save();

        $admin->assignRole($adminRole);
        $admin->givePermissionTo([$viewMoviesPermission,$createMoviesPermission,
                                    $updateMoviesPermission,$deleteMoviesPermission, 
                                    $copyMoviesPermission, $statusMoviesPermission,
                                    $desidherataMoviesPermission, $downloadMoviesLoanButtonPermission
                                ]);
        
        $librarian = new User;
        $librarian->name = 'Luis';
        $librarian->surname = 'Gomes';
        $librarian->nickname = 'lucho';
        $librarian->membership = 2;
        $librarian->email = 'luis@gmail.com';       
        $librarian->password = '123456';
        $librarian->birthdate = '2020-09-25';      
        $librarian->status_id = 3; 
        $librarian->save();

        $librarian->assignRole($librarianRole);

        $partner = new User;
        $partner->name = 'Jorge';
        $partner->surname = 'Perez';
        $partner->nickname = 'jorge_12';
        $partner->membership = 3;
        $partner->email = 'jorge@gmail.com';        
        $partner->password = '123456'; 
        $partner->birthdate = '2020-09-25';      
        $partner->status_id = 3;
        $partner->save();

        $partner->assignRole($partnerRole);

       
    }
}
