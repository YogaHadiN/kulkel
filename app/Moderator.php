<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{
	public function user(){
		return $this->belongsTo('App\User');
	}
}
