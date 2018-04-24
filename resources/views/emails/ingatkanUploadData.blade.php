<div class="text-center">
	<h1>Mengingatkan Upload Data</h1>
	<p>Mengingatkan {{ $lengkap['user']->panggilan }}</p>
	<p>
	@if($lengkap['user']->sex)
		Bapak
	@else
		Ibu
	@endif
	Telah mengisi {{ $lengkap['jumlah_pembacaan'] }} pembacaan, namun masih ada {{ $lengkap['belum_diisi'] }} pembacaan yang belum upload dokumen ke website
	</p>
	<p>Mohon agar dapat mengisi pembacaan dengan lengkap demi kelancaran akreditasi</p>
	<p>terima kasih</p>
	<br />
	<br />
	<br />
</div>
