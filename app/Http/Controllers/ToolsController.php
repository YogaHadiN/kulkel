<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use App\User;
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
			foreach ($untul->residenPegangan as $pegangan) {
				$pegangans[$untul->email][] = $pegangan->residen;
				/* $pesan .= nl2br($smsBulanan->formatSms($pegangan->residen, $thisMonth )); */
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
		return Input::all(); 
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

		@foreach($naungan as $email)	
			$data = [
				'email'       => 'yoga.dvjul17@gmail.com',
				'bulan'       => Yoga::bulanIndonesia( date('m')),
				'subject'     => 'Info Untuk Penguji ' . $email['user']->nama,
				'naungan' => $email
			];
			Mail::send('emails.tundaanUjian', $data, function($message) use ($data){
				$message->from( 'admin@dvundip.com', 'Admin DV UNDIP' );
				$message->to($data['email']);
				$message->subject($data['subject']);
			});

			$data = [
				'email'       => 'yoga.dvjul17@gmail.com',
				'bulan'       => Yoga::bulanIndonesia( date('m')),
				'subject'     => 'Info Untuk Penguji ' . $email['user']->nama,
				'naungan' => $email
			];
			Mail::send('emails.tundaanUjian', $data, function($message) use ($data){
				$message->from( 'admin@dvundip.com', 'Admin DV UNDIP' );
				$message->to($data['email']);
				$message->subject($data['subject']);
			});
		@endforeach

		$pesan = Yoga::suksesFlash('email tundaan ujian berhasil dikirim');
		return redirect()->back()->withPesan($pesan);

	}
	private function untuls(){
		$bulan_masuk_ppds = User::orderBy('bulan_masuk_ppds', 'desc')->whereNotNull('bulan_masuk_ppds')->first()->bulan_masuk_ppds;
		$untuls = User::where('bulan_masuk_ppds', $bulan_masuk_ppds)->get();
		return $untuls;
	}

	
}
