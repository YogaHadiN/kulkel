<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
	
}
