<?php

use Illuminate\Database\Seeder;
use App\JenisPenguji;

class JenisPengujiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		JenisPenguji::truncate();
		$timestamp = date('Y-m-d H:i:s');
		$data = [
			[
				'jenis_penguji' => 'Bukan Penguji',
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			],
			[
				'jenis_penguji' => 'Penguji',
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			],
			[
				'jenis_penguji' => 'Penguji Tambahan',
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			],
			[
				'jenis_penguji' => 'Ketua Sub Bagian',
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			]
		];
		JenisPenguji::insert($data);
    }
}
