<?php

use Illuminate\Database\Seeder;

use App\Residen;
use App\Email;
use App\Alamat;
use App\NoTelp;
class ResidensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$residens[] = [
			'id'            => 1,
			'name'          => 'Yoga Hadi Nugroho',
			'tanggal_lahir' => '1983-07-19',
			'no_ktp'        => '3434234234234',
			'nim'           => '12341'
		];
		$no_telps [] = [
			'no_telp' => '081381912803',
			'telponable_type' => 'App\Residen',
			'telponable_id' => '1'
		];
		$emails [] = [
			'email' => 'yoga.dvjul16@gmail.com',
			'emailable_type' => 'App\Residen',
			'emailable_id' => '1'
		];
		$alamats [] = [
			'alamat' => 'Barusari',
			'alamatable_type' => 'App\Residen',
			'alamatable_id' => '1'
		];
		Residen::insert($residens);
		NoTelp::insert($no_telps);
		Email::insert($emails);
		Alamat::insert($alamats);
    }
}
