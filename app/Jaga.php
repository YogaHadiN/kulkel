<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jaga extends Model
{
	public static function list(){
		return array('' => '- Jaga -') + Jaga::pluck('jaga',  'id')->all();
	}
}
