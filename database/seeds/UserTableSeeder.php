<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class,4)->create();
        factory(App\User::class)->create([
        	'user'=>'Monserrat',
        	'email'=>'monserrat@gmail.com',
        	'password'=>'pass',
        	'role'=>'admin']);
    }
}
