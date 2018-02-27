<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Ujian extends Model
{
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function penguji(){
		return $this->hasMany('App\Penguji');
	}
	public function jenisUjian(){
		return $this->belongsTo('App\JenisUjian');
	}
	public function getMateriAttribute(){
		return $this->jenisUjian->jenis_ujian;
	}
	protected $dates = ['tanggal'];
	public static function monthPassed($awal, $akhir){
		$akhir = date('Y-m-t H:i:s', strtotime($akhir));
		$akhir = date('Y-m-d H:i:s', strtotime($akhir . "+1 day"));
		$awal = new DateTime($awal);
		$akhir = new DateTime($akhir);
		return $awal->diff($akhir)->m + ($awal->diff($akhir)->y*12); // int(8)
	}
	
	
}
