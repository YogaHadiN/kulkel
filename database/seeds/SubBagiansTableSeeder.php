<?php

use Illuminate\Database\Seeder;
use App\SubBagian;

class SubBagiansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		SubBagian::truncate();
		$data = [
			[
				'user_id'           => 28,
				'jenis_stase_id'    => 1,
				'jenis_penguji_id'  => 4
			],
			[
				'user_id'           => 31,
				'jenis_stase_id'    => 1,
				'jenis_penguji_id'  => 2
			],
			[
				'user_id'           => 81,
				'jenis_stase_id'    => 1,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 38,
				'jenis_stase_id'    => 1,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 39,
				'jenis_stase_id'    => 4,
				'jenis_penguji_id'  => 4
			],
			[
				'user_id'           => 83,
				'jenis_stase_id'    => 4,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 75,
				'jenis_stase_id'    => 4,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 31,
				'jenis_stase_id'    => 4,
				'jenis_penguji_id'  => 3
			],
			[
				'user_id'           => 35,
				'jenis_stase_id'    => 9,
				'jenis_penguji_id'  => 4
			],
			[
				'user_id'           => 32,
				'jenis_stase_id'    => 9,
				'jenis_penguji_id'  => 2
			],
			[
				'user_id'           => 79,
				'jenis_stase_id'    => 9,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 84,
				'jenis_stase_id'    => 9,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 39,
				'jenis_stase_id'    => 9,
				'jenis_penguji_id'  => 3
			],
			[
				'user_id'           => 32,
				'jenis_stase_id'    => 6,
				'jenis_penguji_id'  => 4
			],
			[
				'user_id'           => 28,
				'jenis_stase_id'    => 6,
				'jenis_penguji_id'  => 2
			],
			[
				'user_id'           => 38,
				'jenis_stase_id'    => 6,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 39,
				'jenis_stase_id'    => 5,
				'jenis_penguji_id'  => 4
			],
			[
				'user_id'           => 41,
				'jenis_stase_id'    => 5,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 85,
				'jenis_stase_id'    => 5,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 75,
				'jenis_stase_id'    => 5,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 31,
				'jenis_stase_id'    => 5,
				'jenis_penguji_id'  => 3
			],
			[
				'user_id'           => 35,
				'jenis_stase_id'    => 3,
				'jenis_penguji_id'  => 4
			],
			[
				'user_id'           => 42,
				'jenis_stase_id'    => 3,
				'jenis_penguji_id'  => 2
			],
			[
				'user_id'           => 59,
				'jenis_stase_id'    => 3,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 38,
				'jenis_stase_id'    => 3,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 33,
				'jenis_stase_id'    => 3,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 32,
				'jenis_stase_id'    => 3,
				'jenis_penguji_id'  => 3
			],
			[
				'user_id'           => 42,
				'jenis_stase_id'    => 2,
				'jenis_penguji_id'  => 4
			],
			[
				'user_id'           => 31,
				'jenis_stase_id'    => 2,
				'jenis_penguji_id'  => 2
			],
			[
				'user_id'           => 32,
				'jenis_stase_id'    => 2,
				'jenis_penguji_id'  => 2
			],
			[
				'user_id'           => 56,
				'jenis_stase_id'    => 2,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 32,
				'jenis_stase_id'    => 10,
				'jenis_penguji_id'  => 4
			],
			[
				'user_id'           => 37,
				'jenis_stase_id'    => 10,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 48,
				'jenis_stase_id'    => 10,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 31,
				'jenis_stase_id'    => 11,
				'jenis_penguji_id'  => 4
			],
			[
				'user_id'           => 42,
				'jenis_stase_id'    => 11,
				'jenis_penguji_id'  => 2
			],
			[
				'user_id'           => 75,
				'jenis_stase_id'    => 11,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 41,
				'jenis_stase_id'    => 8,
				'jenis_penguji_id'  => 4
			],
			[
				'user_id'           => 32,
				'jenis_stase_id'    => 8,
				'jenis_penguji_id'  => 4
			],
			[
				'user_id'           => 37,
				'jenis_stase_id'    => 8,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 30,
				'jenis_stase_id'    => 8,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 39,
				'jenis_stase_id'    => 8,
				'jenis_penguji_id'  => 3
			],
			[
				'user_id'           => 41,
				'jenis_stase_id'    => 7,
				'jenis_penguji_id'  => 4
			],
			[
				'user_id'           => 31,
				'jenis_stase_id'    => 7,
				'jenis_penguji_id'  => 2
			],
			[
				'user_id'           => 28,
				'jenis_stase_id'    => 7,
				'jenis_penguji_id'  => 2
			],
			[
				'user_id'           => 35,
				'jenis_stase_id'    => 7,
				'jenis_penguji_id'  => 1
			],
			[
				'user_id'           => 40,
				'jenis_stase_id'    => 7,
				'jenis_penguji_id'  => 1
			]
		];

		SubBagian::insert($data);
