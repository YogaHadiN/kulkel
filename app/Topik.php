<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{
	public function seminar(){
		return $this->belongsTo('App\Seminar');
	}
}
