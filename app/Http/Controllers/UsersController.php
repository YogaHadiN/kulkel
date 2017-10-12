<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Input;
use App\Yoga;
use DB;
class UsersController extends Controller
{
	public function index(){
		$users = User::all();
		return view('users.index', compact(
			'users'
		));
	}
	public function create(){
		return view('users.create');
	}
	public function edit($id){
		$user = User::find($id);
		return view('users.edit', compact('user'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$user       = new User;
		// Edit disini untuk simpan data
		$user->save();
		$pesan = Yoga::suksesFlash('User baru berhasil dibuat');
		return redirect('users')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$user     = User::find($id);
		// Edit disini untuk simpan data
		$user->save();
		$pesan = Yoga::suksesFlash('User berhasil diupdate');
		return redirect('users')->withPesan($pesan);
	}
	public function destroy($id){
		User::destroy($id);
		$pesan = Yoga::suksesFlash('User berhasil dihapus');
		return redirect('users')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$users     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$users[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		User::insert($users);
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
