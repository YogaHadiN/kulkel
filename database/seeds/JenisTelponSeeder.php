<?php

use Illuminate\Database\Seeder;
use App\JenisTelpon;

class JenisTelponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$timestamp = date('Y-m-d H:i:s');
		$jenis_telpons[] = [
			'jenis_telpon' => 'rumah',
			'created_at' => $timestamp,
			'updated_at' => $timestamp
		];
		$jenis_telpons[] = [
			'jenis_telpon' => 'handphone',
			'created_at' => $timestamp,
			'updated_at' => $timestamp
		];
		$jenis_telpons[] = [
			'jenis_telpon' => 'kantor',
			'created_at' => $timestamp,
			'updated_at' => $timestamp
		];
		JenisTelpon::insert($jenis_telpons);
    }
}
