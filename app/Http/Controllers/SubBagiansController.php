<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubBagian;
use Input;
use App\Yoga;
use DB;

class SubBagiansController extends Controller
{
	public function index(){
		$sub_bagians = SubBagian::with('user', 'jenisStase')->get();
		$subs = [];
		foreach ($sub_bagians as $sub_bagian) {
			$subs[$sub_bagian->jenis_stase_id]['nama_stase'] = $sub_bagian->jenisStase->jenis_stase;
			$subs[$sub_bagian->jenis_stase_id]['pengujis'][] = [
				'sub_bagian_id' => $sub_bagian->id,
				'nama'          => $sub_bagian->user->nama,
				'penguji'       => $sub_bagian->jenis_penguji_id
			];
		}
		$data = [];
		foreach ($subs as $sub) {
			$data[] = $sub;
		}
		$subs = $data;
		/* return $subs; */
		return view('sub_bagians.index', compact(
			'sub_bagians',
			'subs'
		));
	}
	public function create(){
		return view('sub_bagians.create');
	}
	public function edit($id){
		$sub_bagian = SubBagian::find($id);
		return view('sub_bagians.edit', compact('sub_bagian'));
	}
	public function store(Request $request){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'user_id'          => 'required',
			'jenis_penguji_id' => 'required',
			'jenis_stase_id'   => 'required'
		];
		
		$validator = \Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
		$sub_bagian                   = new SubBagian;
		$sub_bagian->user_id          = Input::get('user_id');
		$sub_bagian->jenis_stase_id   = Input::get('jenis_stase_id');
		$sub_bagian->jenis_penguji_id = Input::get('jenis_penguji_id');
		$sub_bagian->save();
		$pesan = Yoga::suksesFlash('SubBagian baru berhasil dibuat');
		return redirect('sub_bagians')->withPesan($pesan);
	}
	public function update($id, Request $request){
			$messages = [
				'required' => ':attribute Harus Diisi',
			];
			$rules = [
				'user_id'          => 'required',
				'jenis_penguji_id' => 'required',
				'jenis_stase_id'   => 'required'
			];
			
			$validator = \Validator::make(Input::all(), $rules, $messages);
			
			if ($validator->fails())
			{
				return \Redirect::back()->withErrors($validator)->withInput();
			}
		$sub_bagian                   = SubBagian::find($id);
		$sub_bagian->user_id          = Input::get('user_id');
		$sub_bagian->jenis_stase_id   = Input::get('jenis_stase_id');
		$sub_bagian->jenis_penguji_id = Input::get('jenis_penguji_id');
		$sub_bagian->save();

		$pesan = Yoga::suksesFlash('SubBagian berhasil diupdate');
		return redirect('sub_bagians')->withPesan($pesan);
	}
	public function destroy($id){
		SubBagian::destroy($id);
		$pesan = Yoga::suksesFlash('SubBagian berhasil dihapus');
		return redirect('sub_bagians')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$sub_bagians     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$sub_bagians[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		SubBagian::insert($sub_bagians);
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
