<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sertifikat;
use Input;
use App\Yoga;
use DB;

class SertifikatController extends Controller
{
	public function index(){
		$sertifikats = Sertifikat::all();
		return view('sertifikats.index', compact(
			'sertifikats'
		));
	}
	public function create(){
		return view('sertifikats.create');
	}
	public function edit($id){
		$sertifikat = Sertifikat::find($id);
		return view('sertifikats.edit', compact('sertifikat'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$sertifikat       = new Sertifikat;
		// Edit disini untuk simpan data
		$sertifikat->save();
		$pesan = Yoga::suksesFlash('Sertifikat baru berhasil dibuat');
		return redirect('sertifikats')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$sertifikat     = Sertifikat::find($id);
		// Edit disini untuk simpan data
		$sertifikat->save();
		$pesan = Yoga::suksesFlash('Sertifikat berhasil diupdate');
		return redirect('sertifikats')->withPesan($pesan);
	}
	public function destroy($id){
		Sertifikat::destroy($id);
		$pesan = Yoga::suksesFlash('Sertifikat berhasil dihapus');
		return redirect('sertifikats')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$sertifikats     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$sertifikats[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Sertifikat::insert($sertifikats);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'data'           => 'required',
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
