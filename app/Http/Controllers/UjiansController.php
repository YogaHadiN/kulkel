<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ujian;
use Input;
use App\Yoga;
use App\Penguji;
use DB;

class UjiansController extends Controller
{
	public function index(){
		$ujians = Ujian::all();
		return view('ujians.index', compact(
			'ujians'
		));
	}
	public function create(){
		return view('ujians.create');
	}
	public function edit($id){
		$ujian = Ujian::find($id);
		return view('ujians.edit', compact('ujian'));
	}
	public function store(Request $request){
		DB::beginTransaction();
		try {
			if ($this->valid( Input::all() )) {
				return $this->valid( Input::all() );
			}
			$ujian                 = new Ujian;
			$ujian->user_id        = Input::get('user_id');
			$ujian->tanggal        = Yoga::datePrep(Input::get('tanggal'));
			$ujian->jenis_ujian_id = Input::get('jenis_ujian_id');
			$ujian->save();

			$pengujis      = Input::get('penguji');
			$timestamp     = date('Y-m-d H:i:s');
			$penguji_array = [];
			foreach ($pengujis as $penguji) {
				$penguji_array[] = [
					'ujian_id'   => $ujian->id,
					'penguji_id' => $penguji,
					'created_at' => $timestamp,
					'updated_at' => $timestamp
				];
			}
			Penguji::insert($penguji_array);
			$pesan = Yoga::suksesFlash('Ujian baru berhasil dibuat');
			DB::commit();
			return redirect('ujians')->withPesan($pesan);
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
			$ujian                 = Ujian::find($id);
			$ujian->user_id        = Input::get('user_id');
			$ujian->tanggal        = Yoga::datePrep(Input::get('tanggal'));
			$ujian->jenis_ujian_id = Input::get('jenis_ujian_id');
			$ujian->save();

			$pengujis      = Input::get('penguji');
			$timestamp     = date('Y-m-d H:i:s');
			$penguji_array = [];
			foreach ($pengujis as $penguji) {
				$penguji_array[] = [
					'ujian_id'   => $id,
					'penguji_id' => $penguji,
					'created_at' => $timestamp,
					'updated_at' => $timestamp
				];
			}
			Penguji::where('ujian_id', $id)->delete();
			Penguji::insert($penguji_array);
			$pesan = Yoga::suksesFlash('Ujian baru berhasil dibuat');
			DB::commit();
			return redirect('ujians')->withPesan($pesan);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
	}
	public function destroy($id){
		Ujian::destroy($id);
		$pesan = Yoga::suksesFlash('Ujian berhasil dihapus');
		return redirect('ujians')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$ujians     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$ujians[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Ujian::insert($ujians);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'user_id'        => 'required',
			'tanggal'        => 'required',
			'jenis_ujian_id' => 'required'
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
	
}
