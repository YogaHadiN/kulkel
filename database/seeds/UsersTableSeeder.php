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
		$users[] = [
			'name' => 'Yoga Hadi Nugroho',
			'email' => 'yoga_email@yahoo.com',
			'password' => bcrypt('123456'),
			'password' => bcrypt('123456'),
		];
		User::insert($users);
    }
}
