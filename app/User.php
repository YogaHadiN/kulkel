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
			$pinjams_count           = PinjamBuku::where('peminjam_id', $user->id)->orWhere('admin_id', $user->id)->orWhere('admin_kembalikan_id')->count();
			$pengguji_count          = Penguji::where('penguji_id', $user->id)->count();
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
		self::creating(function($user){
			$allowed_email = ["yoga.dvjul17@gmail.com","nurwidi_andarbeni@yahoo.co.id","arinal.pahlevi@gmail.com","ihatedurian@live.com.au","adel_hime@yahoo.co.id","rindakulkel@gmail.com","adrianacarissa@yahoo.com","teguhp98@gmail.com","marialeleury@gmail.com","ayakulkel@gmail.com","kiky.dvjul17@gmail.com","fadrianip@gmail.com","dhesiariembi82@gmail.com","amelkulkel@gmail.com","intan.dvjul17@gmail.com","zidni.dvjan18@gmail.com","widi.dvjan18@gmail.com","eunice.dvjan18@gmail.com","meiza.dvjan18@gmail.com","hayra.dvjul17@gmail.com","elin.dvjan18@gmail.com","irvin.dvjan18@gmail.com","husnulcut@gmail.com","lydiaasmadi@gmail.com","permanadha@gmail.com","middahnur@yahoo.com","asihbudiastuti60@gmail.com","aria_kusuma83@yahoo.com","itobuwono@gmail.com","diahadriani@yahoo.com","puguhungaran@gmail.com","renniyuniati@yahoo.com","galih_damayanti@yahoo.com","drholyametati@gmail.com","lizaafriliana@ymail.com","muslimina_ina@yahoo.com","radityastuti@gmail.com","retno_iw@yahoo.com","abyasa17@gmail.com","mamat8194@yahoo.com.sg","prasetyowatisubchan@yahoo.com","tamara.dvjul17@gmail.com","yulitaherdiana88@gmail.com","syamsulkulkel@gmail.com","pratiwi.indriana@yahoo.com","sjt.pak.spkk@gmail.com","meilien_bs@yahoo.com","Frista_martha@yahoo.com","e.afrinia@gmail.com","i.mayamail@gmail.com","milkakulkel@gmail.com","suci2suci@gmail.com","dhiana_ew@yahoo.com","inggrid85.ic@gmail.com","dokter_sapi@yahoo.com","emailnyadokterdjoko@yahoo.com","senorita_nadia@yahoo.com","putnasrarasati@gmail.com","susanto_budi@gmail.com","dokter_ray@yahoo.com","widyaratni@yahoo.com","prof.sinistra@gmail.com","dwi_septiana15@yahoo.com","pipit_ardita@yahoo.com","henykurniawati@gmail.com","drmilanyharirahmawati@gmail.com","donwolidonwoli@yahoo.com","secadiga@gmail.com","maybemayra@gmail.com","novikusuma@gmail.com","witz_84@yahoo.com","subakir@gmail.com","PaulusYogyartono@gmail.com","jushadi3@gmail.com","drlewie@gmail.com","irmamochtar@yahoo.com","drsriredjeki@gmail.com","drsugastiasri@gmail.com"];

			if (!in_array($user->email, $allowed_email)) {
				Session::flash('pesan', Yoga::gagalFlash('Maaf, email yang anda masukkan tidak diizinkan'));
				return redirect()->back()->withPesan($pesan);
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

