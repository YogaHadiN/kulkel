<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sertifikat;
use Input;
use Storage;
use App\Yoga;
use DB;

class SertifikatController extends Controller
{
	public function index(){
		$sertifikats = Sertifikat::all();
		return view('sertifikats.index', compact(
			'sertifikats'
		));
	}
	public function create(){
		return view('sertifikats.create');
	}
	public function edit($id){
		$sertifikat = Sertifikat::with('user')->where('id', $id)->first();
		return view('sertifikats.edit', compact('sertifikat'));
	}
	public function store(Request $request){
			$messages = [
				'required' => ':attribute Harus Diisi',
			];
			$rules = [
				'judul'    => 'required'
			];
			
			$validator = \Validator::make(Input::all(), $rules, $messages);
			
			if ($validator->fails())
			{
				return \Redirect::back()->withErrors($validator)->withInput();
			}
		DB::beginTransaction();
		try {

			$user_id = Input::get('user_id');

			$sertifikat          = new Sertifikat;
			$sertifikat->judul   = Input::get('judul');
			$sertifikat->user_id = $user_id;
			$sertifikat->save();

			$stored = $this->uploadS3($request, 'filename', $user_id);

			$sertifikat->filename = $stored['file_name'];
			$sertifikat->save();
			
			DB::commit();
			$pesan = Yoga::suksesFlash('Sertifikat berhasil dimasukkan');
			return redirect('users/' . $user_id . '/image')->withPesan($pesan);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
	}
	public function show($id){
		$sertifikat = Sertifikat::with('user')->where('id', $id )->first();
		return view('sertifikats.show', compact(
			'sertifikat'
		));
	}
	
	public function update($id, Request $request){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'judul' => 'required'
		];
		
		$validator = \Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}

		DB::beginTransaction();
		try {
			
			$sertifikat        = Sertifikat::find($id);
			$sertifikat->judul = Input::get('judul');
			$sertifikat->save();

			if ( Input::hasFile('filename')  ) {
				Storage::delete( $sertifikat->filename );
				$stored = $this->uploadS3($request, 'filename', $sertifikat->user_id);
				$sertifikat->filename =  $stored['file_name'];
				$sertifikat->save();
			}
			$pesan = Yoga::suksesFlash('Sertifikat berhasil diupdate');
			DB::commit();
			return redirect('users/' . $sertifikat->user_id . '/image')->withPesan($pesan);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
	}
	public function destroy($id){
		$sertifikat = Sertifikat::find( $id );
		$user_id    = $sertifikat->user_id;
		$sertifikat_id    = $sertifikat->user_id;
		$sertifikat->delete();

		$pesan = Yoga::suksesFlash('Sertifikat ' .$sertifikat_id . ' berhasil dihapus');
		return redirect('users/' . $sertifikat->user_id . '/image')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$sertifikats     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$sertifikats[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Sertifikat::insert($sertifikats);
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

	private function uploadS3($request, $name, $user_id){
		if($request->hasFile($name)) {
			//get filename with extension
			$filenamewithextension = $request->file($name)->getClientOriginalName();
			//get filename without extension
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			//get file extension
			$extension = $request->file($name)->getClientOriginalExtension();
			//filename to store
			$filenametostore = 'users/' . $user_id . '/sertifikat/' . $filename.'_'.time().'.'.$extension;
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
