<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $admin = new User;
        $admin->name = "admin";
        $admin->email = "admin@store.local";
        $admin->password = bcrypt('secret');
        $admin->is_admin = true;
        $admin->save();


        $user = new User;
        $user->name = "user";
        $user->email = "user@store.local";
        $user->password = bcrypt('passwd');
        $user->is_admin = false;
        $user->save();
    }
}
