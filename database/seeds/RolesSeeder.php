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
            'name' => 'Admin1',
        ]);
        Role::insert([
            'name' => 'User1',
        ]);
        Role::insert([
            'name' => 'Manager1',
        ]);
    }
}
