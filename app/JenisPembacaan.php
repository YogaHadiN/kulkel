<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPembacaan extends Model
{
	public static function list(){
		return array('' => '- Jenis pembacaan -') + JenisPembacaan::pluck('jenis_pembacaan',  'id')->all();
	}
	
}
