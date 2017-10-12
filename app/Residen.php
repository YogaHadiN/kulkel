<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residen extends Model
{
    protected $morphClass = 'App\Residen';
    protected $dates = ['tanggal_lahir', 'bulan_masuk_ppds'];
    public function no_telps(){
        return $this->morphMany('App\NoTelp', 'telponable');
    }
	public function anaks(){
		return $this->hasMany('App\Anak');
	}
}
