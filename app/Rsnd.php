<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rsnd extends Model
{
	protected $dates = ['tanggal'];
	public function user(){
		return $this->belongsTo('App\User');
	}
}
