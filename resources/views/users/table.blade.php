<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered DT">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nama</th>
				<th>Email</th>
				<th>Role</th>
				<th>Alamat Semarang</th>
				<th>No Telp</th>
				<th>Control</th>
			</tr>
		</thead>
		<tbody>
			@if(count($users) > 0)
				@foreach($users as $user)
					<tr>
						<td>{{ $user->id }}</td>
						<td>{{ $user->nama }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->role->role }}</td>
						<td>{{ $user->alamat_semarang }}</td>
						<td>
							<ul>
								@foreach($user->no_telps as $no_telp)	
									<li>{{ $no_telp->jenisTelpon->jenis_telpon }} : {{ $no_telp->no_telp }}</li>
								@endforeach
							</ul>
						</td>
						<td> 
							<a class="btn btn-success btn-xs" href="{{ url('users/' . $user->id ) }}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
							<a class="btn btn-info btn-xs" href="{{ url('users/' . $user->id . '/riwayat_peminjaman' ) }}"><span class="glyphicon glyphicon-book" aria-hidden="true"></span></a>
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="7" class="text-center">
						Tidak ada data untuk ditampilkan
					</td>
				</tr>
			@endif
		</tbody>
	</table>
</div>
