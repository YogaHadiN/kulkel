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
		$jenisStases      = JenisStase::all();
		$user             = User::find( $id );
		$stases           = Stase::with('user')->where('user_id', $id)->get();
		$pemb             = Pembacaan::with('user')->where('user_id', $id)->orderBy('tanggal')->get();
		$pembacaans_sudah = [];
		$pembacaans_belum = [];

		$staseResidens = [];

		foreach ($jenisStases as $jenisStase) {

			$ada = false;
			$mulai = '';
			$akhir = '';
			$stase_id = '';
			$jenis_stase_id = '';

			foreach ($stases as $stase) {
				if ($stase->jenis_stase_id == $jenisStase->id) {
					$ada            = true;
					$mulai          = $stase->mulai->format('01-m-Y');
					$akhir          = $stase->akhir->format('t-m-Y');
					$stase_id       = $stase->id;
					$jenis_stase_id = $jenisStase->id;
				}
			}
			if ($ada) {
				$staseResidens[] = [
					'jenis_stase_id' => $jenis_stase_id,
					'stase_id'       => $stase_id,
					'stase'          => $jenisStase->jenis_stase,
					'mulai'          => $mulai,
					'urut'           => Yoga::datePrep($mulai),
					'urutAkhir'           => Yoga::datePrep($akhir),
					'akhir'          => $akhir,
				];
			} else {
				$staseResidens[] = [
					'jenis_stase_id' => $jenisStase->id,
					'stase_id'       => $stase_id,
					'stase'          => $jenisStase->jenis_stase,
					'urut'           => Yoga::datePrep($mulai),
					'urutAkhir'           => Yoga::datePrep($akhir),
					'mulai'          => $mulai,
					'akhir'          => $akhir,
				];
			}
		}

		$stases_belum = [];
		$stases_sudah = [];

		foreach ($pemb as $p) {
			if ($p->tanggal < date('Y-m-d')) {
				$pembacaans_sudah[] = $p;
			} else {
				$pembacaans_belum[] = $p;
			}
		}
		foreach ($stases as $p) {
			if ($p->periode_bulan < date('Y-m-d')) {
				$stases_sudah[] = $p;
			} else {
				$stases_belum[] = $p;
			}
		}

		usort($staseResidens, function($a, $b) {
			return $a['urut'] <=> $b['urut'];
		});

		return view('users.show', compact(
			'id',
			'user',
			'jenisStases',
			'staseResidens',
			'stases_sudah',
			'stases_belum',
			'pembacaans_sudah',
			'pembacaans_belum',
			'stases'
		));
	}
	
	public function index(){

		$users    = User::with('no_telps')->get();
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
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
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
			'email'            => 'required',
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
	
	
}
