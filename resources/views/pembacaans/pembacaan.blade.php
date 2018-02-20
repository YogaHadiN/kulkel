<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Presentan</th>
				<th>Jenis</th>
				<th>Pembahas</th>
				<th>Moderator</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@if($pembacaans->count() > 0)
				@foreach($pembacaans as $k => $pembacaan)
						@if( strtotime(date('Y-m-d 00:00:00')) == strtotime($pembacaan->tanggal) )
						<tr class="info">
						@else
						<tr>
						@endif
						<td>{{ $pembacaan->tanggal->format('d M Y') }}</td>
						<td>{{ $pembacaan->user->nama }}</td>
						<td>{{ $pembacaan->jenisPembacaan->jenis_pembacaan }}</td>
						<td>
							<ul>
								@foreach($pembacaan->pembahas as $pembahas)	
									<li>{{ $pembahas->user->nama }}</li>
								@endforeach
							</ul>
						</td>
						<td>
							<ul>
								@foreach($pembacaan->moderator as $mod)	
									<li>{{ $mod->user->nama }}</li>
								@endforeach
							</ul>
						</td>

						<td nowrap class="autofit">
							{!! Form::open(['url' => 'pembacaans/' . $pembacaan->id, 'method' => 'delete']) !!}
								@if( isset( $user ) )
									<a class="btn btn-warning btn-sm" href="{{ url('users/' . $user->id . '/pembacaans/' . $pembacaan->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
									{!! Form::hidden('user_create', $user->id, ['class' => 'form-control']) !!}
									{!! Form::hidden('user_id', $user->id, ['class' => 'form-control']) !!}
								@else
								<a class="btn btn-warning btn-sm" href="{{ url('pembacaans/' . $pembacaan->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
								@endif
								<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus Pembacaan {{ $pembacaan->user->nama }} pada tanggal {{ $pembacaan->tanggal->format('d M Y') }}?');return false" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
							{!! Form::close() !!}
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="7">
						{!! Form::open(['url' => 'pembacaans/imports', 'method' => 'post', 'files' => 'true']) !!}
							<div class="form-group">
								{!! Form::label('file', 'Data tidak ditemukan, upload data?') !!}
								{!! Form::file('file') !!}
								{!! Form::submit('Upload', ['class' => 'btn btn-primary', 'id' => 'submit']) !!}
							</div>
						{!! Form::close() !!}
					</td>
				</tr>
			@endif
		</tbody>
	</table>
					</div>
