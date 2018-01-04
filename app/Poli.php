<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function jaga(){
		return $this->belongsTo('App\Jaga');
	}
	protected $dates = ['tanggal'];
}
