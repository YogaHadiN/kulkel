<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<div class="panelLeft">
				Peserta Simposium
			</div>	
			<div class="panelRight">
				{!! Form::open(['url' => 'seminars/' . $seminar->id . '/pesertas/clear', 'method' => 'post']) !!}
					<button onclick="return confirm('Anda yakin mau menghapus semua peserta di seminar ini?')" class="btn btn-danger btn-sm"><i class="fa fa-times" aria-hidden="true" type="submit"></i> Clear</button>
					<a class="btn btn-success btn-sm" href="{{ url('seminars/' . $seminar->id . '/pesertas/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Peserta</a>
				{!! Form::close() !!}
			</div>
		</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<th>id</th>
						<th>Nama Peserta</th>
						<th>No Telp</th>
						<th>Email</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@if($pesertas->count() > 0)
						@foreach($pesertas as $peserta)
							<tr>
								<td>{{ $peserta->id }}</td>
								<td>{{ $peserta->nama }}</td>
								<td>{{ $peserta->no_telp }}</td>
								<td>{{ $peserta->email }}</td>
								<td nowrap class="autofit"> 
									{!! Form::open(['url' => 'pesertas/' .$peserta->id, 'method' => 'delete']) !!}
										<a class="btn btn-success btn-xs" href="{{ url('pesertas/' . $peserta->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
										{{ Form::submit('del', [
											'class'   => 'btn btn-danger btn-xs',
											'onclick' => 'return confirm("Anda yakin mau menghapus ' . $peserta->id . '-' . $peserta->nama.'?");return false;'
										]) }}
									{!! Form::close() !!}
								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="">
								{!! Form::open(['url' => 'seminars/'. $seminar->id .  '/pesertas/imports', 'method' => 'post', 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
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
	</div>
</div>
