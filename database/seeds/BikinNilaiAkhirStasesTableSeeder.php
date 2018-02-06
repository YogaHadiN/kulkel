<?php

use Illuminate\Database\Seeder;
use App\Stase;

class BikinNilaiAkhirStasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$stases = Stase::all();

		foreach ($stases as $stase) {
			$mulai = $stase->mulai;

			$bulan = $stase->jenisStase->bulan;

			$konversi_bulan = $bulan -1;

			$akhir =  date('Y-m-t', strtotime("+" . $konversi_bulan. " months", strtotime($mulai)));

			$stase->akhir = $akhir;
			$stase->save();
		}
    }
}
