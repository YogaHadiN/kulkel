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
		$stases = Stase::with('user', 'jenisStase')->orderBy('updated_at', 'desc')->paginate(20);
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
			'mulai'          => 'required',
			'akhir'          => 'required',
			'jenis_stase_id' => 'required'
		];
		
		$validator = \Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
		$data = [];
		$timestamp = date('Y-m-d H:i:s');

		$user_id = Input::get('user_id');
		$mulais  = Input::get('mulai');
		$akhirs  = Input::get('akhir');

		foreach ( Input::get('jenis_stase_id') as $k=>$stase) {
			$data[] = [
				'user_id'        => $user_id,
				'jenis_stase_id' => $stase,
				'mulai'          => Yoga::bulanTahun( $mulais[$k] ) . '-01',
				'akhir'          => date("Y-m-t", strtotime(Yoga::bulanTahun( $akhirs[$k] ) . '-01')),
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
				$pesan .= '<li>Stase <strong>' . JenisStase::find( $d['jenis_stase_id'] )->jenis_stase . ' </strong>Periode <strong>01-' .$mulais[$k] . '</strong> sampai dengan <strong>01-' .date("Y-m-t", strtotime(Yoga::bulanTahun( $akhirs[$k] ))) . '</strong></li>';
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
		$stase = Stase::find( $id );
		$pesan = Yoga::suksesFlash('Stase <strong>' .$stase->user->nama . '</strong> di <strong>' . $stase->jenisStase->jenis_stase . '</strong> periode <strong>' . $stase->mulai->format('01 M Y'). '</strong> s/d <strong>' .$stase->akhir->format('t M Y'). '</strong> berhasil dihapus');
		Stase::destroy( $id );
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
			'mulai'          => 'required',
			'akhir'          => 'required',
			'jenis_stase_id' => 'required'
		];
		
		$validator = \Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
		$mulai = Yoga::bulanTahun(Input::get('mulai')) . '-01';
		$akhir = date("Y-m-t", strtotime(Yoga::bulanTahun( Input::get('akhir') ) . '-01'));

		$stase                 = Stase::find($id);
		$stase->user_id        = Input::get('user_id');
		$stase->mulai          = $mulai;
		$stase->akhir          = $akhir;
		$stase->jenis_stase_id = Input::get('jenis_stase_id');
		$stase->save();

		$pesan = Yoga::suksesFlash('Stase berhasil diubah');
		return redirect('stases')->withPesan($pesan);
	}
	
	
	
	
	
	
}
