<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Commands\uploadBelumLengkap;
use App\Sms;

class sendSmsLengkapi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:lengkapi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ingatkan sms untuk lengkapi upload';

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
		$upload = new uploadBelumLengkap;
		$tolong_lengkapi = $upload->tolong_lengkapi();
		foreach ($tolong_lengkapi as $k=> $lengkap) {
			$text = 'Mengingatkan ';
			$text .= $lengkap['user']->panggilan . ' ';
			$text .= "sdh mengisi {$lengkap['jumlah_pembacaan']} pembacaan, tp msh ada {$lengkap['belum_diisi']} yg blm upload ke website. ";
			$text .= "Mohon agar dapat melengkapi demi kelancaran akreditasi.";
			$text .= " Tq.";
			foreach ($lengkap['user']->no_telps as $telp) {
				if ($telp->jenis_telpon_id == 2) {
					Sms::send($telp->no_telp, $text);
				}
			}
		}
    }
}
