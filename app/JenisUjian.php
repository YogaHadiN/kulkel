<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\JenisUjian;

class JenisUjian extends Model
{
	public static function list(){
		return array('' => '- Jenis Ujian -') + JenisUjian::pluck('jenis_ujian',  'id')->all();
	}
	
}
