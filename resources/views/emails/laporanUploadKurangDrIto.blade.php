<h1>Laporan Upload Data Aplikasi</h1>
<br />
<p>Maaf izin mengirimkan laporan belum upload</p>
<div>
	<table>
		<thead>
			<tr>
				<td>Nama</td>
				<td>Pembacaan</td>
				<td>Belum Upload</td>
			</tr>
		</thead>
		@foreach($lengkap as $leng)	
		<tr>
			<td>{{ $leng['user']->nama  }}</td>
			<td>{{ $leng['jumlah_pembacaan']}}</td>
			<td>{{ $leng['belum_diisi']}}</td>
		</tr>
		@endforeach
	</table>
</div>
<p>Terima Kasih</p>
