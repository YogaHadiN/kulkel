<?php

use Illuminate\Database\Seeder;
use App\Stase;

class UpdateAkhirMonthToTanggalAkhirInStasesTableSeeder extends Seeder
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
			$stase->akhir = date('Y-m-t H:i:s', strtotime( $stase->akhir ));
			$stase->save();
		}
    }
}
