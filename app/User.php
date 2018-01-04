<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	protected $dates = ['bulan_masuk_ppds', 'tanggal_lahir'];


	public function getBulanMasukPpdsFormatAttribute(){
		if( is_null ($this->bulan_masuk_ppds)){
			return null;
		}
		return $this->bulan_masuk_ppds->format("M Y");
	}
	public function getTanggalLahirFormatAttribute(){
		if( is_null ($this->tanggal_lahir)){
			return null;
		}
		return $this->tanggal_lahir->format("d M Y");
		
	}
	
	
	public function getBulanMasukPpdsFormat2Attribute(){
		if( is_null ($this->bulan_masuk_ppds)){
			return null;
		}
		return $this->bulan_masuk_ppds->format("m-Y");
	}
	public function getTanggalLahirFormat2Attribute(){
		if( is_null ($this->tanggal_lahir)){
			return null;
		}
		return $this->tanggal_lahir->format("d-m-Y");
		
	}
	public function role(){
		return $this->belongsTo('App\Role');
	}
	public function no_telps(){
		return $this->hasMany('App\NoTelp');
	}
	public function getArraytelpAttribute(){
		$no_telps = $this->no_telps;
		$data = [];
		foreach ($no_telps as $telp) {
			$data[] = [
				'id' => $telp->jenis_telpon_id,
				'jenis_telpon' => $telp->jenisTelpon->jenis_telpon,
				'no_telp' => $telp->no_telp
			];
		}
		return $data;
	}
	public static function list(){
		return array('' => '- User -') + User::pluck('nama',  'id')->all();
	}
	public static function jenisKelamin(){
		return [
			null => ' - Pilih Jenis Kelamin - ',
			'0' => 'Perempuan',
			'1' => 'Laki-laki'
		];
		 
	}
	public static function listNoNull(){
		return  User::pluck('nama',  'id')->all();
	}
	
	
}

