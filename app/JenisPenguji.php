<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\JenisPenguji;

class JenisPenguji extends Model
{
	public static function list(){
		return array('' => '- Jabatan -') + JenisPenguji::pluck('jenis_penguji',  'id')->all();
	}
}
