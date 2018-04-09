<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;
use App\Poli;
use App\Pembacaan;
use App\User;
use App\Rsnd;
use App\Yoga;
use App\Gardenia;
use Auth;

class smsBulanan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:smsBulanan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.Us
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
		dd($this->formatSms(User::find(1), date('Y-m')));
    }
	private function formatSms($user, $this_month ){
		$polis      = Poli::where('user_id', $user->id)->where('tanggal', 'like', $this_month . '%')->get();
		$rsnds      = Rsnd::where('user_id', $user->id)->where('tanggal', 'like', $this_month . '%')->get();
		$gardenias  = Gardenia::where('user_id', $user->id)->where('tanggal', 'like', $this_month . '%')->get();
		$pembacaans = Pembacaan::with('moderator.user')->where('user_id', $user->id)->where('tanggal', 'like', $this_month . '%')->get();
		$jabay = [];
		$jagut = [];
		$jagem = [];
		$jatul = [];
		foreach ($polis as $poli) {
			if ($poli->jaga_id == 4) {
				$jabay[] = $poli;
			} elseif ($poli->jaga_id == 3){
				$jagut[] = $poli;
			} elseif ($poli->jaga_id == 2){
				$jagem[] = $poli;
			} elseif ($poli->jaga_id == 1){
				$jatul[] = $poli;
			}
		}
		$text = 'Selamat sore ' . $user->panggilan . ', maaf mengganggu, mau memberitahukan';
		/* $text .=  '<br />'; */
		$text .= PHP_EOL;
		$text .= 'Jadwal PBC bulan ' . Yoga::bulanIndonesia( date('m', strtotime($this_month. '-01')) ) . ': ';
		if ( $pembacaans->count() < 1 ) {
			$text .=  ' tidak ada PBC';
		} else if ($pembacaans->count() < 2){
			$text .=  'hr ' . Yoga::hariIndonesia($pembacaans[0]->tanggal->format('N'));
			$text .=  '/ tgl ' . $pembacaans[0]->tanggal->format('d');
			$text .=  ', mod: ' . $pembacaans[0]->moderator[0]->user->panggilan;
		} else {
			$text .=  '<br />';
			foreach ($pembacaans as $pembacaan) {
				$text .=  'hr ' . Yoga::hariIndonesia($pembacaan->tanggal->format('N'));
				$text .=  '/ tgl ' . $pembacaan->tanggal->format('d');
				$text .=  ', mod: ' . $pembacaan->moderator->panggilan;
				$text .= PHP_EOL;
			}
		}
		$text .= PHP_EOL;
		$text .= 'Jadwal jaga:';
		if ( $polis->count() < 1 ) {
			$text .=  ' tidak ada';
		} else{
			$text .= PHP_EOL;
			if (count($jabay)) {
				$text .= 'Jabay: ';
				if( count($jabay) < 2 ){
					$text .=  'hr ' . Yoga::hariIndonesia($jabar[0]->tanggal->format('N'));
					$text .= '/ tgl ' .$jabay[0]->tanggal->format('d');
					$text .= PHP_EOL;
				} else {
					$text .= PHP_EOL;
					foreach ($jabay as $jby) {
						$text .=  'hr ' . Yoga::hariIndonesia($jabar[0]->tanggal->format('N'));
						$text .= '/ tgl ' .$jby->tanggal->format('d');
						$text .= PHP_EOL;
					}
				}
			}
			if (count($jagem)) {
				$text .= 'Jagem: ';
				if( count($jagem) < 2 ){
					$text .=  'hr ' . Yoga::hariIndonesia($jagem[0]->tanggal->format('N'));
					$text .= '/ tgl ' .$jagem[0]->tanggal->format('d');
					$text .= PHP_EOL;
				} else {
					$text .= PHP_EOL;
					foreach ($jagem as $jby) {
						$text .=  'hr ' . Yoga::hariIndonesia($jagem[0]->tanggal->format('N'));
						$text .= '/ tgl ' .$jby->tanggal->format('d');
						$text .= PHP_EOL;
					}
				}
			}
			if (count($jagut)) {
				$text .= 'Jagut: ';
				if( count($jagut) < 2 ){
					$text .=  'hr ' . Yoga::hariIndonesia($jagut[0]->tanggal->format('N'));
					$text .= '/ tgl ' .$jagut[0]->tanggal->format('d');
						$text .= PHP_EOL;
				} else {
					$text .= PHP_EOL;
					foreach ($jagut as $jby) {
						$text .=  'hr ' . Yoga::hariIndonesia($jby->tanggal->format('N'));
						$text .= '/ tgl ' .$jby->tanggal->format('d');
						$text .= PHP_EOL;
					}
				}
			}
			if (count($jatul)) {
				$text .= 'Jatul: ';
				if( count($jatul) < 2 ){
					$text .=  'hr ' . Yoga::hariIndonesia($jby->tanggal->format('N'));
					$text .= '/ tgl ' .$jatul[0]->tanggal->format('d');
					$text .= PHP_EOL;
				} else {
					$text .= PHP_EOL;
					foreach ($jatul as $jby) {
						$text .=  'hr ' . Yoga::hariIndonesia($jby->tanggal->format('N'));
						$text .= '/ tgl ' .$jby->tanggal->format('d');
						$text .= PHP_EOL;
					}
				}
			}
		}
		$text .= 'Jadwal RSND: ';
		if (count($rsnds)) {
			if (count($rsnds) < 2) {
					$text .=  'hr ' . Yoga::hariIndonesia($rsnds[0]->tanggal->format('N'));
					$text .= '/ tgl ' .$rsnds[0]->tanggal->format('d');
					$text .= PHP_EOL;
			} else {
				$text .= PHP_EOL;
				foreach ($rsnds as $rsnd) {
					$text .=  'hr ' . Yoga::hariIndonesia($rsnd->tanggal->format('N'));
					$text .= '/ tgl ' .$rsnd->tanggal->format('d');
					$text .= PHP_EOL;
				}
			}
		} else {
			$text .= 'tidak ada';
		}
		$text .= PHP_EOL;
		$text .= 'Jadwal Garuda: ';
		if (count($gardenias)) {
			if (count($rnsds) < 2) {
					$text .= 'hr ' . Yoga::hariIndonesia($gardenias[0]->tanggal->format('N')) . '/';
					$text .= '/ tgl ' .$gardenias[0]->tanggal->format('d');
			} else {
				foreach ($gardenias as $gardenia) {
					$text .= PHP_EOL;
					$text .= 'hr ' . Yoga::hariIndonesia($gardenia->tanggal->format('N')) . '/';
					$text .= '/ tgl ' .$gardenia->tanggal->format('d');
				}
			}
		} else {
			$text .= 'tidak ada';
		}
		$text .= '. Tq.';
		return $text;
	}




}
