<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topik;
use App\Seminar;
use Input;
use App\Yoga;
use DB;
use Storage;

class TopiksController extends Controller
{
	public function __construct()
	{
		/* $this->middleware('adminOnly', ['except' => ['index', 'show']]); */
	}
	public function index(){
		$topiks = Topik::all();
		return view('topiks.index', compact(
			'topiks'
		));
	}
	public function create(){
		return view('topiks.create');
	}
	public function edit($id){
		$topik = Topik::with('seminar')->where('id', $id)->first();
		return view('topiks.edit', compact('topik'));
	}
	public function store(Request $request){
		DB::beginTransaction();
		try {
			
			$messages = [
				'required' => ':attribute Harus Diisi',
			];
			$rules = [
				'topik'       => 'required',
				'seminar_id'  => 'required',
				'materi'      => 'max:8000',
				'pembicara'   => 'required',
				'jam_mulai'   => 'required'
			];
			
			$validator = \Validator::make(Input::all(), $rules, $messages);
			if ($validator->fails())
			{
				return \Redirect::back()->withErrors($validator)->withInput();
			}

			/* return date("H:i:s", strtotime(Input::get('jam_mulai'))); */

			$topik              = new Topik;
			$topik->topik       = Input::get('topik');
			$topik->seminar_id  = Input::get('seminar_id');
			$topik->pembicara   = Input::get('pembicara');
			$topik->jam_mulai   = date("H:i:s", strtotime(Input::get('jam_mulai')));
			$topik->save();

			$saved_file = $this->uploadS3($request, 'materi', Input::get('seminar_id'));
			$topik->link_materi      = $saved_file['link'];
			$topik->nama_file_materi = $saved_file['file_name'];
			$topik->save();
			$pesan = Yoga::suksesFlash('Topik baru berhasil dibuat');
			DB::commit();
			return redirect('seminars/' . Input::get('seminar_id'))->withPesan($pesan);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
	}
	public function update($id, Request $request){
		DB::beginTransaction();
		try {
				$messages = [
					'required' => ':attribute Harus Diisi',
			];
			$rules = [
				'topik'       => 'required',
				'seminar_id'  => 'required',
				'pembicara'   => 'required',
				'jam_mulai'   => 'required',
				'materi'      => 'max:8000'
			];
			
			$validator = \Validator::make(Input::all(), $rules, $messages);
			if ($validator->fails())
			{
				return \Redirect::back()->withErrors($validator)->withInput();
			}
			$topik     = Topik::find($id);
			/* return $topik->nama_file_materi; */

			$topik->topik       = Input::get('topik');
			$topik->seminar_id  = Input::get('seminar_id');
			$topik->pembicara   = Input::get('pembicara');
			$topik->jam_mulai   = date("H:i:s", strtotime(Input::get('jam_mulai')));
			$topik->save();

			if (Input::hasFile('materi')) {
				$saved_file              = $this->uploadS3($request, 'materi');
				$topik->link_materi      = $saved_file['link'];
				$topik->nama_file_materi = $saved_file['file_name'];
				if ($topik->save()) {
					Storage::disk('s3')->delete( $topik->nama_file_materi );
				}
			}
			$pesan = Yoga::suksesFlash('Topik berhasil diupdate');
			DB::commit();
			return redirect('seminars/' . $topik->seminar_id)->withPesan($pesan);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
	}
	public function destroy($id){
		DB::beginTransaction();
		try {
			$topik = Topik::find($id);
			Storage::disk('s3')->delete( $topik->nama_file_materi );
			$seminar_id= $topik->seminar_id;
			$topik->delete();
			$pesan = Yoga::suksesFlash('Topik berhasil dihapus');
			DB::commit();
			return redirect('seminars/' . $seminar_id)->withPesan($pesan);
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
		$topiks     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$topiks[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Topik::insert($topiks);
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
	public function createTopik($id){
		$seminar = Seminar::find($id);
		return view('topiks.create', compact(
			'seminar'
		));
	}
	public function uploadS3($request, $name, $seminar_id){
		if($request->hasFile($name)) {
			//get filename with extension
			$filenamewithextension = $request->file($name)->getClientOriginalName();
			//get filename without extension
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			//get file extension
			$extension = $request->file($name)->getClientOriginalExtension();
			//filename to store
			$filenametostore = 'seminars/' . $seminar_id . '/' . $filename.'_'.time().'.'.$extension;

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
