<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">
			<div class="panelLeft">
				Ujian
			</div>
			<div class="panelRight">
				<a class="btn btn-primary" href="{{ url('users/' . $user->id . '/create/ujians') }}"><i class="fa fa-plus" aria-hidden="true"></i> Buat Ujian</a>
			</div>
		</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Jenis Ujian</th>
						<th>Penguji</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@if($user->ujian->count() > 0)
						@foreach($user->ujian as $ujian)
							<tr>
								<td>{{ $ujian->tanggal->format('d M Y') }}</td>
								<td>{{ $ujian->jenisUjian->jenis_ujian }}</td>
								<td>
									@foreach( $ujian->penguji as $penguji )
										<li>{{ $penguji->user->nama }}</li>
									@endforeach
								</td>
								<td nowrap class="autofit">
									{!! Form::open(['url' => 'ujians/' . $ujian->id, 'method' => 'delete']) !!}
										<a class="btn btn-warning btn-sm" href="{{ url('users/' . $user->id . '/ujians/'. $ujian->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
										{!! Form::hidden('user_delete', $user->id, ['class' => 'form-control']) !!}
										{!! Form::hidden('user_id', $user->id, ['class' => 'form-control']) !!}
										<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ $ujian->id }} - {{ $ujian->jenisUjian->jenis_ujian }} ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
									{!! Form::close() !!}
								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="3" class="text-center">Tidak ada data untuk ditampilkan</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
		
	</div>
</div>
