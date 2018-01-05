<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stase;
use App\Yoga;
use Input;

class StasesController extends Controller
{
	public function __construct()
	{
		$this->middleware('adminOnly', ['only' => 'update', 'destroy']);
	}
	public function index(){
		$stases = Stase::all();
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
		$stase                 = new Stase;
		$stase->user_id        = Input::get('user_id');
		$stase->periode_bulan  = Yoga::bulanTahun(Input::get('periode_bulan')) . '-01';
		$stase->jenis_stase_id = Input::get('jenis_stase_id');
		$stase->save();

		$pesan = Yoga::suksesFlash('Stase Baru berhasil dibuat');
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
