<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubBagian extends Model
{
	public function jenisStase(){
		return $this->belongsTo('App\JenisStase');
	}
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function jenisPenguji(){
		return $this->belongsTo('App\JenisPenguji');
	}
	
}
