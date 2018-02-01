<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stase;
use App\JenisStase;
use App\Yoga;
use App\User;
use Input;

class StasesController extends Controller
{
	public function __construct()
	{
		$this->middleware('adminOnly', ['only' => ['update', 'destroy']]);
	}
	public function index(){
		$stases = Stase::with('user', 'jenisStase')->orderBy('mulai', 'desc')->get();
		return view('stases.index', compact(
			'stases'
		));

	}
	public function create(){
		return view('stases.create');
	}
	public function store(){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'user_id'        => 'required',
			'periode_bulan'  => 'required',
			'jenis_stase_id' => 'required',
		];
		
		$validator = \Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
		$data = [];
		$timestamp = date('Y-m-d H:i:s');

		$user_id = Input::get('user_id');
		$periode_bulans = Input::get('periode_bulan');

		foreach ( Input::get('jenis_stase_id') as $k=>$stase) {
			$data[] = [
				'user_id'        => $user_id,
				'jenis_stase_id' => $stase,
				'periode_bulan'  => Yoga::bulanTahun( $periode_bulans[$k] ) . '-01',
				'created_at'     => $timestamp,
				'updated_at'     => $timestamp
			];
		}
		if (Stase::insert($data)) {
			$nama_user   = User::find( $user_id )->nama;
			$stases      = JenisStase::whereIn('id', Input::get('jenis_stase_id') )->get();
			$data_stases = [];
			foreach ($stases as $stase) {
				$data_stases[] = $stase->jenis_stase;
			}
			$pesan          = 'Stase <strong>' . $nama_user . ' </strong>pada tanggal ';
			$pesan         .= '<ul>';
			foreach ($data as $k=> $d) {
				$pesan .= '<li>Stase <strong>' . JenisStase::find( $d['jenis_stase_id'] )->jenis_stase . ' </strong>Periode <strong>' .$periode_bulans[$k] . '</strong></li>';
			}
			$pesan         .= '</ul>';
			$pesan         .= 'Berhasil diinput';
			$pesan          = Yoga::suksesFlash($pesan);
		} else {
			$pesan          = Yoga::gagalFlash('Stase gagal diinput');
		}
		return redirect('stases')->withPesan($pesan);
	}
	public function destroy($id){
		Stase::destroy( $id );
		$pesan = Yoga::suksesFlash('Stase berhasil dihapus');
		return redirect('stases')->withPesan($pesan);
	}
	public function edit($id){
		$stase = Stase::find( $id );
		return view('stases.edit', compact(
			'stase'
		));
	}
	public function update($id){

		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'user_id'        => 'required',
			'periode_bulan'  => 'required',
			'jenis_stase_id' => 'required',
		];
		
		$validator = \Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
		$stase                 = Stase::find($id);
		$stase->user_id        = Input::get('user_id');
		$stase->periode_bulan  = Yoga::bulanTahun(Input::get('periode_bulan')) . '-01';
		$stase->jenis_stase_id = Input::get('jenis_stase_id');
		$stase->save();

		$pesan = Yoga::suksesFlash('Stase berhasil diubah');
		return redirect('stases')->withPesan($pesan);
	}
	
	
	
	
	
	
}
