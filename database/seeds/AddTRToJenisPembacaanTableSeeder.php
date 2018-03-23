<?php

use Illuminate\Database\Seeder;
use App\JenisPembacaan;

class AddTRToJenisPembacaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$jenis = new JenisPembacaan;
		$jenis->jenis_pembacaan = 'TR';
		$jenis->save();
    }
}
