<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;

class Role extends Model
{
	public static function list(){
		return array('' => '- Pilih -') + Role::pluck('role', 'id')->all();
	}
	
}
