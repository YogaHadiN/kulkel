<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perpus extends Model
{
	protected $table="perpus";
	use App\Model;
	use Input;
	use App\Yoga;
	use DB;
	public function index(){
		$model_plural = Model::all();
		return view('model_plural.index', compact(
			'model_plural'
		));
	}
	public function create(){
		return view('model_plural.create');
	}
	public function edit($id){
		$model_singular = Model::find($id);
		return view('model_plural.edit', compact('model_singular'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$model_singular       = new Model;
		// Edit disini untuk simpan data
		$model_singular->save();
		$pesan = Yoga::suksesFlash('Model baru berhasil dibuat');
		return redirect('model_plural')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$model_singular     = Model::find($id);
		// Edit disini untuk simpan data
		$model_singular->save();
		$pesan = Yoga::suksesFlash('Model berhasil diupdate');
		return redirect('model_plural')->withPesan($pesan);
	}
	public function destroy($id){
		Model::destroy($id);
		$pesan = Yoga::suksesFlash('Model berhasil dihapus');
		return redirect('model_plural')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);

		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();

		$model_plural     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$model_plural[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Model::insert($model_plural);
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
