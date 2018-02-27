<div class="text-center">
	<h1>Konfirmasi Peminjaman Perpustakaan</h1>
	<p>Hai {{ $nama }}</p>
	<p>
		Anda akan meminjam buku {{ $nama_buku }}
	</p>
	<p>
		Tekan tombol di bawah ini jika ingin melanjutkan
	</p>

	<a class="btn btn-primary" href="{{ url('library/' . $token . '/konfirmasi') }}">Ya Itu Saya</a>

	<p>terima kasih</p>
	
</div>
