<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
	public static function boot(){
		parent::boot();
		self::creating(function($poli){
			return false;
			$jaga_id = $poli->jaga_id;
			$jaga    = $poli->jaga->jaga;
			$tanggal = $poli->tanggal;

			$polis   = Poli::where('jaga_id', $jaga_id)->where('tanggal', $tanggal)->first();
			if ( $polis ) {
				$pesan = 'Maaf jaga <strong> ' . $jaga . '</strong> pada tanggal <strong>' . $tanggal->format('d M Y') . ' </strong>sudah diambil oleh <strong>' . $username . ' </strong>';
				Session::flash('pesan', Yoga::gagalFlash($pesan));
				return false;
			} else {
				$pesan = Yoga::suksesFlash('Jadwal baru berhasil dibuat');
				Session::flash('pesan', $pesan);
				return true;
			}
		});
	}
	
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function jaga(){
		return $this->belongsTo('App\Jaga');
	}
	protected $dates = ['tanggal'];
}
