<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Poli;
use App\Ujian;
use App\Stase;
use App\Gardenia;
use App\Rsnd;
use App\Pembacaan;
use App\Http\Controllers\UsersController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$id = Auth::id();

		$poli_bulan_inis      = $this->paramIndex($id)['poli_bulan_inis'];
		$stases               = $this->paramIndex($id)['stases'];
		$gardenias            = $this->paramIndex($id)['gardenias'];
		$rsnds                = $this->paramIndex($id)['rsnds'];
		$pembacaan_bulan_inis = $this->paramIndex($id)['pembacaan_bulan_inis'];
		$stases = Stase::with('jenisStase.jenisUjian')
						->where('user_id', $id)
						->where('akhir', '<=', date('Y-m-d H:i:s'))
						->get();

		$userController = new UsersController;
		$ujian_sudahs   = Ujian::where('user_id', $id)->where('tanggal', '<=', date('Y-m-d'))->get(['jenis_ujian_id']);
		$tundaan_ujians = $userController->tundaan_ujian($stases, $ujian_sudahs, $id);

		return view('home', compact(
			'poli_bulan_inis',
			'stases',
			'tundaan_ujians',
			'rsnds',
			'gardenias',
			'pembacaan_bulan_inis'
		));
    }
	
	public function paramIndex($id){

		$month = date('Y-m');

		$poli_bulan_inis      = Poli::where('user_id', $id)->where('tanggal', 'like', $month . '%' )->orderBy('tanggal')->get();
		$stases               = Stase::where('user_id', $id)->where('mulai', '>=', $month . '-01' )->where('akhir', '<=', date('Y-m-t') )->get();
		$gardenias            = Gardenia::where('user_id', $id)->where('tanggal', 'like', $month . '%' )->orderBy('tanggal')->get();
		$rsnds                = Rsnd::where('user_id', $id)->where('tanggal', 'like', $month . '%' )->orderBy('tanggal')->get();
		$pembacaan_bulan_inis = Pembacaan::where('user_id', $id)->where('tanggal', 'like', $month . '%' )->orderBy('tanggal')->get();

		return [
			'poli_bulan_inis'      => $poli_bulan_inis,
			'stases'               => $stases,
			'gardenias'            => $gardenias,
			'rsnds'                => $rsnds,
			'pembacaan_bulan_inis' => $pembacaan_bulan_inis
		];
		
	}
	
	
}
