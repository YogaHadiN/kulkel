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
		$this->middleware('adminOnly', ['only' => ['update', 'destroy']]);
	}
	public function index(){
		$polis = Poli::with('user', 'jaga')->orderBy('id', 'desc')->paginate(20);
		return view('polis.index', compact(
			'polis'
		));
	}
	public function create(){
		return view('polis.create');
	}
	public function destroy($id){
		Poli::destroy( $id );
		$pesan = Yoga::suksesFlash('Jadwal berhasil dihapus');
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
		$gagals    = [];
		$berhasils = [];
		$timestamp = date('Y-m-d H:i:s');
		$poli      = [];
		if ( !empty( Input::get('jatul') ) ) {
			$tanggal = Yoga::datePrep( Input::get('tanggal') );
			$poli_ada    = Poli::where('tanggal', $tanggal)->where('jaga_id', 1)->first();
			if ( $poli_ada ) {
				$gagals[] = [
					'baru' => [
						'user_id' => User::find(Input::get('jatul'))->nama,
						'tanggal' => $tanggal,
						'jaga_id' => Jaga::find(1)->jaga
					],
					'lama' => [
						'user_id' => $poli->user->nama,
						'tanggal' => $poli->tanggal->format('d-m-Y'),
						'jaga_id' => Jaga::find(1)->jaga
					]
				];
			} else {
				$poli[] = [
					'user_id'    => Input::get('jatul'),
					'jaga_id'    => 1,
					'tanggal'    => $tanggal,
					'created_at' => $timestamp,
					'updated_at' => $timestamp
				];
				$berhasils[] = [
					'user'    => User::find(Input::get('jatul'))->nama,
					'jaga_id' => 1
				];
			}
		}

		if ( !empty( Input::get('jagem') ) ) {
			$tanggal = Yoga::datePrep( Input::get('tanggal') );
			$poli_ada =  Poli::where('tanggal', $tanggal)->where('jaga_id', 2)->first();
			if ( $poli_ada ) {
				$gagals[] = [
					'baru' => [
						'user_id' => User::find(Input::get('jagem'))->nama,
						'tanggal' => $tanggal,
						'jaga_id' => Jaga::find(2)->jaga
					],
					'lama' => [
						'user_id' => $poli->user->nama,
						'tanggal' => $poli->tanggal->format('d-m-Y'),
						'jaga_id' => Jaga::find(2)->jaga
					]
				];
			} else {
				$poli[] = [
					'user_id'    => Input::get('jagem'),
					'jaga_id'    => 2,
					'tanggal'    => $tanggal,
					'created_at' => $timestamp,
					'updated_at' => $timestamp
				];
				$berhasils[] = [
					'user'    => User::find(Input::get('jagem'))->nama,
					'jaga_id' => Jaga::find(2)->jaga
				];
			}
		}
		if ( !empty( Input::get('jagut') ) ) {

			$tanggal = Yoga::datePrep( Input::get('tanggal') );
			$poli_ada =  Poli::where('tanggal', $tanggal)->where('jaga_id', 3)->first();
			if ( $poli_ada ) {
				$gagals[] = [
					'baru' => [
						'user_id' => User::find(Input::get('jagut'))->nama,
						'tanggal' => $tanggal,
						'jaga_id' => Jaga::find(3)->jaga
					],
					'lama' => [
						'user_id' => $poli->user->nama,
						'tanggal' => $poli->tanggal->format('d-m-Y'),
						'jaga_id' => Jaga::find(3)->jaga
					]
				];
			} else {
				$poli[] = [
					'user_id' => Input::get('jagut'),
					'jaga_id' => 3,
					'tanggal' => $tanggal,
					'created_at' => $timestamp,
					'updated_at' => $timestamp
				];
				$berhasils[] = [
					'user' => Input::get('jagut'),
					'jaga_id' => 3
				];
			}
		}
		if ( !empty( Input::get('jabay') ) ) {
			$tanggal = Yoga::datePrep( Input::get('tanggal') );
			$poli_ada =  Poli::where('tanggal', $tanggal)->where('jaga_id', 4)->first();
			if ( $poli_ada ) {
				$gagals[] = [
					'baru' => [
						'user_id' => User::find(Input::get('jabay'))->nama,
						'tanggal' => $tanggal,
						'jaga_id' => Jaga::find(4)->jaga
					],
					'lama' => [
						'user_id' => $poli->user->nama,
						'tanggal' => $poli->tanggal->format('d-m-Y'),
						'jaga_id' => Jaga::find(4)->jaga
					]
				];
			} else {
				$poli[] = [
					'user_id' => Input::get('jabay'),
					'jaga_id' => 4,
					'tanggal' => $tanggal,
					'created_at' => $timestamp,
					'updated_at' => $timestamp
				];
				$berhasils[] = [
					'user' => User::find(Input::get('jabay'))->nama,
					'jaga_id' => Jaga::find(4)->jaga
				];
			}
		}


		Poli::insert($poli);

		$pesan = Yoga::suksesFlash('Jadwal baru berhasil dibuat');
		return redirect('polis')->withPesan($pesan);
	}
}
