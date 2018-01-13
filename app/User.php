<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Stase;
use App\Ujian;
use App\StafPegangan;
use App\ResidenPegangan;
use App\Moderator;
use App\Pembahas;
use App\Pembacaan;
use App\NoTelp;
use App\Event;
use App\Poli;
use App\Rsnd;
use App\Gardenia;
use Session;
use App\PinjamBuku;
use App\Penguji;

class User extends Authenticatable
{

	public static function boot(){
		parent::boot();
		self::deleting(function($user){
			$stases_count            = Stase::where('user_id', $user->id)->count();
			$ujians_count            = Ujian::where('user_id', $user->id)->count();
			$staf_pegangans_count    = StafPegangan::where('user_id', $user->id)->orWhere('staf_id', $user->id)->count();
			$residen_pegangans_count = ResidenPegangan::where('user_id', $user->id)->orWhere('residen_id', $user->id)->count();
			$moderators_count        = Moderator::where('user_id', $user->id)->count();
			$pembahass_count         = Pembahas::where('user_id', $user->id)->count();
			$pembacaans_count        = Pembacaan::where('user_id', $user->id)->count();
			$no_telps_count          = NoTelp::where('user_id', $user->id)->count();
			$events_count            = Event::where('user_id', $user->id)->count();
			$polis_count             = Poli::where('user_id', $user->id)->count();
			$pinjams_count           = PinjamBuku::where('user_id', $user->id)->count();
			$pengguji_count          = Penguji::where('user_id', $user->id)->count();
			$gardenis_count          = Gardenia::where('user_id', $user->id)->count();
			$rsnds_count             = Rsnd::where('user_id', $user->id)->count();

			if (
				$stases_count ||
				$ujians_count ||
				$staf_pegangans_count ||
				$residen_pegangans_count ||
				$moderators_count ||
				$pembahass_count ||
				$pembacaans_count ||
				$no_telps_count ||
				$events_count ||
				$polis_count ||
				$pinjams_count ||
				$gardenis_count ||
				$rsnds_count ||
				$pengguji_count
			) {
				$pesan = 'Maaf user tidak bisa dihapus, karena masih digunakan di data yang lain';
				Session::flash('pesan', Yoga::gagalFlash($pesan));
				return false;
			}
		});
	}
	
	
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

