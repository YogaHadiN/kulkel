<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
	public function seminar(){
		return $this->belongsTo('App\Seminar');
	}
}
