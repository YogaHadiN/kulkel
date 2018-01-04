<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dosen;
use App\Alamat;
use App\Email;
use App\NoTelp;
use Input;
use App\Yoga;
use DB;

class DosensController extends Controller
{
	public function index(){
		$dosens = Dosen::all();
		return view('dosens.index', compact(
			'dosens'
		));
	}
	public function create(){
		return view('dosens.create');
	}
	public function edit($id){
		$dosen = Dosen::find($id);
		return view('dosens.edit', compact(
			'dosen'
		));
	}
	public function store(Request $request){
		DB::beginTransaction();
		try {
			if ($this->valid( Input::all() )) {
				return $this->valid( Input::all() );
			}
			$dosen                = new Dosen;
			$dosen->name          = Input::get('name');
			$dosen->nip           = Input::get('nip');
			$dosen->tanggal_lahir = Yoga::datePrep( Input::get('tanggal_lahir') );
			$dosen->no_ktp        = Input::get('no_ktp');
			$dosen->save();

			$alamat                  = new Alamat;
			$alamat->alamatable_id   = $dosen->id ;
			$alamat->alamatable_type = 'App\Dosen' ;
			$alamat->alamat          = Input::get('alamat');;
			$alamat->save();

			$email                  = new Email;
			$email->emailable_id   = $dosen->id ;
			$email->emailable_type = 'App\Dosen' ;
			$email->email          = Input::get('email');;
			$email->save();

			$no_telp                  = new NoTelp;
			$no_telp->telponable_id   = $dosen->id ;
			$no_telp->telponable_type = 'App\Dosen' ;
			$no_telp->jenis_telpon_id   = 1;
			$no_telp->no_telp          = Input::get('no_telp');;
			$no_telp->save();
			
			$pesan = Yoga::suksesFlash('Dosen baru berhasil dibuat');
			DB::commit();
			return redirect('dosens')->withPesan($pesan);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}

	}
	public function update($id, Request $request){
		DB::beginTransaction();
		try {
			if ($this->valid( Input::all(), $id )) {
				return $this->valid( Input::all(), $id );
			}
			$dosen                = Dosen::find($id);
			$dosen->name          = Input::get('name');
			$dosen->nip           = Input::get('nip');
			$dosen->tanggal_lahir = Yoga::datePrep( Input::get('tanggal_lahir') );
			$dosen->no_ktp        = Input::get('no_ktp');
			$dosen->save();

			alamat::where('alamatable_id', $id)
				->where('alamatable_type', 'App\Dosen')
				->delete();
			NoTelp::where('telponable_id', $id)
				->where('telponable_type', 'App\Dosen')
				->delete();
			Email::where('emailable_id', $id)
				->where('emailable_type', 'App\Dosen')
				->delete();

			$alamat                  = new Alamat;
			$alamat->alamatable_id   = $dosen->id ;
			$alamat->alamatable_type = 'App\Dosen' ;
			$alamat->alamat          = Input::get('alamat');;
			$alamat->save();

			$email                 = new Email;
			$email->emailable_id   = $dosen->id ;
			$email->emailable_type = 'App\Dosen' ;
			$email->email          = Input::get('email');;
			$email->save();

			$no_telp                  = new NoTelp;
			$no_telp->telponable_id   = $dosen->id ;
			$no_telp->telponable_type = 'App\Dosen' ;
			$no_telp->jenis_telpon_id = 1;
			$no_telp->no_telp         = Input::get('no_telp');;
			$no_telp->save();
			
			$pesan = Yoga::suksesFlash('Dosen ' . $dosen->name . ' Berhasil diubah');
			DB::commit();
			return redirect('dosens')->withPesan($pesan);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}

	}
	public function destroy($id){
		Dosen::destroy($id);
		$pesan = Yoga::suksesFlash('Dosen berhasil dihapus');
		return redirect('dosens')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$dosens     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$dosens[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Dosen::insert($dosens);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data, $id = false ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		if ($id) {
			$rules = [
				'name'   => 'required',
				'no_ktp' => 'required',
				'nip'    => 'required|unique:dosens,nip,' . $id
			];
		} else {
			$rules = [
				'name'   => 'required',
				'no_ktp' => 'required',
				'nip'    => 'required|unique:dosens,nip'
			];
		}
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
