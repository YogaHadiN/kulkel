<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$timestamp = date('Y-m-d H:i:s');
		$roles[] = [
			'role' => 'residen',
			'created_at' => $timestamp,
			'updated_at' => $timestamp
		];
		$roles[] = [
			'role' => 'dosen',
			'created_at' => $timestamp,
			'updated_at' => $timestamp
		];
		$roles[] = [
			'role' => 'admin',
			'created_at' => $timestamp,
			'updated_at' => $timestamp
		];

		Role::insert($roles);
    }
}
