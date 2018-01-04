<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembahas extends Model
{
	public function user(){
		return $this->belongsTo('App\User');
	}
}
