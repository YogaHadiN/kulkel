<?php

use Illuminate\Database\Seeder;
use App\Jaga;

class JagasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$timestamp = date('Y-m-d H:i:s');
		$jagas[] = [
			'jaga' => 'jatul',
			'created_at' => $timestamp,
			'updated_at' => $timestamp
		];
		$jagas[] = [
			'jaga' => 'jagem',
			'created_at' => $timestamp,
			'updated_at' => $timestamp
		];
		$jagas[] = [
			'jaga' => 'jagut',
			'created_at' => $timestamp,
			'updated_at' => $timestamp
		];
		$jagas[] = [
			'jaga' => 'jabay',
			'created_at' => $timestamp,
			'updated_at' => $timestamp
		];

		Jaga::insert($jagas);


    }
}
