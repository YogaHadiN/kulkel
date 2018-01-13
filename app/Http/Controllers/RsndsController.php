<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rsnd;
use Input;
use App\Yoga;
use DB;

class RsndsController extends Controller
{
	public function index(){
		$rsnds = Rsnd::all();
		return view('rsnds.index', compact(
			'rsnds'
		));
	}
	public function create(){
		return view('rsnds.create');
	}
	public function edit($id){
		$rsnd = Rsnd::find($id);
		return view('rsnds.edit', compact('rsnd'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$rsnd       = new Rsnd;
		$rsnd->user_id       = Input::get('user_id');
		$rsnd->tanggal       = Yoga::datePrep(Input::get('tanggal'));
		$rsnd->save();
		$pesan = Yoga::suksesFlash('Rsnd baru berhasil dibuat');
		return redirect('rsnds')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$rsnd     = Rsnd::find($id);
		$rsnd->user_id       = Input::get('user_id');
		$rsnd->tanggal       = Yoga::datePrep(Input::get('tanggal'));
		$rsnd->save();
		$pesan = Yoga::suksesFlash('Rsnd berhasil diupdate');
		return redirect('rsnds')->withPesan($pesan);
	}
	public function destroy($id){
		Rsnd::destroy($id);
		$pesan = Yoga::suksesFlash('Rsnd berhasil dihapus');
		return redirect('rsnds')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$rsnds     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$rsnds[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Rsnd::insert($rsnds);
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
