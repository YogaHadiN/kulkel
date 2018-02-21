<?php

use Illuminate\Database\Seeder;
use App\User;

class updateElinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$user            = User::find(22);
		$user->panggilan = 'Bu Elin';
		$user->save();
    }
}
