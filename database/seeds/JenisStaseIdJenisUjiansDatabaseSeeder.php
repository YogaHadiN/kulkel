<?php

use Illuminate\Database\Seeder;
use App\JenisUjian;

class JenisStaseIdJenisUjiansDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		JenisUjian::truncate();
		$timestamp = date('Y-m-d H:i:s');
		$data = [
			[
				'jenis_ujian'    => 'Dermatologi Umum teori',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 1
			],
			[
				'jenis_ujian'    => 'Dermatologi Umum kasus',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 1
			],
			[
				'jenis_ujian'    => 'Kosmetik Medik teori',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 2
			],
			[
				'jenis_ujian'    => 'Kosmetik Medik kasus',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 2
			],
			[
				'jenis_ujian'    => 'Morbus Hansen teori',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 3
			],
			[
				'jenis_ujian'    => 'Morbus Hansen kasus',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 3
			],
			[
				'jenis_ujian'    => 'Alergi Imunologi teori',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 4
			],
			[
				'jenis_ujian'    => 'Alergi Imunologi kasus',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 4
			],
			[
				'jenis_ujian'    => 'Dermatologi Anak teori',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 5
			],
			[
				'jenis_ujian'    => 'Dermatologi Anak kasus',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 5
			],
			[
				'jenis_ujian'    => 'Infeksi Menular Seksual teori',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 6
			],
			[
				'jenis_ujian'    => 'Infeksi Menular Seksual kasus',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 6
			],
			[
				'jenis_ujian'    => 'Kegawatdaruratan Kulit teori',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 7
			],
			[
				'jenis_ujian'    => 'Kegawatdaruratan Kulit kasus',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 7
			],
			[
				'jenis_ujian'    => 'Dermatologi Intervensi teori',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 8
			],
			[
				'jenis_ujian'    => 'Dermatologi Intervensi kasus',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 8
			],
			[
				'jenis_ujian'    => 'Mikologi teori',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 9
			],
			[
				'jenis_ujian'    => 'Mikologi kasus',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 9
			],
			[
				'jenis_ujian'    => 'Patologi Anatomi teori',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 10
			],
			[
				'jenis_ujian'    => 'Patologi Anatomi kasus',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 10
			],
			[
				'jenis_ujian'    => 'Tumor teori',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 11
			],
			[
				'jenis_ujian'    => 'Tumor kasus',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => 11
			],
			[
				'jenis_ujian'    => 'Prakualifikasi',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => null
			],
			[
				'jenis_ujian'    => 'Seminar Hasil',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => null
			],
			[
				'jenis_ujian'    => 'Kompre Teori',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => null
			],
			[
				'jenis_ujian'    => 'Kompre Kasus',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => null
			],
			[
				'jenis_ujian'    => 'Ujian Board',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => null
			],
			[
				'jenis_ujian'    => 'Tesis',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp,
				'jenis_stase_id' => null
			],
		];
		JenisUjian::insert($data);
    }
}
