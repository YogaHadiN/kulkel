<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gardenia;
use Input;
use App\Yoga;
use DB;

class GardeniasController extends Controller
{
	public function index(){
		$gardenias = Gardenia::all();
		return view('gardenias.index', compact(
			'gardenias'
		));
	}
	public function create(){
		return view('gardenias.create');
	}
	public function edit($id){
		$gardenia = Gardenia::find($id);
		return view('gardenias.edit', compact('gardenia'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$gardenia       = new Gardenia;
		$gardenia->user_id       = Input::get('user_id');
		$gardenia->tanggal       = Yoga::datePrep(Input::get('tanggal'));
		// Edit disini untuk simpan data
		$gardenia->save();
		$pesan = Yoga::suksesFlash('Gardenia baru berhasil dibuat');
		return redirect('gardenias')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$gardenia     = Gardenia::find($id);
		$gardenia->user_id       = Input::get('user_id');
		$gardenia->tanggal       = Yoga::datePrep(Input::get('tanggal'));
		$gardenia->save();
		$pesan = Yoga::suksesFlash('Gardenia berhasil diupdate');
		return redirect('gardenias')->withPesan($pesan);
	}
	public function destroy($id){
		Gardenia::destroy($id);
		$pesan = Yoga::suksesFlash('Gardenia berhasil dihapus');
		return redirect('gardenias')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$gardenias     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$gardenias[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Gardenia::insert($gardenias);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'user_id'           => 'required',
			'tanggal'           => 'required'
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
