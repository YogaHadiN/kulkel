<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Residen;
use App\NoTelp;
use Input;
use App\Yoga;
use App\JenisTelpon;
use DB;
class ResidensController extends Controller
{
	public function index(){
		$residens = Residen::all();
		return view('residens.index', compact(
			'residens'
		));
	}
	public function create(){
		return view('residens.create');
	}
	public function edit($id){
		$residen = Residen::with('no_telps.jenisTelpon')->where('id', $id)->first();
		return view('residens.edit', compact('residen'));
	}
	public function show($id){
		$residen = Residen::find($id);

		/* return $residen->no_telps->first()->jenisTelpon; */
		return view('residens.show', compact('residen'));
	}
	public function store(Request $request){
		DB::beginTransaction();
		try {
			/* return Input::all(); */ 
			if ($this->valid( Input::all() )) {
				return $this->valid( Input::all() );
			}
			$residen                   = new Residen;
			$residen->nama             = Input::get('nama');
			$residen->tanggal_lahir    = Yoga::datePrep(Input::get('tanggal_lahir'));
			$residen->tempat_lahir     = Input::get('tempat_lahir');
			$residen->bulan_masuk_ppds = Yoga::bulanTahun(Input::get('bulan_masuk_ppds')) . '-01';
			$residen->alamat_asal      = Input::get('alamat_asal');
			$residen->alamat_semarang  = Input::get('alamat_semarang');
			$residen->nama_pasangan    = Input::get('nama_pasangan');
			$residen->no_ktp           = Input::get('no_ktp');
			$residen->judul_thesis     = Input::get('judul_thesis');
			$residen->save();


			// input no telp
			//

			$telp_array = Input::get('no_telps');

			$telp_array = json_decode($telp_array, true);
			$telps = [];

			$timestamp = date('Y-m-d H:i:s');
			foreach ($telp_array as $telp) {
				$telps[]=[
					'telponable_type' => 'App\Residen',
					'telponable_id'   => $residen->id,
					'jenis_telpon_id' => $telp['id'],
					'no_telp'         => $telp['no_telp'],
					'created_at'      => $timestamp,
					'updated_at'      => $timestamp
				];
			}
			$anak_array = Input::get('anaks');

			$anak_array = json_decode($anak_array, true);

			NoTelp::insert($telps);

			$pesan = Yoga::suksesFlash('Residen baru berhasil dibuat');
			DB::commit();
			return redirect('residens')->withPesan($pesan);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
	}

	public function update($id, Request $request){
		DB::beginTransaction();
		try {
			
			if ($this->valid( Input::all() )) {
				return $this->valid( Input::all() );
			}
			$residen                   = Residen::find($id);
			$residen->nama             = Input::get('nama');
			$residen->tanggal_lahir    = Yoga::datePrep(Input::get('tanggal_lahir'));
			$residen->tempat_lahir     = Input::get('tempat_lahir');
			$residen->bulan_masuk_ppds = Yoga::bulanTahun(Input::get('bulan_masuk_ppds')) . '-01';
			$residen->alamat_asal      = Input::get('alamat_asal');
			$residen->alamat_semarang  = Input::get('alamat_semarang');
			$residen->nama_pasangan    = Input::get('nama_pasangan');
			$residen->no_ktp           = Input::get('no_ktp');
			$residen->judul_thesis     = Input::get('judul_thesis');
			// Edit disini untuk simpan data
			$residen->save();


			NoTelp::where('telponable_type', 'App\Residen')
				->where('telponable_id', $id)
				->delete();

			$telp_array = Input::get('no_telps');

			$telp_array = json_decode($telp_array, true);
			$telps = [];

			$timestamp = date('Y-m-d H:i:s');
			foreach ($telp_array as $telp) {
				$telps[]=[
					'telponable_type' => 'App\Residen',
					'telponable_id'   => $residen->id,
					'jenis_telpon_id' => $telp['id'],
					'no_telp'         => $telp['no_telp'],
					'created_at'      => $timestamp,
					'updated_at'      => $timestamp
				];
			}
			$anak_array = Input::get('anaks');

			$anak_array = json_decode($anak_array, true);

			NoTelp::insert($telps);

			$pesan = Yoga::suksesFlash('Residen berhasil diupdate');
			DB::commit();
			return redirect('residens')->withPesan($pesan);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
	}
	public function destroy($id){
		Residen::destroy($id);
		$pesan = Yoga::suksesFlash('Residen berhasil dihapus');
		return redirect('residens')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$residens     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$residens[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Residen::insert($residens);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'nama'           => 'required'
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
