<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class PinjamBuku extends Model
{
	public static function boot(){
		parent::boot();
		self::creating(function($pinjam){
			$perpus_id = $pinjam->perpus_id;
			if ( PinjamBuku::where('perpus_id', $perpus_id)->whereNull('tanggal_kembalikan')->count() ) {
				$pesan = "Bukunya belum dikembalikan, jadi tidak bisa dipinjamkan";
				Session::flash('pesan', Yoga::gagalFlash($pesan));
				return false;
			} else {
				$pesan = Yoga::suksesFlash('Buku <strong> ' . $pinjam->perpus->nama_buku . ' </strong>berhasil dipinjam oleh <strong>' . $pinjam->peminjam->nama . '</strong>');
				Session::flash('pesan', $pesan);
				return true;
			}
		});
	}
	
	public function peminjam(){
		return $this->belongsTo('App\User');
	}
	public function admin(){
		return $this->belongsTo('App\User');
	}
	public function adminKembalikan(){
		return $this->belongsTo('App\User');
	}
	public function perpus(){
		return $this->belongsTo('App\Perpus');
	}
	public function getTanggalPinjamFormatAttribute(){
		if ( !is_null( $this->tanggal_pinjam ) ) {
			return $this->tanggal_pinjam->format('d M Y');
		}
		return null;
	}

	public function getPerkiraanTanggalKembalikanFormatAttribute(){
		if ( !is_null( $this->perkiraan_tanggal_kembalikan ) ) {
			return $this->perkiraan_tanggal_kembalikan->format('d M Y');
		}
		return null;
	}
	public function getTanggalKembalikanFormatAttribute(){
		if ( !is_null( $this->tanggal_kembalikan ) ) {
			return $this->tanggal_kembalikan->format('d M Y');
		}
		return null;
	}
	protected $dates = ['tanggal_pinjam', 'tanggal_kembalikan', 'perkiraan_tanggal_kembalikan'];
}
