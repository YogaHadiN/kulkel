<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stase extends Model
{
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function jenisStase(){
		return $this->belongsTo('App\JenisStase');
	}
	protected $dates = ['mulai'];
	
}
