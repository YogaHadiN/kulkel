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
	public function getArraytelpAttribute(){
		$no_telps = $this->no_telps;
		$ret = [];
		foreach ($no_telps as $telp) {
			$ret[] = [
				'id' => $telp->jenis_telpon_id,
				'jenis_telpon' => $telp->jenisTelpon['jenis_telpon'],
				'no_telp' => $telp->no_telp
			];
		}
		return $ret;
	}
}
