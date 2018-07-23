<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Input;
use App\Yoga;
use App\JenisUjian;
use App\Ujian;
use App\Pembacaan;
use App\PinjamBuku;
use App\JenisStase;
use App\Role;
use App\Stase;
use App\NoTelp;
use Storage;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UjiansController;
use App\Http\Controllers\PembacaansController;
use DB;
class UsersController extends Controller
{
	public function __construct()
	{
		/* $this->middleware('adminOnly', ['only' => ['update', 'destroy']]); */
	}
	public function create(){
		return view('users.create');
	}
	public function show($id){

		$userThis = new HomeController;
		$thisUser = $userThis->paramIndex($id);

		$poli_bulan_inis      = $thisUser['poli_bulan_inis'];
		$gardenias            = $thisUser['gardenias'];
		$rsnds                = $thisUser['rsnds'];
		$pembacaan_bulan_inis = $thisUser['pembacaan_bulan_inis'];

		/* $url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_ADDR']; */
		$user             = User::with('role', 'no_telps')->where('id', $id )->first();
		$stasesResidens   = Stase::with('user', 'jenisStase')->where('user_id', $id)->orderBy('mulai')->get();
		$pembacaans       = Pembacaan::with('user')->where('user_id', $id)->orderBy('tanggal', 'desc')->get();

		$tundaan_ujians = $this->tundaan_ujian($id);
		/* return $tundaan_ujians; */
		return view('users.show', compact(
			'poli_bulan_inis',
			'stases',
			'gardenias',
			'rsnds',
			'pembacaan_bulan_inis',
			'user',
			'stasesResidens',
			'pembacaans',
			'tundaan_ujians',
			'id',
			'url',
			'jenisStases',
			'stases_sudah',
			'jenis_ujian_belum',
			'stases_belum'
		));
	}
	
