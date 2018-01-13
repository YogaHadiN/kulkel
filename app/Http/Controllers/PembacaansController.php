<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembacaan;
use App\Pembahas;
use App\Moderator;
use App\Yoga;
use Input;
use DB;

class PembacaansController extends Controller
{
	public function __construct()
	{
		$this->middleware('adminOnly', ['only' => ['update', 'destroy']]);
	}
	public function index(){
		$pembacaans = Pembacaan::all();

		return view('pembacaans.index', compact(
			'pembacaans'
		));
	}
	public function create(){
		return view('pembacaans.create');
	}
	public function store(){
		DB::beginTransaction();
		try {
			
			$pembacaan                     = new Pembacaan;
			$pembacaan->user_id            = Input::get('user_id');
			$pembacaan->jenis_pembacaan_id = Input::get('jenis_pembacaan_id');
			$pembacaan->tanggal            = Yoga::datePrep(Input::get('tanggal'));
			$pembacaan->save();

			$timestamp = date('Y-m-d H:i:s');
			$moderator = [];
			$pembahas = [];
			foreach ( Input::get('moderator') as $mod) {
				$moderator[] = [
					'user_id'      => $mod,
					'pembacaan_id' => $pembacaan->id,
					'created_at'   => $timestamp,
					'updated_at'   => $timestamp
				];
			}
			foreach ( Input::get('pembahas') as $pemb) {
				$pembahas[] = [
					'user_id'      => $pemb,
					'pembacaan_id' => $pembacaan->id,
					'created_at'   => $timestamp,
					'updated_at'   => $timestamp
				];
			}
			Pembahas::insert($pembahas);
			Moderator::insert($moderator);

			$pesan = Yoga::suksesFlash('Pembacaan berhasil diinput');
			DB::commit();
			return redirect('pembacaans')->withPesan($pesan);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
	}
	public function destroy($id){
		Pembacaan::destroy( $id );
		$pesan = Yoga::suksesFlash('Pembacaan berhasil dihapus');
		return redirect('pembacaans')->withPesan($pesan);
	}
	public function edit($id){
		
		$pembacaan = Pembacaan::find( $id );
		$pembahas_array_id = [];

		foreach ($pembacaan->pembahas as $p) {
			$pembahas_array_id[] = $p->user->id;
		}
		foreach ($pembacaan->moderator as $p) {
			$moderator_array_id[] = $p->user->id;
		}


		return view('pembacaans.edit', compact(
			'pembacaan',
			'moderator_array_id',
			'pembahas_array_id'
		));

	}
	public function update($id){
		$pembacaan                     = Pembacaan::find($id);
		$pembacaan->user_id            = Input::get('user_id');
		$pembacaan->judul              = Input::get('judul');
		$pembacaan->doi                = Input::get('doi');
		$pembacaan->jenis_pembacaan_id = Input::get('jenis_pembacaan_id');
		$pembacaan->tanggal            = Yoga::datePrep(Input::get('tanggal'));
		$pembacaan->save();

		Moderator::where('pembacaan_id', $id)->delete();
		Pembahas::where('pembacaan_id', $id)->delete();

		$moderator = [];
		$pembahas = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ( Input::get('moderator') as $moderator) {
			$moderator[] = [
				'user_id'      => $moderator,
				'pembacaan_id' => $pembacaan->id,
				'created_at'   => $timestamp,
				'updated_at'   => $timestamp
			];
		}
		foreach ( Input::get('pembahas') as $pembahas) {
			$pembahas[] = [
				'user_id'      => $pembahas,
				'pembacaan_id' => $pembacaan->id,
				'created_at'   => $timestamp,
				'updated_at'   => $timestamp
			];
		}

		Pembahas::insert($pembahas);
		Moderator::insert($moderator);

		$pesan = Yoga::suksesFlash('Pembacaan berhasil di Update');
		return redirect('pembacaans')->withPesan($pesan);
	}
	
	
	
	
	
	
}
