<?php

use Illuminate\Database\Seeder;
use App\User;

class PanggilanUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		$data = [
		  '1' => 'Pak Yoga',
		  '3' => 'Pak Beni',
		  '4' => 'Pak Arinal',
		  '5' => 'Bu Clarissa',
		  '6' => 'Bu Adel',
		  '7' => 'Bu Rinda',
		  '8' => 'Bu Carissa',
		  '9' => 'Pak Teguh',
		 '10' => 'Bu Maria',
		 '11' => 'Bu Aya',
		 '12' => 'Bu Rizcky',
		 '13' => 'Bu Tami',
		 '14' => 'Bu Dhesi',
		 '15' => 'Bu Amel',
		 '16' => 'Bu Intan',
		 '17' => 'Bu Zidny',
		 '18' => 'Bu Widya',
		 '19' => 'Bu Eunice',
		 '20' => 'Bu Meiza',
		 '21' => 'Bu Hayra',
		 '22' => 'Bu Elon',
		 '23' => 'Pak Irvin',
		 '24' => 'Bu Ayu',
		 '25' => 'Bu Lydia',
		 '26' => 'Pak Yudha',
		 '28' => 'Dr. Asih',
		 '29' => 'Dr. Aria',
		 '30' => 'Dr. Buwono',
		 '31' => 'Dr. Diah',
		 '32' => 'DR. Dr. Puguh',
		 '33' => 'DR. Dr. Renni',
		 '34' => 'Dr. Galih',
		 '35' => 'Dr. Holy',
		 '36' => 'Dr. Liza',
		 '37' => 'Dr. Muslimin',
		 '38' => 'Dr. Radit',
		 '39' => 'Dr. Retno',
		 '40' => 'Dr. Widyastuti',
		 '41' => 'Dr. Y. F. Rahmat',
		 '42' => 'Prof. DR. Dr. Pras',
		 '43' => 'Tamara',
		 '44' => 'Bu Lita',
		 '45' => 'Pak Syamsul',
		 '46' => 'Bu Indri',
		 '48' => 'Dr. Soejoto',
		 '49' => 'Dr. Meilien',
		 '50' => 'Bu Frista',
		 '51' => 'Bu Erien',
		 '52' => 'Bu Maya',
		 '53' => 'Bu Milka',
		 '55' => 'Bu Suci ',
		 '56' => 'dr. Dhiana',
		 '57' => 'Bu Inggrid',
		 '58' => 'Bu Arin',
		 '59' => 'Dr. Djoko',
		 '60' => 'Bu Nadya',
		 '61' => 'Bu Raras',
		 '62' => 'dr. Buditjahjono',
		 '63' => 'Pak Raymond',
		 '64' => 'Bu Siwi',
		 '65' => 'Bu Ika',
		 '66' => 'Bu Dwi',
		 '67' => 'Bu Pipit',
		 '68' => 'Bu Heny',
		 '69' => 'Bu Milany',
		 '70' => 'Pak Indro',
		 '71' => 'Bu Seca',
		 '72' => 'Bu Meira',
		 '74' => 'dr. Novi',
		 '75' => 'dr. Widyawati',
		 '79' => 'dr Subakir',
		 '80' => 'dr. Paulus',
		 '81' => 'dr. Indrayanti',
		 '82' => 'dr. Lewie',
		 '83' => 'dr. Irma',
		 '84' => 'dr. T. M. Sri Redjeki',
		 '85' => 'dr. Sugas',
	 ];
		foreach ($data as $k => $d) {
			$user            = User::find($k);
			$user->panggilan = $d;
			$user->save();
		}
   }
}
