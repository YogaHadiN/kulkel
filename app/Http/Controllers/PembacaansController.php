<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembacaan;
use App\Jobs\UploadMateriToS3;
use App\Pembahas;
use App\Moderator;
use App\Yoga;
use Input;
use Storage;
use DB;

class PembacaansController extends Controller
{
	public function __construct()
	{
		$this->middleware('adminOnly', ['only' => ['update', 'destroy']]);
	}
	public function index(){
		$pembacaans = Pembacaan::with('user', 'pembahas.user', 'moderator.user', 'jenisPembacaan')->orderBy('updated_at', 'desc')->paginate(20);
		return view('pembacaans.index', compact(
			'pembacaans'
		));
	}
	public function create(){
		return view('pembacaans.create');
	}
	public function store(Request $request ){
		/* return Input::all(); */ 
		DB::beginTransaction();
		try {
			$messages = [
				'required' => ':attribute Harus Diisi',
			];
			$rules = [
				'user_id'            => 'required',
				'tanggal'            => 'required',
				'jenis_pembacaan_id' => 'required'
			];
			
			$validator = \Validator::make(Input::all(), $rules, $messages);
			
			if ($validator->fails())
			{
				return \Redirect::back()->withErrors($validator)->withInput();
			}
			$pembacaan                              = new Pembacaan;
			$pembacaan->user_id                     = Input::get('user_id');
			$pembacaan->judul                       = Input::get('judul');
			$pembacaan->doi                         = Input::get('doi');
			$pembacaan->jenis_pembacaan_id          = Input::get('jenis_pembacaan_id');
			$pembacaan->tanggal                     = Yoga::datePrep(Input::get('tanggal')) . ' ' . date("H:i:s", strtotime(Input::get('jam')));
			$pembacaan->save();


			if ($request->hasFile('materi')) {
				$upload_materi                          = $this->uploadS3($request, 'materi', $pembacaan->user_id);
				$pembacaan->nama_file_materi            = $upload_materi['file_name'];
				$pembacaan->link_materi                 = $upload_materi['link'];
			}
			if ($request->hasFile('terjemahan')) {
				$upload_terjemahan                      = $this->uploadTerjemahan($request, 'terjemahan', $pembacaan->user_id);
				$pembacaan->nama_file_materi_terjemahan = $upload_terjemahan['file_name'];
				$pembacaan->link_materi_terjemahan      = $upload_terjemahan['link'];
			}
			$pembacaan->save();

			$timestamp = date('Y-m-d H:i:s');
			$moderator = [];
			$pembahas = [];
			foreach ( Input::get('moderator') as $mod) {
				$moderator[] = [
					'user_id'      => $mod,
					'pembacaan_id' => $pembacaan->id,
					'created_at'   => $timestamp,
					'updated_at'   => $timestamp
				];
			}
			foreach ( Input::get('pembahas') as $pemb) {
				$pembahas[] = [
					'user_id'      => $pemb,
					'pembacaan_id' => $pembacaan->id,
					'created_at'   => $timestamp,
					'updated_at'   => $timestamp
				];
			}
			Pembahas::insert($pembahas);
			Moderator::insert($moderator);

			$pesan = Yoga::suksesFlash('Pembacaan berhasil diinput');
			DB::commit();
			if ( !is_null( Input::get('user_create') ) ) {
				return redirect('users/' . Input::get('user_id'))->withPesan($pesan);
			}
			return redirect('pembacaans')->withPesan($pesan);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
	}
	public function show($id){
		$pembacaan = Pembacaan::find($id);
		return view('pembacaans.show', compact(
			'pembacaan'
		));
	}
	
	public function destroy($id){
		$pembacaan = Pembacaan::find( $id );
		$pesan = Yoga::suksesFlash('Pembacaan <strong>' . $pembacaan->user->nama . '</strong> pada tanggal <strong>' .$pembacaan->tanggal->format('d M Y'). ' </strong>berhasil dihapus');
		$nama_file_materi            = $pembacaan->nama_file_materi;
		$nama_file_materi_terjemahan = $pembacaan->nama_file_materi_terjemahan;
		Storage::disk('s3')->delete($nama_file_materi);
		Storage::disk('s3')->delete($nama_file_materi_terjemahan);
		$pembacaan->delete();
		if ( !is_null( Input::get('user_create') ) ) {
			return redirect('users/' . Input::get('user_id'))->withPesan($pesan);
		}
		return redirect('pembacaans')->withPesan($pesan);
	}
	public function edit($id){
		$pembacaan          = Pembacaan::find( $id );
		$pembahas_array_id  = $this->moderator_pembahas_array($pembacaan)['pembahas_array_id'];
		$moderator_array_id = $this->moderator_pembahas_array($pembacaan)['moderator_array_id'];
		return view('pembacaans.edit', compact(
			'pembacaan',
			'moderator_array_id',
			'pembahas_array_id'
		));

	}
	public function update($id,Request $request ){
		DB::beginTransaction();
		try {
			$pembacaan                     = Pembacaan::find($id);
			$pembacaan->user_id            = Input::get('user_id');
			$pembacaan->judul              = Input::get('judul');
			$pembacaan->doi                = Input::get('doi');
			$pembacaan->jenis_pembacaan_id = Input::get('jenis_pembacaan_id');
			$pembacaan->tanggal            = Yoga::datePrep(Input::get('tanggal')) . ' ' . date("H:i:s", strtotime(Input::get('jam')));
			$pembacaan->save();


			if ($request->hasFile('materi')) {
				$upload_materi                          = $this->uploadS3($request, 'materi', $pembacaan->user_id);
				$pembacaan->nama_file_materi            = $upload_materi['file_name'];
				$pembacaan->link_materi                 = $upload_materi['link'];
			}
			if ($request->hasFile('terjemahan')) {
				$upload_terjemahan                      = $this->uploadTerjemahan($request, 'terjemahan', $pembacaan->user_id);
				$pembacaan->nama_file_materi_terjemahan = $upload_terjemahan['file_name'];
				$pembacaan->link_materi_terjemahan      = $upload_terjemahan['link'];
			}
			$pembacaan->save();

			Moderator::where('pembacaan_id', $id)->delete();
			Pembahas::where('pembacaan_id', $id)->delete();

			$moderator = [];
			$pembahas = [];
			$timestamp = date('Y-m-d H:i:s');
			foreach ( Input::get('moderator') as $mod){
				$moderator[] = [
					'user_id'      => $mod,
					'pembacaan_id' => $pembacaan->id,
					'created_at'   => $timestamp,
					'updated_at'   => $timestamp
				];
			}
			foreach ( Input::get('pembahas') as $pem){
				$pembahas[] = [
					'user_id'      => $pem,
					'pembacaan_id' => $pembacaan->id,
					'created_at'   => $timestamp,
					'updated_at'   => $timestamp
				];
			}
			Pembahas::insert($pembahas);
			Moderator::insert($moderator);

			$pesan = Yoga::suksesFlash('Pembacaan berhasil di Update');
			DB::commit();
			if ( !is_null( Input::get('user_create') ) ) {
				return redirect('users/' . Input::get('user_id'))->withPesan($pesan);
			}
			return redirect('pembacaans')->withPesan($pesan);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
	}
	public function moderator_pembahas_array($pembacaan){
		$pembahas_array_id = [];
		$moderator_array_id = [];
		foreach ($pembacaan->pembahas as $p) {
			$pembahas_array_id[] = $p->user->id;
		}
		foreach ($pembacaan->moderator as $p) {
			$moderator_array_id[] = $p->user->id;
		}
		return compact('pembahas_array_id', 'moderator_array_id');
	}
	
	private function uploadS3($request, $name, $user_id){
		if($request->hasFile($name)) {
			//get filename with extension
			$filenamewithextension = $request->file($name)->getClientOriginalName();
			//get filename without extension
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			//get file extension
			$extension = $request->file($name)->getClientOriginalExtension();
			//filename to store
			$filenametostore = 'users/' . $user_id . '/pembacaan/materi/' . $filename.'_'.time().'.'.$extension;
			//Upload File to s3
			Storage::disk('s3')->put($filenametostore, fopen($request->file($name), 'r+'), 'public');
			//Store $filenametostore in the database
			return [
				'file_name' => $filenametostore,
				'link' => Storage::cloud()->url($filenametostore)
			];
			
	    }
	}
	private function uploadTerjemahan($request, $name, $user_id){
		if($request->hasFile($name)) {
			//get filename with extension
			$filenamewithextension = $request->file($name)->getClientOriginalName();
			//get filename without extension
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			//get file extension
			$extension = $request->file($name)->getClientOriginalExtension();
			//filename to store
			$filenametostore = 'users/' . $user_id . '/pembacaan/terjemahan/' . $filename.'_'.time().'.'.$extension;

			//Upload File to s3
			Storage::disk('s3')->put($filenametostore, fopen($request->file($name), 'r+'), 'public');
			//Store $filenametostore in the database
			return [
				'file_name' => $filenametostore,
				'link' => Storage::cloud()->url($filenametostore)
			];
			
	    }
	}
}
