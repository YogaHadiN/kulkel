<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
	protected $dates = ['tanggal'];
	public function topik(){
		return $this->hasMany('App\Topik');
	}
}
