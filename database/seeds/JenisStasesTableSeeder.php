<?php

use Illuminate\Database\Seeder;
use App\JenisStase;

class JenisStasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$stases = [
			'Dermatologi Umum',
			'Kosmetik Medik',
			'Morbus Hansen',
			'Alergi Imunologi',
			'Dermatologi Anak',
			'Infeksi Menular Seksual',
			'Kegawatdaruratan Kulit',
			'Dermatologi Intervensi',
			'Mikologi',
			'Patologi Anatomi',
			'Tumor'
		];

		$jenis_stases = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($stases as $stase) {
			$jenis_stases[] = [
				'jenis_stase' => $stase,
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		JenisStase::insert($jenis_stases);
    }
}
