<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class RoleTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        $superAdminRole = Role::create([
            'name'          => 'superadmin',
            'display_name'  => 'Super-administrateur',
        ]);

        Role::create([
            'name'          => 'admin',
            'display_name'  => 'Administrateur',
            'description'   => 'Un administrateur a accès à toutes les fonctionnalités de l’interface d’administration'
        ]);

        Role::create([
            'name'          => 'user',
            'display_name'  => 'Utilisateur',
            'description'   => 'Il s’agit d’un utilisateur régulier du site et ne dispose pas des droits pour accéder à l’interface d’administration'
        ]);

        $user = User::where('email','=','admin@box.agency')->first();
        $user->assignRole( $superAdminRole );

    }

}
