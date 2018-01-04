<?php

use Illuminate\Database\Seeder;
use App\JenisPembacaan;

class JenisPembacaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$timestamp = date('Y-m-d H:i:s');
		
		$pbc[] = [
			'jenis_pembacaan' => 'JR',
			'created_at' => $timestamp,
			'updated_at' => $timestamp
		];
		$pbc[] = [
			'jenis_pembacaan' => 'LK',
			'created_at' => $timestamp,
			'updated_at' => $timestamp
		];
		$pbc[] = [
			'jenis_pembacaan' => 'TP',
			'created_at' => $timestamp,
			'updated_at' => $timestamp
		];
		$pbc[] = [
			'jenis_pembacaan' => 'Publi',
			'created_at' => $timestamp,
			'updated_at' => $timestamp
		];

		JenisPembacaan::insert($pbc);
    }
}
