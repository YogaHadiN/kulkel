<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoTelp extends Model
{
	protected $guarded = ['id'];
	public function telponable(){
		return $this->morphto();
	}
	public function jenisTelpon(){
		return $this->belongsTo('App\JenisTelpon');
	}
}
