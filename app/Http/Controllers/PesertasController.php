<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peserta;
use App\Yoga;
use Input;

class PesertasController extends Controller
{
	public function edit($id){
		$peserta = Peserta::find($id);
		return view('pesertas.edit', compact(
			'peserta'
		));
	}
	public function update($id){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'nama' => 'required',
			'seminar_id' => 'required'
		];
		
		$validator = \Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}

		$peserta             = Peserta::find($id);
		$peserta->nama       = Input::get('nama');
		$peserta->seminar_id = Input::get('seminar_id');
		$peserta->no_telp    = Input::get('no_telp');
		$peserta->email      = Input::get('email');
		$peserta->save();

		$pesan = Yoga::suksesFlash('peserta ' . Input::get('nama') . ' <strong>BERHASIL</strong> diupdate');
		return redirect('seminars/' . $peserta->seminar_id)->withPesan($pesan);
	}

	public function destroy($id){

		$peserta    = Peserta::find($id);
		$seminar_id = $peserta->seminar_id;

		$peserta->delete();

		$pesan = Yoga::suksesFlash('Peserta berhasil dihapus');
		return redirect('seminars/' . $seminar_id)->withPesan($pesan);
	}
	
	
	
}
