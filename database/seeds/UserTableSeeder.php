<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        User::create([
            'name' => 'Admin BOX',
            'email' => 'admin@box.agency',
            'password' => bcrypt('Q26zq6B8')
        ]);


    }

}
