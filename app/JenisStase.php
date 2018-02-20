<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\JenisStase;

class JenisStase extends Model
{
	public static function list(){
		return array('' => '- Jenis Stase -') + JenisStase::pluck('jenis_stase',  'id')->all();
	}
	public function user(){
		return $this->belongsTo('App\User');
	}
}
