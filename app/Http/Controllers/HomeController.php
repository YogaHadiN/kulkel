<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Poli;
use App\Stase;
use App\Gardenia;
use App\Rsnd;
use App\Pembacaan;


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

		$month = date('Y-m');

		$poli_bulan_inis      = Poli::where('user_id', $id)->where('tanggal', 'like', $month . '%' )->orderBy('tanggal')->get();
		$stases    = Stase::where('user_id', $id)->where('periode_bulan', 'like', $month . '%' )->orderBy('periode_bulan')->get();
		$gardenias    = Gardenia::where('user_id', $id)->where('tanggal', 'like', $month . '%' )->orderBy('tanggal')->get();
		$rsnds    = Rsnd::where('user_id', $id)->where('tanggal', 'like', $month . '%' )->orderBy('tanggal')->get();
		$pembacaan_bulan_inis = Pembacaan::where('user_id', $id)->where('tanggal', 'like', $month . '%' )->orderBy('tanggal')->get();


		return view('home', compact(
			'poli_bulan_inis',
			'stases',
			'rsnds',
			'gardenias',
			'pembacaan_bulan_inis'
		));
    }
}
