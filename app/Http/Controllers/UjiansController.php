<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ujian;
use Input;
use App\Yoga;
use App\Penguji;
use App\JenisUjian;
use App\SubBagian;
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
		$ujian        = Ujian::find($id);
		$edit_penguji = $this->edit_penguji($ujian);
		return view('ujians.edit', compact('ujian', 'edit_penguji'));
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
					'user_id' => $penguji,
					'created_at' => $timestamp,
					'updated_at' => $timestamp
				];
			}
			Penguji::insert($penguji_array);
			$pesan = Yoga::suksesFlash('Ujian baru berhasil dibuat');
			DB::commit();
			if (!is_null( Input::get('user_create') )) {
				return redirect('users/' . Input::get('user_id'))->withPesan($pesan);
			}
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
					'user_id'    => $penguji,
					'created_at' => $timestamp,
					'updated_at' => $timestamp
				];
			}
			Penguji::where('ujian_id', $id)->delete();
			Penguji::insert($penguji_array);
			$pesan = Yoga::suksesFlash('Ujian baru berhasil dibuat');
			DB::commit();
			if ( !is_null( Input::get('user_create') )) {
				return redirect('users/' . Input::get('user_id'))->withPesan($pesan);
			}
			return redirect('ujians')->withPesan($pesan);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
	}
	public function destroy($id){
		Ujian::destroy($id);
		Penguji::where('ujian_id', $id)->delete();
		$pesan = Yoga::suksesFlash('Ujian berhasil dihapus');
		if ( !is_null( Input::get('user_delete') ) ) {
			return redirect('users/' . Input::get('user_id'))->withPesan($pesan);
		}
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
	public function edit_penguji($ujian){
		$edit_penguji = [];
		foreach ($ujian->penguji as $penguji) {
			$edit_penguji[] = $penguji->user_id;
		}
		return $edit_penguji;
	}
	public function getPenguji(){
		$jenis_ujian_id = Input::get('jenis_ujian_id');
		$jenis_ujian    = JenisUjian::find( $jenis_ujian_id );
		$jenis_stase_id = $jenis_ujian->jenis_stase_id;
		$sub_bagians    = SubBagian::where('jenis_stase_id', $jenis_stase_id)->get();
		$user_ids = [];
		foreach ($sub_bagians as $sub_bagian) {
			$user_ids[] = $sub_bagian->user_id;
		}
		return $user_ids;
	}
	
	
	
}
