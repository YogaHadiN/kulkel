<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Input;
use App\Yoga;
use App\Pembacaan;
use App\JenisStase;
use App\Role;
use App\Stase;
use App\NoTelp;
use App\Http\Controllers\HomeController;
use DB;
class UsersController extends Controller
{
	public function __construct()
	{
		/* $this->middleware('adminOnly', ['only' => ['update', 'destroy']]); */
		$this->middleware('adminOnly', ['only' => []]);
	}
	public function create(){
		return view('users.create');
	}
	public function show($id){
		$user             = User::find( $id );
		$stasesResidens           = Stase::with('user', 'jenisStase')->where('user_id', $id)->orderBy('mulai')->get();
		$pemb             = Pembacaan::with('user')->where('user_id', $id)->orderBy('tanggal')->get();
		$pembacaans_sudah = [];
		$pembacaans_belum = [];
		$staseResidens = [];

		$userThis = new HomeController;

		$poli_bulan_inis      = $userThis->paramIndex($id)['poli_bulan_inis'];
		$stases               = $userThis->paramIndex($id)['stases'];
		$gardenias            = $userThis->paramIndex($id)['gardenias'];
		$rsnds                = $userThis->paramIndex($id)['rsnds'];
		$pembacaan_bulan_inis = $userThis->paramIndex($id)['pembacaan_bulan_inis'];


		return view('users.show', compact(
			'poli_bulan_inis',
			'stasesResidens',
			'gardenias',
			'rsnds',
			'pembacaan_bulan_inis',
			'id',
			'user',
			'jenisStases',
			'stases_sudah',
			'stases_belum',
			'pembacaans_sudah',
			'pembacaans_belum',
			'stases'
		));
	}
	
	public function index(){

		$users    = User::with('no_telps.jenisTelpon', 'role')->orderBy('id', 'desc')->get();
		$admins   = [];
		$residens = [];
		$dosens   = [];

		foreach ($users as $user) {
			if ( $user->role_id == '1' ) {
				$residens[] = $user;
			} elseif ( $user->role_id == '2' ){
				$dosens[] = $user;
			} else {
				$admins[] = $user;
			}
		}

		return view('users.index', compact(
			'residens',
			'dosens',
			'admins'
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
			$user                       = new User;
			$user->nama                 = Input::get('nama');
			$user->inisial              = Input::get('inisial');
			$user->role_id              = Input::get('role_id');
			if ( !empty( trim( Input::get('tanggal_lahir') ) ) ) {
				$user->tanggal_lahir    = Yoga::datePrep(Input::get('tanggal_lahir'));
			}
			$user->tempat_lahir         = Input::get('tempat_lahir');
			if ( !empty( trim( Input::get('bulan_masuk_ppds') ) ) ) {
				$user->bulan_masuk_ppds = Yoga::bulanTahun(Input::get('bulan_masuk_ppds')) . '-01';
			}
			$user->alamat_asal          = Input::get('alamat_asal');
			$user->alamat_semarang      = Input::get('alamat_semarang');
			$user->no_ktp               = Input::get('no_ktp');
			$user->email                = Input::get('email');
			$user->sex                  = Input::get('sex');
			$user->password             = bcrypt(Input::get('password'));
			$user->save();

			$no_telps = Input::get('no_telp');

			$telps = [];
			$timestamp = date('Y-m-d H:i:s');
			$jenis_telps = Input::get('jenis_telpon_id');
			foreach ($no_telps as $k => $telp) {
				if ( !empty($telp)) {
					$telps[] = [
						'user_id'         => $user->id,
						'no_telp'         => $telp,
						'jenis_telpon_id' => $jenis_telps[$k],
						'created_at'      => $timestamp,
						'updated_at'      => $timestamp
					];
				}
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
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'nama'             => 'required',
			'email'            => 'required|unique:users,email,' . $id,
			'password'         => 'confirmed'
		];
		
		$validator = \Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}

		DB::beginTransaction();
		try {
			$user                   = User::find($id);
			$user->nama             = Input::get('nama');
			$user->inisial          = Input::get('inisial');
			$user->role_id          = Input::get('role_id');
			if ( !empty( Input::get('tanggal_lahir') ) ) {
				$user->tanggal_lahir    = Yoga::datePrep(Input::get('tanggal_lahir'));
			}
			$user->tempat_lahir     = Input::get('tempat_lahir');
			if ( !empty( trim( Input::get('bulan_masuk_ppds') ) ) ) {
				$user->bulan_masuk_ppds = Yoga::bulanTahun(Input::get('bulan_masuk_ppds')) . '-01';
			}
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

			$telps         = [];
			$no_telps      = Input::get('no_telp');
			$jenis_telpons = Input::get('jenis_telpon_id');
			$timestamp     = date('Y-m-d H:i:s');
			
			foreach ($no_telps as $k =>$telp) {
				if (!empty($telp)) {
					$telps[] = [
						'user_id'         => $user->id,
						'jenis_telpon_id' => $jenis_telpons[$k],
						'no_telp'         => $telp,
						'created_at'      => $timestamp,
						'updated_at'      => $timestamp
					];
				}
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
		return redirect('users');
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
			'email'            => 'required|unique:users,email',
			'password'         => 'confirmed'
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
	public function telpEmpty($telp){
		if ( empty( trim( $telp ) ) ) {
			$input_telps = '[]';
		}else {
			$input_telps = $telp;
		}
		return $input_telps;
	}
	public function ajaxUpdateStase(){
		$mulai    = Input::get('mulai');
		$akhir    = Input::get('akhir');
		$stase_id = Input::get('stase_id');
		$jenis_stase_id = Input::get('jenis_stase_id');
		$user_id  = Input::get('user_id');
		if ( empty( trim( $stase_id ) ) ) {
			$stase           = new Stase;
			$stase->user_id  = $user_id;
			$stase->mulai    = Yoga::datePrep($mulai);
			$stase->akhir    = Yoga::datePrep($akhir);
			$stase->jenis_stase_id = $jenis_stase_id;
			$stase->save();
			return $stase->id;
		} else {
			$stase          = Stase::find($stase_id);
			$stase->mulai   = Yoga::datePrep($mulai);
			$stase->akhir   = Yoga::datePrep($akhir);
			$stase->save();
		}
	}
	public function stase_edit($user_id, $stase_id){
		$stase = Stase::find($stase_id);
		return view('stases.edit', compact(
			'stase',
			'user_id'
		));
	}

	public function stase_create($user_id){
		return view('stases.create', compact(
			'user_id'
		));
	}
}
