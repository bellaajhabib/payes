<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permissions')->delete();

        /*Permission::create([
            'name' => 'moderate_projects',
            'display_name' => 'Moderate projects',
            'description' => 'Moderate projects description'
        ]);*/
    }

}
