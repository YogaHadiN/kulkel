<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JenisStase;
use Input;
use App\Yoga;
use DB;

class JenisStasesController extends Controller
{
	public function index(){
		$jenis_stases = JenisStase::all();
		return view('jenis_stases.index', compact(
			'jenis_stases'
		));
	}
	public function create(){
		return view('jenis_stases.create');
	}
	public function edit($id){
		$jenis_stase = JenisStase::find($id);
		return view('jenis_stases.edit', compact('jenis_stase'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$jenis_stase       = new JenisStase;
		// Edit disini untuk simpan data
		$jenis_stase->save();
		$pesan = Yoga::suksesFlash('JenisStase baru berhasil dibuat');
		return redirect('jenis_stases')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$jenis_stase     = JenisStase::find($id);
		// Edit disini untuk simpan data
		$jenis_stase->save();
		$pesan = Yoga::suksesFlash('JenisStase berhasil diupdate');
		return redirect('jenis_stases')->withPesan($pesan);
	}
	public function destroy($id){
		JenisStase::destroy($id);
		$pesan = Yoga::suksesFlash('JenisStase berhasil dihapus');
		return redirect('jenis_stases')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$jenis_stases     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$jenis_stases[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		JenisStase::insert($jenis_stases);
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
