<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Seminar;

class Seminar extends Model
{
	protected $dates = ['tanggal'];
	public function topik(){
		return $this->hasMany('App\Topik');
	}
	public function peserta(){
		return $this->hasMany('App\Peserta');
	}
	public static function lists(){
		return array('' => '- Pilih seminar -') + Seminar::pluck('seminar',  'id')->all();
	}
}
