<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ebook;
use Input;
use App\Yoga;
use DB;
use Storage;

class EbooksController extends Controller
{
	public function index(){
		$ebooks = Ebook::all();
		return view('ebooks.index', compact(
			'ebooks'
		));
	}
	public function create(){
		return view('ebooks.create');
	}
	public function edit($id){
		$ebook = Ebook::find($id);
		return view('ebooks.edit', compact('ebook'));
	}
	public function store(Request $request){
		DB::beginTransaction();
		try {
			
			if ($this->valid( Input::all() )) {
				return $this->valid( Input::all() );
			}
			$saved_file = $this->uploadS3($request, 'materi');

			$ebook                   = new Ebook;
			$ebook->judul            = $saved_file['judul'];
			$ebook->nama_file_materi = $saved_file['nama_file_materi'];
			$ebook->link_materi      = $saved_file['link_materi'];
			$ebook->save();
			$pesan = Yoga::suksesFlash('Ebook baru berhasil dibuat');
			DB::commit();
			return redirect('ebooks')->withPesan($pesan);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$ebook     = Ebook::find($id);
		// Edit disini untuk simpan data
		$ebook->save();
		$pesan = Yoga::suksesFlash('Ebook berhasil diupdate');
		return redirect('ebooks')->withPesan($pesan);
	}
	public function destroy($id){

		DB::beginTransaction();
		try {
			$ebook = Ebook::find($id);
			$judul = $ebook->judul;
			Storage::disk('s3')->delete( $ebook->nama_file_materi );
			$ebook->delete();
			$pesan = Yoga::suksesFlash('Ebook ' . $judul . ' berhasil dihapus');
			DB::commit();
			return redirect('ebooks')->withPesan($pesan);
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
		$ebooks     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$ebooks[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Ebook::insert($ebooks);
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
			$filenametostore = 'ebooks/' . $filename.'_'.time().'.'.$extension;
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
