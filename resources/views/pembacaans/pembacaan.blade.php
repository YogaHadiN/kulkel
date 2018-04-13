<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered DT">
		<thead>
			<tr>
				<th class="autofit">Tanggal</th>
				<th class="autofit">Presentan</th>
				<th>Judul</th>
				<th class="autofit">Action</th>
			</tr>
		</thead>
		<tbody>
			@if($pembacaans->count() > 0)
				@foreach($pembacaans as $pembacaan)
					<tr>
						<td class="autofit">{{ $pembacaan->tanggal->format('d M y') }}</td>
						<td class="autofit">{{ $pembacaan->user->inisial }}</td>
						<td>{{ $pembacaan->judul }}</td>
						<td nowrap class="autofit">
							{!! Form::open(['url' => 'pembacaans/' . $pembacaan->id, 'method' => 'delete']) !!}
							@if( isset($user) )
								{!! Form::text('user_create', $user->id, ['class' => 'form-control hide']) !!}
								{!! Form::text('user_id', $user->id, ['class' => 'form-control hide']) !!}
							@endif
								<a class="btn btn-info btn-xs" href="{{ url('pembacaans/' . $pembacaan->id ) }}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
								<a class="btn btn-warning btn-xs" href="{{ url('pembacaans/' . $pembacaan->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
								<button class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin ingin menghapus {{ $pembacaan->id }} - {{ $pembacaan->judul }} ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
							{!! Form::close() !!}
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="">
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
