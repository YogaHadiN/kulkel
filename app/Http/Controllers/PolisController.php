<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poli;
use App\Yoga;
use Input;

class PolisController extends Controller
{
	public function index(){
		$polis = Poli::all();
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
		/* return Input::all(); */ 

		$timestamp = date('Y-m-d H:i:s');
		$poli = [];
		if ( !empty( Input::get('jatul') ) ) {
			$poli[] = [
				'user_id' => Input::get('jatul'),
				'jaga_id' => 1,
				'tanggal' => Yoga::datePrep( Input::get('tanggal') ),
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}

		if ( !empty( Input::get('jagem') ) ) {
			$poli[] = [
				'user_id' => Input::get('jagem'),
				'jaga_id' => 2,
				'tanggal' => Yoga::datePrep( Input::get('tanggal') ),
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		if ( !empty( Input::get('jagut') ) ) {
			$poli[] = [
				'user_id' => Input::get('jagut'),
				'jaga_id' => 3,
				'tanggal' => Yoga::datePrep( Input::get('tanggal') ),
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		if ( !empty( Input::get('jabay') ) ) {
			$poli[] = [
				'user_id' => Input::get('jabay'),
				'jaga_id' => 4,
				'tanggal' => Yoga::datePrep( Input::get('tanggal') ),
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		if ( Poli::insert($poli) ) {
			$pesan = Yoga::suksesFlash('Jadwal baru berhasil dibuat');
		} else {
			$pesan = Yoga::gagalFlash('Tidak ada jadwal yang dibuat');
		}
		return redirect('polis')->withPesan($pesan);
	}
}
