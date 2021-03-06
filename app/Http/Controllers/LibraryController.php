<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use App\Perpus;
use App\PinjamBuku;
use App\Yoga;
use App\User;
use App\Console\Commands\test;
use DB;
use Auth;
use Excel;
use Mail;

class LibraryController extends Controller
{
	public function __construct()
	{
		/* $this->middleware('adminOnly', ['only' => ['update', 'destroy']]); */
	}

	public function index(){
		return view('library.index', compact(
			'library'
		));
	}
	public function show($id){
		$buku           = Perpus::find($id);
		$masih_dipinjam = PinjamBuku::where('perpus_id', $id)->whereNull('tanggal_kembalikan')->count();
		$pinjam         = PinjamBuku::where('perpus_id',$id)->orderBy('created_at', 'desc')->get();
		$pinjam_by_user = PinjamBuku::where('perpus_id', $id)->where('peminjam_id', Auth::id())->orderBy('created_at', 'desc')->get();
		return view('library.show', compact(
			'buku',
			'pinjam_by_user',
			'masih_dipinjam',
			'pinjam'
		));
	}
	public function store(){
		$perpus             = new Perpus;
		$perpus->nomor_buku = Input::get('nomor_buku');
		$perpus->nama_buku  = Input::get('nama_buku');
		$perpus->pengarang  = Input::get('pengarang');
		$perpus->terbit     = Input::get('terbit');
		$perpus->save();
	
		$pesan = Yoga::suksesFlash('Buku baru berhasil dibuat');
		return redirect('library')->withPesan($pesan);
	}
	
	public function edit($id){
		$buku = Perpus::find($id);
		return view('library.edit', compact(
			'buku'
		));
	}
	public function update($id){
		$perpus       = Perpus::find($id);
		$perpus->nama_buku   = Input::get('nama_buku'); ;
		$perpus->nomor_buku   = Input::get('nomor_buku'); ;
		$perpus->pengarang   = Input::get('pengarang'); ;
		$perpus->terbit   = Input::get('terbit'); ;
		$perpus->save();

		$pesan = Yoga::suksesFlash('Buku berhasil diupdate');
		return redirect('library')->withPesan($pesan);
	}
	
	public function create(){
		return view('library.create');
	}
	
