<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seminar;
use App\Topik;
use App\Peserta;
use Input;
use App\Yoga;
use DB;
use Excel;

class SeminarsController extends Controller
{
	public function __construct()
	{
		/* $this->middleware('adminOnly', ['only' => ['update', 'destroy']]); */
	}
	public function index(){
		$seminars = Seminar::all();
		return view('seminars.index', compact(
			'seminars'
		));
	}
	public function create(){
		return view('seminars.create');
	}
	public function edit($id){
		$seminar = Seminar::find($id);
		return view('seminars.edit', compact('seminar'));
	}
	public function show($id){
		$seminar = Seminar::find($id);
		$topiks = Topik::where('seminar_id', $id)->get();
		$pesertas = Peserta::where('seminar_id', $id)->get();
		return view('seminars.show', compact('topiks', 'seminar', 'pesertas'));
	}
	public function store(Request $request){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'seminar' => 'required',
			'lokasi' => 'required',
			'tanggal' => 'required'
		];
		
		$validator = \Validator::make(Input::all(), $rules, $messages);
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
		$seminar          = new Seminar;
		$seminar->seminar = Input::get('seminar');
		$seminar->lokasi  = Input::get('lokasi');
		$seminar->tanggal = Yoga::datePrep( Input::get('tanggal') );
		$seminar->password = Input::get('password');
		$seminar->save();

		$pesan = Yoga::suksesFlash('Seminar baru berhasil dibuat');
		return redirect('seminars')->withPesan($pesan);
	}
	public function update($id, Request $request){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'seminar' => 'required',
			'lokasi' => 'required',
			'tanggal' => 'required'
		];
		
		$validator = \Validator::make(Input::all(), $rules, $messages);
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
		$seminar           = Seminar::find($id);
		$seminar->seminar  = Input::get('seminar');
		$seminar->lokasi   = Input::get('lokasi');
		$seminar->tanggal  = Yoga::datePrep( Input::get('tanggal') );
		$seminar->password = Input::get('password');
		$seminar->save();
		$pesan = Yoga::suksesFlash('Seminar berhasil diupdate');
		return redirect('seminars')->withPesan($pesan);
	}
	public function destroy($id){
		Seminar::destroy($id);
		$pesan = Yoga::suksesFlash('Seminar berhasil dihapus');
		return redirect('seminars')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$seminars     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$seminars[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Seminar::insert($seminars);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'seminar' => 'required',
			'lokasi'  => 'required',
			'tanggal' => 'required'
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
	public function welcome(){
		$seminars = Seminar::orderBy('created_at')->get();
		return view('seminars.welcome', compact(
			'seminars'
		));
	}
	public function welcomeShow($id){
		$seminar = Seminar::with('topik')->first();
		return view('seminars.welcomeShow', compact(
			'seminar'
		));
	}
	public function createPeserta($id){
		return view('pesertas.create', compact('id'));
	}
	public function storePeserta($id){
		$seminar = Seminar::find($id);
		$peserta             = new Peserta;
		$peserta->nama       = Input::get('nama');
		$peserta->seminar_id = Input::get('seminar_id');
		$peserta->no_telp    = Input::get('no_telp');
		$peserta->email      = Input::get('email');
		$peserta->save();


		$pesan = Yoga::suksesFlash( Input::get('nama') . ' telah <strong>BERHASIL</strong> ditambahkan sebagai peserta baru seminar <strong>' . $seminar->seminar . '</strong>'	);
		return redirect('seminars/' . $id)->withPesan($pesan);
	}
	public function importPeserta($id){
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/'. $file_name, function($reader){
			$reader->all();
		})->get();
		$pesertas     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			if (
				!empty($result['nama'])
			) {
				$pesertas[] = [
					'nama'       => str_replace(array("\r", "\n"), '', $result['nama']),
					'no_telp'    => str_replace(array("\r", "\n"), '', $result['no_telp']),
					'email'      => str_replace(array("\r", "\n"), '', $result['email']),
					'seminar_id' => $id,
					'created_at' => $timestamp,
					'updated_at' => $timestamp
				];
			}
		}
		Peserta::where('seminar_id', $id)->delete();
		Peserta::insert($pesertas);

		$pesan = Yoga::suksesFlash('Import Data Peserta Berhasil');
		return redirect('seminars/' . $id )->withPesan($pesan);
	}
	public function doorprize($id){
		$seminar = Seminar::find($id);
		return view('seminars.doorprize', compact(
			'seminar'
		));
	}
	public function clearPeserta($id){
		Peserta::where('seminar_id', $id)->delete();
		$pesan = Yoga::suksesFlash('Peserta untuk seminar ini berhasil dihapus');
		return redirect('seminars/' . $id)->withPesan($pesan);
	}
	
}
