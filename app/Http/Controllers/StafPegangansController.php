<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StafPegangan;
use Input;
use App\Yoga;
use DB;

class StafPegangansController extends Controller
{
	public function index(){
		$pegangans = StafPegangan::with('user', 'staf')->orderBy('updated_at', 'desc')->paginate(20);
		return view('staf_pegangans.index', compact(
			'pegangans'
		));
	}
	public function create(){
		return view('staf_pegangans.create');
	}
	public function edit($id){
		$pegangan = StafPegangan::find($id);
		return view('staf_pegangans.edit', compact('pegangan'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$pegangan          = new StafPegangan;
		$pegangan->user_id = Input::get('user_id');
		$pegangan->staf_id = Input::get('staf_id');
		$pegangan->save();
		$pesan = Yoga::suksesFlash('StafPegangan baru berhasil dibuat');
		return redirect('pegangans/staf')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$pegangan     = StafPegangan::find($id);
		// Edit disini untuk simpan data
		$pegangan->save();
		$pesan = Yoga::suksesFlash('StafPegangan berhasil diupdate');
		return redirect('pegangans/staf')->withPesan($pesan);
	}
	public function destroy($id){
		StafPegangan::destroy($id);
		$pesan = Yoga::suksesFlash('StafPegangan berhasil dihapus');
		return redirect('pegangans/staf')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$pegangans     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$pegangans[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		StafPegangan::insert($pegangans);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'user_id'           => 'required',
			'staf_id'           => 'required'
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
