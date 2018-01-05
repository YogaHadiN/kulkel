<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use App\Perpus;
use App\PinjamBuku;
use App\Yoga;
use App\User;
use DB;
use Auth;
use Excel;

class LibraryController extends Controller
{
	public function __construct()
	{
		$this->middleware('adminOnly', ['only' => ['update', 'destroy']]);
	}

	public function index(){
		$library = '';
		return view('library.index', compact(
			'library'
		));
	}
	public function show($id){
		$buku = Perpus::find($id);

		$masih_dipinjam = PinjamBuku::where('perpus_id', $id)->whereNull('tanggal_kembalikan')->count();
		$pinjam = PinjamBuku::where('perpus_id',$id)->orderBy('created_at', 'desc')->get();
		/* return $pinjam->first()->adminKembalikan->nama; */
		$pinjam_by_user = PinjamBuku::where('perpus_id', $id)->where('peminjam_id', Auth::id())->orderBy('created_at', 'desc')->get();
		return view('library.show', compact(
			'buku',
			'pinjam_by_user',
			'masih_dipinjam',
			'pinjam'
		));
	}
	public function store(){
		$perpus       = new Perpus;
		$perpus->nomor_buku   = Input::get('nomor_buku');
		$perpus->nama_buku   = Input::get('nama_buku');
		$perpus->pengarang   = Input::get('pengarang');
		$perpus->terbit   = Input::get('terbit');
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
		$query .= "Limit 10 ";

		$data = DB::select($query);
		return $data;
	}
	public function pinjamBuku(){
		DB::beginTransaction();
		try {
			$pinjam                               = new PinjamBuku;
			$pinjam->peminjam_id                  = Input::get('peminjam_id');
			$pinjam->admin_id                     = Input::get('admin_id');
			$pinjam->perpus_id                    = Input::get('perpus_id');
			$pinjam->tanggal_pinjam               = Yoga::datePrep(Input::get('tanggal_pinjam'));
			$pinjam->perkiraan_tanggal_kembalikan = Yoga::datePrep(Input::get('perkiraan_tanggal_kembalikan'));
			$pinjam->save();

			$buku = Perpus::find( Input::get('perpus_id') );
			$user = User::find( Input::get('peminjam_id') );

			DB::commit();
			return redirect('library');
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
		$pinjam                     = PinjamBuku::find($id);
		$pinjam->tanggal_kembalikan = Yoga::datePrep( Input::get('tanggal_kembalikan') );
		$pinjam->admin_kembalikan_id   = Input::get('admin_kembalikan_id');
		$pinjam->save();

		$pesan = Yoga::suksesFlash('Buku <strong>' . $pinjam->perpus->nama_buku . ' </strong>berhasil dikembalikan oleh <strong>' . $pinjam->peminjam->nama . '</strong>');
		return redirect('library')->withPesan($pesan);

	}
	public function import(){
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('/var/www/kulkel/public');
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$bukus     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $resultss) {
			foreach ($resultss as $result) {
				if (
					!empty($result['judul_buku']) &&
					!empty($result['pengarang'])
				) {
					$bukus[] = [
						'nomor_buku' =>	$result['kode_buku'],
						'nama_buku' => $result['judul_buku'],
						'pengarang' => $result['pengarang'],
						'terbit' => $result['tahun_terbit'],
						'created_at' => $timestamp,
						'updated_at' => $timestamp
					];
				}
			}
		}
		Perpus::truncate();
		Perpus::insert($bukus);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
}
