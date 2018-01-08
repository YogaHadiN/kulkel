<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResidenPegangan extends Model
{
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function residen(){
		return $this->belongsTo('App\User');
	}
}
