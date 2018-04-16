<div>
	<h1>Info Jadwal Tundaan Ujian</h1>
	<p>Selamat siang {{ $tundaan['user']->nama }}</p>
	<p>Izin mengirimkan daftar nama residen tundaan ujian</p>
	<br />
	@foreach($tundaan['jenis_ujian'] as $jenis_ujian)	
		<h3>{{ $jenis_ujian->jenis_ujian }}</h3>
		<ul>
			@foreach($jenis_ujian['residen'] as $residen)	
				<li>{{ $residen->nama }}</li>
			@endforeach
		</ul>
		<br />
		<br />
	@endforeach

	<p>terima kasih</p>
</div>
