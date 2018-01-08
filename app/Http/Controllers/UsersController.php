<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Input;
use App\Yoga;
use App\Role;
use App\NoTelp;
use DB;
class UsersController extends Controller
{
	public function __construct()
	{
		$this->middleware('adminOnly', ['only' => ['update', 'destroy']]);
	}
	public function create(){
		return view('users.create');
	}
	public function show($id){
		$user = User::find( $id );
		return view('users.show', compact(
			'user'
		));
	}
	
	public function index(){
		$users = User::all();

		return view('users.index', compact(
			'users'
		));
	}
	public function edit($id){
		$user = User::find($id);
		return view('users.edit', compact('user'));
	}
	public function store(Request $request){

		DB::beginTransaction();
		try {
			if ($this->valid( Input::all() )) {
				return $this->valid( Input::all() );
			}
			$user                   = new User;
			$user->nama             = Input::get('nama');
			$user->inisial             = Input::get('inisial');
			$user->role_id          = Input::get('role_id');
			$user->tanggal_lahir    = Yoga::datePrep(Input::get('tanggal_lahir'));
			$user->tempat_lahir     = Input::get('tempat_lahir');
			$user->bulan_masuk_ppds = Yoga::bulanTahun(Input::get('bulan_masuk_ppds')) . '-01';
			$user->alamat_asal      = Input::get('alamat_asal');
			$user->alamat_semarang  = Input::get('alamat_semarang');
			$user->no_ktp           = Input::get('no_ktp');
			$user->email            = Input::get('email');
			$user->sex              = Input::get('sex');
			$user->password         = bcrypt(Input::get('password'));
			$user->save();

			$no_telps = Input::get('no_telps');
			$no_telps = json_decode($no_telps, true);

			$telps = [];
			$timestamp = date('Y-m-d H:i:s');
			foreach ($no_telps as $telp) {
				$telps[] = [
					'user_id'         => $user->id,
					'no_telp'         => $telp['no_telp'],
					'jenis_telpon_id' => $telp['id'],
					'created_at'      => $timestamp,
					'updated_at'      => $timestamp
				];
			}
			NoTelp::insert($telps);

			$pesan = Yoga::suksesFlash('User baru berhasil dibuat');
			DB::commit();
			return redirect('users')->withPesan($pesan);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}


	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		DB::beginTransaction();
		try {

			$telps = [];
			$no_telps = json_decode( Input::get('no_telps'), true );
			$timestamp = date('Y-m-d H:i:s');

			
			$user                   = User::find($id);
			$user->nama             = Input::get('nama');
			$user->inisial          = Input::get('inisial');
			$user->role_id          = Input::get('role_id');
			$user->tanggal_lahir    = Yoga::datePrep(Input::get('tanggal_lahir'));
			$user->tempat_lahir     = Input::get('tempat_lahir');
			$user->bulan_masuk_ppds = Yoga::bulanTahun(Input::get('bulan_masuk_ppds')) . '-01';
			$user->alamat_asal      = Input::get('alamat_asal');
			$user->alamat_semarang  = Input::get('alamat_semarang');
			$user->no_ktp           = Input::get('no_ktp');
			$user->sex              = Input::get('sex');
			$user->email            = Input::get('email');
			if ( !empty( Input::get('password') ) ) {
				$user->password            = Input::get('password');
			}
			$user->save();

			NoTelp::where('user_id', $id)->delete();

			
			foreach ($no_telps as $telp) {
				$telps[] = [
					'user_id'         => $user->id,
					'jenis_telpon_id' => $telp['id'],
					'no_telp'         => $telp['no_telp'],
					'created_at'      => $timestamp,
					'updated_at'      => $timestamp
				];
			}

			NoTelp::insert($telps);
			$pesan = Yoga::suksesFlash('User berhasil diupdate');
			DB::commit();
			return redirect('users')->withPesan($pesan);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
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
			'nama'             => 'required',
			'email'            => 'required',
			'password'         => 'confirmed'
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