	public function view(){
		$buku_id    = Input::get('buku_id');
		$nama_buku  = Input::get('nama_buku');
		$pengarang  = Input::get('pengarang');
		$nomor_buku = Input::get('nomor_buku');
		$terbit     = Input::get('terbit');

		$query  = "SELECT * ";
		$query .= "FROM perpus ";
		$query .= "WHERE ( nomor_buku like '%{$nomor_buku}%' or '{$nomor_buku}' = '' ) ";
		$query .= "AND ( nama_buku like '%{$nama_buku}%' or '{$nama_buku}' = '' ) ";
		$query .= "AND ( pengarang like '%{$pengarang}%' or '{$pengarang}' = '' ) ";
		$query .= "AND ( terbit like '%{$terbit}%' or '{$terbit}' = '' ) ";
		$query .= "AND terbit >= 2000 ";
		$query .= "Limit 10 ";

		$data = DB::select($query);
		return $data;
	}
	public function pinjamBuku(){
		DB::beginTransaction();
		try {
			$token                                = Yoga::generate_salt(32);
			$pinjam                               = new PinjamBuku;
			$pinjam->token                        = $token;
			$pinjam->peminjam_id                  = Input::get('peminjam_id');
			$pinjam->admin_id                     = Input::get('admin_id');
			$pinjam->perpus_id                    = Input::get('perpus_id');
			$pinjam->tanggal_pinjam               = Yoga::datePrep(Input::get('tanggal_pinjam'));
			$pinjam->perkiraan_tanggal_kembalikan = Yoga::datePrep(Input::get('perkiraan_tanggal_kembalikan'));
			$pinjam->save();

			$user = User::find( Input::get('peminjam_id') );
			$buku = Perpus::find( Input::get('perpus_id') );

			$data = [
				'nama'        => $user->nama,
				'nama_buku'   => $buku->nama_buku,
				'email'       => $user->email,
				'token'       => $token,
				'subject'     => 'Konfirmasi Peminjaman Buku',
				'bodyMessage' => Input::get('message')
			];

			$this->EmailPerpus($data);

			DB::commit();
			return redirect('library/riwayatPeminjaman');
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
	}
	
	public function destroy($id){
		$buku = Perpus::find($id);
		$pesan = Yoga::suksesFlash('Buku <strong>' . $buku->nama_buku . '</strong> berhasil dihapus');
		$buku->delete();
		return redirect('library')->withPesan($pesan);
	}
	public function pinjam($id){
		$buku = Perpus::find( $id );
		return view('library.pinjam', compact(
			'buku'
		));
	}
	public function kembalikan($id){
		$pinjam       = PinjamBuku::find($id);
		return view('library.kembalikan', compact(
			'pinjam'
		));
	}
	public function kembalikanBuku($id){

		$pinjam                      = PinjamBuku::find($id);
		$pinjam->tanggal_kembalikan  = Yoga::datePrep( Input::get('tanggal_kembalikan') );
		$pinjam->admin_kembalikan_id = Input::get('admin_kembalikan_id');
		$pinjam->save();

		$user = User::find( Input::get('peminjam_id') );
		$buku = Perpus::find( Input::get('perpus_id') );

		$data = [
			'nama'        => $pinjam->peminjam->nama,
			'nama_buku'   => $pinjam->perpus->nama_buku,
			'email'       => $pinjam->peminjam->email,
			'subject'     => 'Konfirmasi Pengembalian Buku'
		];
		$this->EmailKembalikan($data);
		$pesan = Yoga::suksesFlash('Buku <strong>' . $pinjam->perpus->nama_buku . ' </strong>berhasil dikembalikan oleh <strong>' . $pinjam->peminjam->nama . '</strong>');
		return redirect('library')->withPesan($pesan);

	}
	public function import(){
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/'. $file_name, function($reader){
			$reader->all();
		})->get();
		$bukus     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			if (
				!empty($result['judul_buku']) &&
				!empty($result['pengarang'])
			) {
				$bukus[] = [
					'nomor_buku' => $result['kode_buku'],
					'nama_buku'  => $result['judul_buku'],
					'pengarang'  => $result['pengarang'],
					'terbit'     => $result['tahun_terbit'],
					'created_at' => $timestamp,
					'updated_at' => $timestamp
				];
			}
		}
		Perpus::truncate();
		Perpus::insert($bukus);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	public function EmailPerpus($data){
		Mail::send('emails.formMail', $data, function($message) use ($data){
			$message->from( 'admin@dvundip.com', 'Admin DV UNDIP' );
			$message->to($data['email']);
			$message->subject($data['subject']);
		});
	}
	public function konfirmasi($token){
		$buku          = PinjamBuku::where('token', $token)->firstOrFail();
		if ($buku->confirm) {
			return '<h1>peminjaman telah berhasil</h1>';
		}
		$buku->confirm = 1;
		$buku->save();
		return '<h1>peminjaman berhasil</h1>';
	}
	public function riwayatPeminjaman(){
		/* $pinjams = PinjamBuku::orderBy('tanggal_pinjam', 'desc')->get(); */
		$pinjams = PinjamBuku::orderBy('updated_at', 'desc')->get();
		return view('library.riwayat', compact(
			'pinjams'
		));
	}
	public function EmailKembalikan($data){
		Mail::send('emails.kembalikan', $data, function($message) use ($data){
			$message->from( 'admin@dvundip.com', 'Admin DV UNDIP' );
			$message->to($data['email']);
			$message->subject($data['subject']);
		});
	}
}
