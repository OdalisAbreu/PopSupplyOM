<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        		'name' =>'Odalis',
        		'email' => 'odalisdabreu@gmail.com',
        		'password' => bcrypt('123456'),
                'admin' => true,
                'remember_token' => str_random(10)
        	]);
    }
}
