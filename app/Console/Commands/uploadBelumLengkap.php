<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class uploadBelumLengkap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:lengkapi';

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
		$residens = User::with('pembacaan')->whereIn('role_id', [1,3])->get();
		$belum_lengkap = [];
		foreach ($residens as $residen) {
			if (strpos(strtolower($residen->nama), 'dr') !== true) {
				$pembacaans = $residen->pembacaan;
				foreach ($pembacaans as $pembacaan) {
					if (is_null($pembacaan->link_materi) || is_null($pembacaan->link_materi_terjemahan)) {
						$belum_lengkap[$pembacaan->user_id]['jumlah_pembacaan'] = $pembacaans->count();
						if (!isset($belum_lengkap[$pembacaan->user_id]['belum_diisi'])) {
							$belum_lengkap[$pembacaan->user_id]['belum_diisi'] = 1;
						} else {
							$belum_lengkap[$pembacaan->user_id]['belum_diisi']++;
						}
						$belum_lengkap[$pembacaan->user_id]['jumlah_pembacaan'] = $pembacaans->count();
						$belum_lengkap[$pembacaan->user_id]['user'] = $residen;
					}
				}
			}
		}

		$tolong_lengkapi = [];

		foreach ($belum_lengkap as $belum) {
			if ($belum['jumlah_pembacaan'] < 6 && $belum['belum_diisi'] > 0) {
				$tolong_lengkapi[] = $belum_lengkap;
			}
		}

		$belum_sama_sekali  = [];

		foreach ($residens as $residen) {
			if ($residen->pembacaan->count() < 1) {
				$belum_sama_sekali[] = $residen;
			}
		}

		dd($belum_sama_sekali);
    }
}
