<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            'name' => 'Admin',
        ]);
        Role::insert([
            'name' => 'User',
        ]);
        Role::insert([
            'name' => 'Manager',
        ]);
    }
}
