<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poli;
use App\Yoga;
use App\User;
use App\Jaga;
use Input;

class PolisController extends Controller
{
	public function __construct()
	{
		/* $this->middleware('adminOnly', ['only' => ['update', 'destroy']]); */
	}
	public function index(){
		$polis = Poli::with('user', 'jaga')->orderBy('updated_at', 'desc')->paginate(20);
		return view('polis.index', compact(
			'polis'
		));
	}
	public function create(){
		return view('polis.create');
	}
	public function destroy($id){
		$poli = Poli::find( $id );
		Poli::destroy($id);
		$pesan = Yoga::suksesFlash('Jadwal <strong>' .$poli->user->nama .'</strong> pada tanggal <strong>' . $poli->tanggal->format('d M Y'). '</strong> sebagai <strong> ' . $poli->jaga->jaga . '</strong> berhasil dihapus');
		return redirect('polis')->withPesan($pesan);
	}
	public function update($id){
		$poli          = Poli::find($id);
		$poli->user_id = Input::get('user_id');
		$poli->jaga_id = Input::get('jaga_id');
		$poli->tanggal = Yoga::datePrep(Input::get('tanggal'));
		$poli->save();
		$pesan = Yoga::suksesFlash('Jadwal berhasil diubah');
		return redirect('polis')->withPesan($pesan);
	}
	
	public function edit($id){
		$poli = Poli::find( $id );

		return view('polis.edit', compact(
			'poli'
		));
	}
	
	
	public function store(){
		/* return Input::all(); */ 
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'tanggal' => 'required',
		];
		
		$validator = \Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}

		$tanggal   = Input::get('tanggal');
		$tanggal   = Yoga::datePrep($tanggal);

		$polis['create']     = [];
		$polis['update']     = [];
		
		$polis     = $this->updateAtauBuatPoli($polis, $tanggal, Input::get('jatul'), 'jatul', 1);
		$polis     = $this->updateAtauBuatPoli($polis, $tanggal, Input::get('jagem'), 'jagem', 2);
		$polis     = $this->updateAtauBuatPoli($polis, $tanggal, Input::get('jagut'), 'jagut', 3);
		$polis     = $this->updateAtauBuatPoli($polis, $tanggal, Input::get('jabay'), 'jabay', 4);


		Poli::insert($polis['create']);
		$pesan = '';

		if ( count( $polis['create'] ) ) {
			$pesan .= '<br />Jaga poli yang berhasil ditambahkan : ';
			$pesan .= '<ul>';
			foreach ($polis['create'] as $poli) {
				$pesan .= '<li>';
				$pesan .= '<strong>' . User::find($poli['user_id'])->nama . '</strong> berhasil didaftarkan jaga tanggal <strong>' . Yoga::updateDatePrep($tanggal) .  ' </strong>sebagai <strong>' . Jaga::find($poli['jaga_id'])->jaga . '</strong>' ;
				$pesan .= '</li>';
			}
			$pesan .= '</ul>';
		}
		if ( count( $polis['update'] ) ) {
			$pesan .= 'Poli yang berhasil diupdate';
			$pesan .= '<ul>';
			foreach ($polis['update'] as $poli) {
				$pesan .= '<li>';
				$pesan .= '<strong>' . User::find($poli['user_id'])->nama . '</strong> berhasil diubah menjadi tanggal <strong>' . Yoga::updateDatePrep($tanggal) .  ' </strong>sebagai <strong>' . Jaga::find($poli['jaga_id'])->jaga . '</strong>' ;
				$pesan .= '</li>';

			}
			$pesan .= '</ul>';
		}
		$pesan = Yoga::suksesFlash($pesan);
		return redirect('polis')->withPesan($pesan);

	}
	public function getPoliJaga(){
		$tanggal = Input::get('tanggal');
		$tanggal = Yoga::datePrep($tanggal);
		$polis   = Poli::where('tanggal', $tanggal)->get();

		$data['jatul'] = null;
		$data['jagem'] = null;
		$data['jabay'] = null;
		$data['jagut'] = null;
		foreach ($polis as $poli) {
			if ($poli->jaga_id == 1) {
				$data['jatul'] = $poli->user_id;
			} elseif( $poli->jaga_id == 2){
				$data['jagem'] = $poli->user_id;
			} elseif( $poli->jaga_id == 3 ){
				$data['jagut'] = $poli->user_id;
			} elseif( $poli->jaga_id == 4 ){
				$data['jabay'] = $poli->user_id;
			}
		}
		return $data;
	}
	private function updateAtauBuatPoli($data, $tanggal, $user_id, $jaga, $jaga_id){
		if(!is_null($user_id)){
			$timestamp = date('Y-m-d H:i:s');
			try {
				$poli          = Poli::where('tanggal', $tanggal)->where('jaga_id', $jaga_id)->firstOrFail();
				$poli->user_id = $user_id;
				$poli->jaga_id = $jaga_id;
				$poli->updated_at = $timestamp;
				$poli->save();

				$data['update'][] = [
					'user_id' => $user_id,
					'jaga_id' => $jaga_id,
					'tanggal' => $tanggal,
				];
			} catch (\Exception $e) {
				$data['create'][] = [
					'user_id'    => $user_id,
					'jaga_id'    => $jaga_id,
					'tanggal'    => $tanggal,
					'created_at' => $timestamp,
					'updated_at' => $timestamp
				];
			}
		}
		return $data;
	}
	
}
