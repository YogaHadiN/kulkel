<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\JenisTelpon;

class JenisTelpon extends Model
{
	protected $guarded = ['id'];

	public static function list(){
		return array('' => '- Jenis -') + JenisTelpon::pluck('jenis_telpon',  'id')->all();
	}
	
}
