<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gardenia;
use Input;
use App\Yoga;
use App\User;
use DB;

class GardeniasController extends Controller
{
	public function index(){
		$gardenias = Gardenia::with('user')->orderBy('updated_at', 'desc')->paginate(20);
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
			$messages = [
				'required' => ':attribute Harus Diisi',
			];
			$rules = [
				'user_id' => 'required',
				'tanggal.*' => 'date_format:"d-m-Y"'
			];
			
			$validator = \Validator::make(Input::all(), $rules, $messages);
			
			if ($validator->fails())
			{
				$tanggale = [];
				foreach ($validator->errors()->messages() as $k => $message) {
					if ( strpos($k, 'tanggal') !== false ) {
						$key = explode('.',$k);
						$tanggale[] = $key[1];
					}
				}
				return \Redirect::back()->withErrors($validator)->withInput()->withTanggale($tanggale);
			}
		$tanggals = Input::get('tanggal');
		$timestamp = date('Y-m-d H:i:s');
		$data= [];
		foreach ($tanggals as $tanggal) {
			$data[] = [
				'user_id'    => Input::get('user_id'),
				'tanggal'    => Yoga::datePrep($tanggal),
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
			
		}
		Gardenia::insert($data);
		$pesan = 'Jadwal Gardenia baru untuk ' . User::find( Input::get('user_id') )->nama . ' untuk tanggal :';
		$pesan .= '<ul>';
		foreach ( Input::get('tanggal') as $tanggal) {
			$pesan .= '<li>';
			$pesan .= $tanggal;
			$pesan .= '</li>';
		}
		$pesan .= '</ul>';
		$pesan .= ' berhasil dibuat';
		$pesan = Yoga::suksesFlash($pesan);
		return redirect('gardenias')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$gardenia          = Gardenia::find($id);
		$gardenia->user_id = Input::get('user_id');
		$gardenia->tanggal = Yoga::datePrep(Input::get('tanggal'));
		$gardenia->save();
		$pesan = 'Jadwal Gardenia <strong>' . User::find( Input::get('user_id') )->nama . '</strong> pada tanggal<strong> ' . Input::get('tanggal') . '</strong> berhasil diupdate';
		$pesan = Yoga::suksesFlash($pesan);
		return redirect('gardenias')->withPesan($pesan);
	}
	public function destroy($id){
		$gardenia = Gardenia::find($id);
		$pesan = 'Jadwal Gardenia untuk <strong>' . $gardenia->user->nama. ' </strong> pada tanggal ' . $gardenia->tanggal->format('d M Y') . ' berhasil dihapus';
		$pesan = Yoga::suksesFlash($pesan);
		Gardenia::destroy($id);
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
			'user_id'   => 'required',
			'tanggal.*' => 'required|date_format:"d-m-Y"'
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
