<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gardenia extends Model
{
	protected $dates = ['tanggal'];
	public function user(){
		return $this->belongsTo('App\User');
	}
}
