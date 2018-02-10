<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rsnd;
use App\User;
use Input;
use App\Yoga;
use DB;

class RsndsController extends Controller
{
	public function index(){
		$rsnds = Rsnd::with('user')->orderBy('updated_at', 'desc')->paginate(20);
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
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'user_id' => 'required',
			'tanggal.*' => 'required|date_format:"d-m-Y"',
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
		$timestamp = date('Y-m-d H:i:s');
		$rsnds = [];

		foreach ( Input::get('tanggal') as $tanggal) {
			$rsnds[] = [
				'user_id'    => Input::get('user_id'),
				'tanggal'    => Yoga::datePrep($tanggal),
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Rsnd::insert($rsnds);

		$pesan = 'Jadwal baru RSND untuk ' . User::find(Input::get('user_id'))->nama . ' telah dibuat untuk tanggal :';
		$pesan .= '<ul>';
		foreach ( Input::get('tanggal') as $tanggal) {
			$pesan .= '<li>';
			$pesan .= $tanggal;
			$pesan .= '</li>';
		}
		$pesan .= '</ul>';
		$pesan = Yoga::suksesFlash($pesan);
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
		$rsnd = Rsnd::find($id);
		$pesan = Yoga::suksesFlash('Jadwal RSND <strong>' . $rsnd->user->nama . ' </strong>di RSND tanggal <strong>' . $rsnd->tanggal->format('d M Y') . ' </strong>berhasil dihapus');
		Rsnd::destroy($id);
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
