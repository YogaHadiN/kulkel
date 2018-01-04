<?php

use Illuminate\Database\Seeder;
use App\Perpus;

class PerpusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$bukus = [];
		$timestamp = date('Y-m-d H:i:s');
		$bukus[] = [
			'nomor_buku' => 'DU 1',
			'nama_buku' => 'hutang',
			'pengarang' => 'yoga',
			'terbit' => '2002',
			'created_at' => $timestamp,
			'updated_at' => $timestamp
		];
		$bukus[] = [
			'nomor_buku' => 'DU 2',
			'nama_buku' => 'hutang1',
			'pengarang' => 'yoga12',
			'terbit' => '2002',
			'created_at' => $timestamp,
			'updated_at' => $timestamp
		];
		$bukus[] = [
			'nomor_buku' => 'DU 3',
			'nama_buku' => 'hutang13',
			'pengarang' => 'yoga123',
			'terbit' => '2002',
			'created_at' => $timestamp,
			'updated_at' => $timestamp
		];

		Perpus::insert($bukus);
    }
}
