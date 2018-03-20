<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use Input;
use App\Yoga;
use DB;
use Storage;

class VideosController extends Controller
{
	public function index(){
		$videos = Video::all();
		return view('videos.index', compact(
			'videos'
		));
	}
	public function create(){
		return view('videos.create');
	}
	public function edit($id){
		$video = Video::find($id);
		return view('videos.edit', compact('video'));
	}
	public function store(Request $request){
		DB::beginTransaction();
		try {
			
			if ($this->valid( Input::all() )) {
				return $this->valid( Input::all() );
			}
			$saved_file = $this->uploadS3($request, 'materi');

			$video                   = new Video;
			$video->judul            = $saved_file['judul'];
			$video->nama_file_materi = $saved_file['nama_file_materi'];
			$video->link_materi      = $saved_file['link_materi'];
			$video->save();
			$pesan = Yoga::suksesFlash('Video baru berhasil dibuat');
			DB::commit();
			return redirect('videos')->withPesan($pesan);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$video     = Video::find($id);
		// Edit disini untuk simpan data
		$video->save();
		$pesan = Yoga::suksesFlash('Video berhasil diupdate');
		return redirect('videos')->withPesan($pesan);
	}
	public function destroy($id){

		DB::beginTransaction();
		try {
			$video = Video::find($id);
			$judul = $video->judul;
			Storage::disk('s3')->delete( $video->nama_file_materi );
			$video->delete();
			$pesan = Yoga::suksesFlash('Video ' . $judul . ' berhasil dihapus');
			DB::commit();
			return redirect('videos')->withPesan($pesan);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$videos     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$videos[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Video::insert($videos);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'materi'           => 'required:100000',
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
	public function uploadS3($request, $name){
		if($request->hasFile($name)) {
			//get filename with extension
			$filenamewithextension = $request->file($name)->getClientOriginalName();
			//get filename without extension
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			//get file extension
			$extension = $request->file($name)->getClientOriginalExtension();
			//filename to store
			$filenametostore = 'videos/' . $filename.'_'.time().'.'.$extension;
			//Upload File to s3
			Storage::disk('s3')->put($filenametostore, fopen($request->file($name), 'r+'), 'public');
			//Store $filenametostore in the database
			return [
				'nama_file_materi' => $filenametostore,
				'link_materi'      => Storage::cloud()->url($filenametostore),
				'judul'     => $filename
			];
			
	    }
	}
}
