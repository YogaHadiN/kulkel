<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StafPegangan extends Model
{
	public function staf(){
		return $this->belongsTo('App\User');
	}
	public function user(){
		return $this->belongsTo('App\User');
	}
	
}
