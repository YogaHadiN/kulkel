<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use App\ResidenPegangan;
use App\Yoga;

class ResidenPegangansController extends Controller
{
	public function index(){
		$pegangans = ResidenPegangan::with('user','residen')->orderBy('updated_at', 'desc')->paginate(20);
		return view('residen_pegangans.index', compact(
			'pegangans'
		));
	}
	public function create(){
		return view('residen_pegangans.create');
	}
	public function edit($id){
		$pegangan = ResidenPegangan::find($id);
		return view('residen_pegangans.edit', compact('pegangan'));
	}
	public function store(){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'user_id' => 'required',
			'residen_id' => 'required'
		];
		
		$validator = \Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}

		$pegangan             = new ResidenPegangan;
		$pegangan->user_id    = Input::get('user_id');
		$pegangan->residen_id = Input::get('residen_id');
		$pegangan->save();

		$pesan = Yoga::suksesFlash('Residen Pegangan baru berhasil dibuat');
		return redirect('pegangans/residen')->withPesan($pesan);
	}
	public function update($id){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'user_id' => 'required',
			'residen_id' => 'required'
		];
		
		$validator = \Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}

		$pegangan             = ResidenPegangan::find($id);
		$pegangan->user_id    = Input::get('user_id');
		$pegangan->residen_id = Input::get('residen_id');
		$pegangan->save();

		$pesan = Yoga::suksesFlash('Residen Pegangan baru berhasil diubah');
		return redirect('pegangans/residen')->withPesan($pesan);
		
	}
	public function destroy($id){
		$residen = ResidenPegangan::find( $id );
		$pesan   =  '<strong>' . $residen->residen->nama . '</strong> berhasil dihapus sebagai pegangan dari <strong>' . $residen->user->nama . '</strong>';
		$pesan   = Yoga::suksesFlash($pesan);
		ResidenPegangan::destroy( $id );
		return redirect('pegangans/residen')->withPesan($pesan);
	}
	
	
	
}
