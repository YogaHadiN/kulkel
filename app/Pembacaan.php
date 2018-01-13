<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembacaan extends Model
{
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function jenisPembacaan(){
		return $this->belongsTo('App\JenisPembacaan');
	}
	public function pembahas(){
		return $this->hasMany('App\Pembahas');
	}
	public function moderator(){
		return $this->hasMany('App\Moderator');
	}
	protected $dates = ['tanggal'];
}