	public function index(){

		$users    = User::with('no_telps.jenisTelpon', 'role')->orderBy('id', 'desc')->get();
		$admins   = [];
		$residens = [];
		$dosens   = [];
		$keluar   = [];

		foreach ($users as $user) {
			if ( $user->role_id == '1' ) {
				$residens[] = $user;
			} elseif ( $user->role_id == '2' ){
				$dosens[] = $user;
			} elseif ( $user->role_id == '3' ){
				$admins[] = $user;
			} else {
				$keluar[] = $user;
			}
		}

		return view('users.index', compact(
			'residens',
			'dosens',
			'keluar',
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
			$user->panggilan                 = Input::get('panggilan');
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
			$user->nomor_induk                  = Input::get('nomor_induk');
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
			'panggilan'             => 'required',
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
			$user->panggilan                 = Input::get('panggilan');
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
			$user->nomor_induk              = Input::get('nomor_induk');
			$user->email            = Input::get('email');
			if ( !empty( Input::get('password') ) ) {
				$user->password            = bcrypt(Input::get('password'));
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
			'panggilan'             => 'required',
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
		$user = User::find($user_id);
		return view('stases.edit', compact(
			'user',
			'stase',
			'user_id'
		));
	}

	public function stase_create($user_id){
		$user = User::find($user_id);
		return view('stases.create', compact(
			'user',
			'user_id'
		));
	}
	public function create_ujian($user_id){
		return view('ujians.create', compact(
			'user_id'
		));
	}
	public function edit_ujian($user_id, $ujian_id){
		$ujian        = Ujian::find($ujian_id);
		$uji          = new UjiansController;
		$edit_penguji = $uji->edit_penguji($ujian);
		return view('ujians.edit', compact(
			'user_id', 'ujian_id', 'ujian', 'edit_penguji'
		));
	}
	public function create_pembacaan($user_id){
		return view('pembacaans.create', compact(
			'user_id'
		));
	}
	public function edit_pembacaan($user_id, $pembacaan_id){
		$pembacaan          = Pembacaan::find($pembacaan_id);
		$pemb               = new PembacaansController;
		$moderator_array_id = $pemb->moderator_pembahas_array($pembacaan)['moderator_array_id'];
		$pembahas_array_id  = $pemb->moderator_pembahas_array($pembacaan)['pembahas_array_id'];
		return view('pembacaans.edit', compact(
			'user_id',
			'moderator_array_id',
			'pembahas_array_id',
			'pembacaan'
		));
	}
	public function tundaan_ujian($id){
		$stases               = Stase::with('jenisStase.jenisUjian')
								->where('user_id', $id)
								->where('akhir', '<=', date('Y-m-d H:i:s'))
								->get();
		$ujian_sudahs   = Ujian::where('user_id', $id)->where('tanggal', '<=', date('Y-m-d'))->get(['jenis_ujian_id']);
		$data                       = [];
		$stase_selesai              = [];
		$selesai = false;
		foreach ($stases as $k=> $stase) {
			$data[$stase->jenis_stase_id]['jenis_stase']    = $stase->JenisStase->jenis_stase;
			$data[$stase->jenis_stase_id]['jenis_stase_id'] = $stase->jenis_stase_id;
			if (isset($data[$stase->jenis_stase_id]['bulan'])) {
				$data[$stase->jenis_stase_id]['bulan'] += Ujian::monthPassed($stase->mulai, $stase->akhir);
			} else {
				$data[$stase->jenis_stase_id]['bulan'] =  Ujian::monthPassed($stase->mulai, $stase->akhir);
			}
			if (isset($data[$stase->jenis_stase_id]['bulan']) && $data[$stase->jenis_stase_id]['bulan'] >= $stase->jenisStase->bulan) {
				$stase_selesai[ $stase->jenis_stase_id ]['jenis_stase']    = $stase->jenisStase->jenis_stase;
				$stase_selesai[ $stase->jenis_stase_id ]['jenis_stase_id'] = $stase->jenis_stase_id;
				if (!isset($stase_selesai[ $stase->jenis_stase_id ]['akhir_stase'])) {
					$stase_selesai[ $stase->jenis_stase_id ]['akhir_stase'] = $stase->akhir;
				}
			}
		}
		$stase_selesai_ids = [];
		foreach ($stase_selesai as $stase) {
			$stase_selesai_ids[] = $stase['jenis_stase_id'];
		}
		$ujian_sudah_ids = [];
		foreach ($ujian_sudahs as $ujian) {
			$ujian_sudah_ids[] = $ujian->jenis_ujian_id;
		}
		$tundaan_ujians = JenisUjian::whereIn('jenis_stase_id', $stase_selesai_ids)->whereNotIn('id', $ujian_sudah_ids)->get();
		return $tundaan_ujians;
	}
	public function perpus($id){
		
		$pinjams = PinjamBuku::where('peminjam_id', $id)->get();
		$user = User::find( $id );


		return view('users.riwayatPeminjaman', compact(
			'pinjams',
			'user'
		));

	}
	public function image($id){
		$user = User::find( $id );
		return view('users.image', compact(
			'user'
		));
	}
	public function uploadImage($id, $fieldname){
		if(Input::hasFile('file')) {
			//get filename with extension
			$filenamewithextension = Input::file('file')->getClientOriginalName();
			//get filename without extension
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			//get file extension
			$extension = Input::file('file')->getClientOriginalExtension();
			//filename to store
			$filenametostore = 'users/' . $id . '/data/' . $filename.'_'.time().'.'.$extension;


			//Upload File to s3
			Storage::disk('s3')->put($filenametostore, fopen(Input::file('file'), 'r+'), 'public');
			//Store $filenametostore in the database
			//
			$user             = User::find($id);
			$user->$fieldname = $filenametostore;
			$user->save();

			return [
				'file_name' => $filenametostore,
				'link' => Storage::cloud()->url($filenametostore)
			];
			
	    }
	}
	public function sertifikatUpload($id){
		
		if(Input::hasFile('file')) {
			//get filename with extension
			$filenamewithextension = Input::file('file')->getClientOriginalName();
			//get filename without extension
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			//get file extension
			$extension = Input::file('file')->getClientOriginalExtension();
			//filename to store
			$filenametostore = 'users/' . $id . '/sertifikat/' . $filename.'_'.time().'.'.$extension;


			//Upload File to s3
			Storage::disk('s3')->put($filenametostore, fopen(Input::file('file'), 'r+'), 'public');
			//Store $filenametostore in the database
			//
			$user             = User::find($id);
			$user->$fieldname = $filenametostore;
			$user->save();

			return [
				'file_name' => $filenametostore,
				'link' => Storage::cloud()->url($filenametostore)
			];
			
	    }
	}
	public function createSertifikat($id){
		$user = User::find( $id );
		return view('sertifikats.create', compact(
			'user'
		));
		
	}
	
	
	
	
	
}
