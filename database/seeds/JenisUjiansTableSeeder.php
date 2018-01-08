<?php

use Illuminate\Database\Seeder;
use App\JenisUjian;

class JenisUjiansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		JenisUjian::truncate();
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
			'Tumor',
			'Prakualifikasi',
			'Seminar Hasil',
			'Kompre Teori',
			'Kompre Kasus',
			'Ujian Board',
			'Tesis'
		];

		$jenis_stases = [];
		$timestamp    = date('Y-m-d H:i:s');
		foreach ($stases as $stase) {
			$jenis_stases[] = [
				'jenis_ujian' => $stase,
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		JenisUjian::insert($jenis_stases);
    }
}
