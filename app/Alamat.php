<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
	public function alamatable(){
		return $this->morphto();
	}
}
