<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Perpus;
use App\JenisStase;
use App\Stase;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		$users = User::all();
		$jenisStases = JenisStase::all();
		foreach ($users as $user) {
			foreach ($jenisStases as $jenisStase) {
				try {
					$mulai = Stase::where('user_id', $user->id)
									->where('jenis_stase_id', $jenisStase->id)
									->orderBy('mulai')
									->first()->mulai;
					$akhir = Stase::where('user_id', $user->id)
									->where('jenis_stase_id', $jenisStase->id)
									->orderBy('mulai', 'desc')
									->first()->mulai;
					$result[$user->id][$jenisStase->id] = [
						'user_id' => $user->id,
						'jenis_stase_id' => $jenisStase->id,
						'mulai' =>  $mulai,
						'akhir' =>  $akhir
					];
				} catch (\Exception $e) {
					
				}
			}
		}
		return dd( $result );
    }
}
