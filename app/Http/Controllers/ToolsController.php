<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Auth;
use App\User;
use App\Poli;
use DB;
use App\Pembacaan;
use App\Yoga;
use App\Http\Controllers\UsersController;
use App\Console\Commands\smsBulanan;
use Mail;

class ToolsController extends Controller
{
	public function index(){
		return view('tools');
	}

	public function smsBulanan(){
		$thisMonth = Yoga::bulanTahun(Input::get('bulan'));
		$untuls = $this->untuls();
		$pegangans = [];

		$smsBulanan = new smsBulanan;

		$emailFormat = [];

		foreach ($untuls as $k => $untul) {
			$pesan = '';

			$pegangans[$untul->email][] = $untul;
			$pesan .= nl2br($smsBulanan->formatSms($untul, $thisMonth ));
			$pesan .= '<br />';
			$pesan .= '<br />';
			$emailFormat[$untul->email] = $pesan;

			foreach ($untul->residenPegangan as $pegangan) {
				$pegangans[$untul->email][] = $pegangan->residen;
				$pesan .= nl2br($smsBulanan->formatSms($pegangan->residen, $thisMonth ));
				$pesan .= '<br />';
				$pesan .= '<br />';
			}
			$emailFormat[$untul->email] = $pesan;
		}
		foreach ($emailFormat as $k => $v) {
			$data = [
				'email'       => $k,
				'bulan'       => Yoga::bulanIndonesia( date('m', strtotime($thisMonth. '-01')) ),
				'subject'     => 'SMS BULANAN',
				'bodyMessage' => $v
			];
			Mail::send('emails.smsBulanan', $data, function($message) use ($data){
				$message->from( 'admin@dvundip.com', 'Admin DV UNDIP' );
				$message->to($data['email']);
				$message->subject($data['subject']);
			});
		}
		$pesan = Yoga::suksesFlash('Pengiriman berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	public function smsHarian(){
		$tanggal    = Yoga::datePrep(Input::get('tanggal'));
		$user       = Auth::user();
		$pembacaans = [];

		/* return $tanggal; */

		$pembacaan = Pembacaan::where('tanggal', '>=', $tanggal . ' 00:00:00')
			->where('tanggal', '<=', $tanggal . ' 23:59:59')
			->orderBy('tanggal')
			->orderByRaw('(UNIX_TIMESTAMP(created_at) - UNIX_TIMESTAMP(updated_at)) asc')
			->get();


		$polis = Poli::where('tanggal', $tanggal)->get();

		$query  = "SELECT * ";
		$query .= "FROM gardenias as ga ";
		$query .= "join users as us on ga.user_id = us.id ";
		$query .= "where tanggal = '{$tanggal}' ";
		$query .= "order by us.bulan_masuk_ppds;";
		$gardenias = DB::select($query);


		$query  = "SELECT * ";
		$query .= "FROM rsnds as ga ";
		$query .= "join users as us on ga.user_id = us.id ";
		$query .= "where tanggal = '{$tanggal}' ";
		$query .= "order by us.bulan_masuk_ppds;";
		$rsnds = DB::select($query);

		foreach ($pembacaan as $pemb) {
			$pembacaans[$pemb->tanggal->format('Y-m-d H:i:s')][] = $pemb;
		}


		$text = $user->inisial . ': ' . Yoga::hariIndonesia(date('N', strtotime( $tanggal )));
		if (count($pembacaans)) {
			$text .= ' PBC';
			foreach ($pembacaans as $pembacaan) {
				$text .= ' ';
				$text .= 'j.' . $pembacaan[0]->tanggal->format('G');
				if ($pembacaan[0]->tanggal->format('i') != '00') {
					$text .= '.';
					$text .= $pembacaan[0]->tanggal->format('i');
				}
				$text .= ' ';
				if (count($pembacaan) < 2) {
					$inisial         = $pembacaan[0]->user->inisial;
					$jenis_pembacaan = $pembacaan[0]->jenisPembacaan->jenis_pembacaan;
					$judul           = $pembacaan[0]->judul;
					$moderator       = $pembacaan[0]->moderator[0]->user->panggilan;


					$text .= ' ';
					$text .= $inisial . ': ';
					$text .= $jenis_pembacaan . ': ';
					$text .= $judul ;
					$text .= ', mod: ' . $moderator;

				} else {
					foreach ($pembacaan as $k => $pemb) {
						$inisial         = $pemb->user->inisial;
						$jenis_pembacaan = $pemb->jenisPembacaan->jenis_pembacaan;
						$judul           = $pemb->judul;
						$moderator       = $pemb->moderator[0]->user->panggilan;


						$text .= $k + 1 . ') ';
						$text .= $inisial . ': ';
						$text .= $jenis_pembacaan . ': ';
						$text .= $judul . ' ' ;
					}
					$text .= ', mod: ' . $moderator;
				}
			}
		} else {
			$text .= ', tidak ada PBC';
		}
		$text .= '.';
		$text .= PHP_EOL;
		$text .= "Poli: ";
		if ( $polis->count() ) {
			foreach ($polis as $poli) {
				if ($poli->jaga_id == 1) {
					$text .= $poli->user->inisial;
					$text .= ', ';
				}
			}
			foreach ($polis as $poli) {
				if ($poli->jaga_id == 2) {
					$text .= $poli->user->inisial;
					$text .= ', ';
				}
			}
			foreach ($polis as $poli) {
				if ($poli->jaga_id == 4) {
					$text .= $poli->user->inisial;
					$text .= ', ';
				}
			}
			foreach ($polis as $poli) {
				if ($poli->jaga_id == 3) {
					$text .= $poli->user->inisial;
					$text .= ', ';
				}
			}
		} else {
			$text .= ' Tidak ada.';
		}
		$text .= PHP_EOL;
		$text .= 'Poli Kosme: ';
		if (count($gardenias)) {
			foreach ($gardenias as $k=> $gardenia) {
				if ($k > 0) {
					$text .= ', ';
				}
				$text .= $gardenia->inisial;
			}
		} else {
			$text .= ' Tidak ada.';
		}
		$text .= ',';
		$text .= PHP_EOL;
		$text .= 'Poli RSND: ';
		if (count($rsnds)) {
			foreach ($rsnds as $k=> $rsnd) {
				if ($k > 0) {
					$text .= ', ';
				}
				$text .= $rsnd->inisial;
			}
		} else {
			$text .= ' Tidak ada.';
		}
		$text .= '. Tq.';

		return nl2br($text);
		
		/* Jaga RSND: IG. Tq. */
		
	}
	public function EmailTundaanUjian(){
		$users          = User::whereIn('role_id', [1,3] )->get(); //1 = residen , 3 = admin
		$tundaan_ujians = [];
		$UserCont       = new UsersController;
		foreach ($users as $user) {
			$tundaan_ujians[$user->id]['jenis_ujian'] = $UserCont->tundaan_ujian($user->id);
			$tundaan_ujians[$user->id]['user']        = $user;
		}
		$belum_ujians = [];
		$test = [];
		foreach ($tundaan_ujians as $user_id => $ujian) {
			if (count($ujian['jenis_ujian'])) {
				foreach ($ujian['jenis_ujian'] as $uj) {
					$belum_ujians[$uj->id]['ujian']       = $uj;
					$belum_ujians[$uj->id]['residen'][]   = $ujian['user'];
				}
			}
		}
		$dosens         = User::where('role_id', 2 )->get(); //2 = dosen
		$naungan = [];
		foreach ($dosens as $dosen) {
			 foreach ($dosen->subBagian as $subBagian) {
			 	 foreach ($subBagian->jenisStase->jenisUjian as $jenisUjian) {
					 foreach ($belum_ujians as $belum) {
						 if ( $belum['ujian']->id == $jenisUjian->id ) {
							 $naungan[$dosen->id]['user']                                    = $dosen;
							 $naungan[$dosen->id]['jenis_ujian'][$jenisUjian->id]            = $jenisUjian;
							 $naungan[$dosen->id]['jenis_ujian'][$jenisUjian->id]['residen'] = $belum['residen'];
						 }
					 }
			 	 }
			 }
		}
		foreach($naungan as $tundaan)	{
			$data = [
				'email'   => 'yoga.dvjul17@gmail.com',
				'bulan'   => Yoga::bulanIndonesia( date('m')),
				'subject' => 'Info Untuk Penguji ' . $tundaan['user']->nama . ' ' . date('d M y'),
				'tundaan' => $tundaan
			];
			Mail::send('emails.tundaanUjian', $data, function($message) use ($data){
				$message->from( 'admin@dvundip.com', 'Admin DV UNDIP' );
				$message->to($data['email']);
				$message->subject($data['subject']);
			});
			$data = [
				'email'   => 'yoga.dvjul17@gmail.com',
				'bulan'   => Yoga::bulanIndonesia( date('m')),
				'subject' => 'Info Untuk Penguji ' . $tundaan['user']->nama . ' ' . date('d M y'),
				'tundaan' => $tundaan
			];
			Mail::send('emails.tundaanUjian', $data, function($message) use ($data){
				$message->from( 'admin@dvundip.com', 'Admin DV UNDIP' );
				$message->to($data['email']);
				$message->subject($data['subject']);
			});
		}
		$pesan = Yoga::suksesFlash('email tundaan ujian berhasil dikirim');
		return redirect()->back()->withPesan($pesan);
	}
	private function untuls(){
		$bulan_masuk_ppds = User::orderBy('bulan_masuk_ppds', 'desc')->whereNotNull('bulan_masuk_ppds')->first()->bulan_masuk_ppds;
		$untuls = User::where('bulan_masuk_ppds', $bulan_masuk_ppds)->get();
		return $untuls;
	}

	
}
