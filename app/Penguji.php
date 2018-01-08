<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penguji extends Model
{
	public function penguji(){
		return $this->belongsTo('App\User');
	}
}
