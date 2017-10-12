<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use Input;
use App\Yoga;
use DB;
class KaryawansController extends Controller
{
	public function index(){
		$karyawans = Karyawan::all();
		return view('karyawans.index', compact(
			'karyawans'
		));
	}
	public function create(){
		return view('karyawans.create');
	}
	public function edit($id){
		$karyawan = Karyawan::find($id);
		return view('karyawans.edit', compact('karyawan'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$karyawan       = new Karyawan;
		// Edit disini untuk simpan data
		$karyawan->save();
		$pesan = Yoga::suksesFlash('Karyawan baru berhasil dibuat');
		return redirect('karyawans')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all(), true );
		}
		$karyawan     = Karyawan::find($id);
		// Edit disini untuk simpan data
		$karyawan->save();
		$pesan = Yoga::suksesFlash('Karyawan berhasil diupdate');
		return redirect('karyawans')->withPesan($pesan);
	}
	public function destroy($id){
		Karyawan::destroy($id);
		$pesan = Yoga::suksesFlash('Karyawan berhasil dihapus');
		return redirect('karyawans')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$karyawans     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$karyawans[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Karyawan::insert($karyawans);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data, $update = false ){
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
