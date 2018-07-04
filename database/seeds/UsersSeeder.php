<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => bcrypt('secret'),
            'role_id' => 1,
        ]);

        for ($i=0; $i < 13; $i++) { 
        	 User::insert([
	            'name' => str_random(10),
	            'email' => str_random(10).'@gmail.com',
	            'password' => bcrypt('secret'),
	        ]);
        }
    }
}
