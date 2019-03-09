
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="panelLeft">
					Topik
				</div>
				<div class="panelRight">
					<a class="btn btn-success btn-sm" href="{{ url('topiks/create/' . $seminar->id) }}"><i class="fa fa-plus" aria-hidden="true"></i> Topik</a>
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>id</th>
							<th>Topik</th>
							<th>Pembicara</th>
							<th>Jam Mulai</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($topiks->count() > 0)
							@foreach($topiks as $topik)
								<tr>
									<td>{{ $topik->id }}</td>
									<td> <a class="" href="{{ $topik->link_materi }}">{{ $topik->topik }}</a> </td>
									<td>{{ $topik->pembicara }}</td>
									<td>{{ $topik->jam_mulai }}</td>
									<td nowrap class="autofit"> 
										{!! Form::open(['url' => 'topiks/' .$topik->id, 'method' => 'delete']) !!}

											<!-- Button trigger modal -->
											<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#materi{{$topik->id}}">
											<span class=" glyphicon glyphicon-qrcode" aria-hidden="true"></span>
											</button>
											<a class="btn btn-info btn-xs" href="{{ $topik->link_materi }}"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></a>
											<a class="btn btn-success btn-xs" href="{{ url('topiks/' . $topik->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
											{{ Form::submit('del', [
												'class'   => 'btn btn-danger btn-xs',
												'onclick' => 'return confirm("Anda yakin mau menghapus ' . $topik->id . '-' . $topik->name.'?");return false;'
											]) }}
										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="6" class="text-center">
									Tidak ada data untuk ditampilkan
								</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
