<?php

use Illuminate\Database\Seeder;
use App\JenisStase;

class BulanColumnJenisStasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$query  = "Update jenis_stases set bulan = 3";
		$data = DB::statement($query);

		JenisStase::whereIn('id', [5,10,11])->update([
			'bulan' => 2
		]);
    }
}