/* |  1 | Dermatologi Umum        | */
/* |  2 | Kosmetik Medik          | *
jenis_penguji_id/* |  3 | Morbus Hansen           | */
/* |  4 | Alergi Imunologi        | */
/* |  5 | Dermatologi Anak        | */
/* |  6 | Infeksi Menular Seksual | */
/* |  7 | Kegawatdaruratan Kulit  | */
/* |  8 | Dermatologi Intervensi  | */
/* |  9 | Mikologi                | */
/* | 10 | Patologi Anatomi        | */
/* | 11 | Tumor                   | */

/* | 28 | Dr. Asih Budiastuti, Sp.KK (K), FINSDV, FAADV              | */
/* | 29 | Dr. Aria Hendra, Sp. KK                                    | */
/* | 30 | Dr. Buwono Puruhito, Sp.KK, FINSDV                         | */
/* | 31 | Dr. Diah Andriani Malik, Sp.KK (K), FINSDV, FAADV          | */
/* | 32 | DR. Dr. Puguh Riyanto (K), Sp.KK, FINSDV, FAADV            | */
/* | 33 | DR. Dr. Renni Yuniati, Sp.KK, FINSDV                       | */
/* | 34 | Dr. Galih Sari Damayanti, Sp.KK                            | */
/* | 35 | Dr. Holy Ametati, Sp.KK                                    | */
/* | 36 | Dr. Liza Afriliana, Sp.KK                                  | */
/* | 37 | Dr. Muslimin, Sp.KK, FINSDV                                | */
/* | 38 | Dr. Radityastuti, Sp.KK                                    | */
/* | 39 | Dr. Retno Indar Widayati, Msi, Sp.KK (K), FINSDV, FAADV    | */
/* | 40 | Dr. Widyastuti, Sp.KK                                      | */
/* | 41 | Dr. Y. F. Rahmat Sugianto, Sp.KK                           | */
/* | 42 | Prof. DR. Dr. Prasetyowati S, Sp.KK (K), FINSDV, FAADV     | */
/* | 48 | Dr. Soejoto, SpKK(K)                                       | */
/* | 49 | Dr. Meilien Himbawani, SpKK(K)                             | */
/* | 56 | dr. Dhiana Ernawati, Sp.KK(K), FINSDV, FAADV               | */
/* | 59 | dr R. Sri Djoko Susanto, Sp.KK(K), FINSDV, FAADV           | */
/* | 62 | dr. Susanto Buditjahjono, Sp.KK(K), FAADV                  | */
/* | 74 | dr. Novi Kusumaningrum, SpKK                               | */
/* | 75 | dr. Widyawati, SpKK                                        | */
/* | 79 | dr Subakir, SpKK                                           | */
/* | 80 | dr. Paulus Yogyartono, SpKK (K)                            | */
/* | 81 | dr. E.S. Indrayanti, SpKK (K), FINSDV, FAADV               | */
/* | 82 | dr. Lewie Suryaatmadja, SpKK (K),FINSDV, FAADV             | */
/* | 83 | dr. Irma Binarso, SpKK (K), MARS, FINSDV, FAADV            | */
/* | 84 | dr. T. M. Sri Redjeki S, SpKK (K), M.Si.Med, FINSDV, FAADV | */
/* | 85 | dr. Sugastiasri S, SpKK (K), FINSDV                        | */
/* +----+------------------------------------------------------------+ */
    }
}
