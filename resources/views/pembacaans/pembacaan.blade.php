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
						<td rowspan="2">{{ $pembacaan->tanggal->format('d M Y') }}</td>
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
									<a class="btn btn-warning btn-xs" href="{{ url('users/' . $user->id . '/pembacaans/' . $pembacaan->id . '/edit' ) }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
									{!! Form::hidden('user_create', $user->id, ['class' => 'form-control']) !!}
									{!! Form::hidden('user_id', $user->id, ['class' => 'form-control']) !!}
								@else
								<a class="btn btn-warning btn-xs" href="{{ url('pembacaans/' . $pembacaan->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
								@endif
								<button class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin ingin menghapus Pembacaan {{ $pembacaan->user->nama }} pada tanggal {{ $pembacaan->tanggal->format('d M Y') }}?');return false" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
							{!! Form::close() !!}
						</td>
					</tr>
						<tr>
							<td colspan="4">
								@if(!empty($pembacaan->link_materi))
									<a class="btn btn-info btn-xs" href="{{ $pembacaan->link_materi }}"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> </a>
									<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#pembacaan{{ $pembacaan->id }}">
										<span class="glyphicon glyphicon-qrcode" aria-hidden="true"></span>
									</button>
								@endif
								@if(!empty($pembacaan->judul))
									{{ $pembacaan->judul }}
								@else
									<i>Belum ada judul yang ditentukan</i>
								@endif
							</td>
							<td>
								@if(!empty($pembacaan->link_materi_terjemahan))
									<a class="btn btn-info btn-xs" href="{{ $pembacaan->link_materi_terjemahan }}"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> </a>
									<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#terjemahan{{ $pembacaan->id }}">
									<span class="glyphicon glyphicon-qrcode" aria-hidden="true"></span>
								</button>
									Terjemahan
								@else
									<i>Terjemahan belum diupload</i>
								@endif
							</td>
								<!-- Button trigger modal -->
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
	@foreach($pembacaans as $pembacaan)
		<!-- Modal -->
		<div class="modal fade" id="pembacaan{{$pembacaan->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">{{ $pembacaan->judul }}</h4>
			  </div>
			  <div class="modal-body text-center">
				  <div>
					  @if(!empty($pembacaan->link_materi))
						  <img src="{!! url( 'qrcode?text=' . urlencode($pembacaan->link_materi) ) !!}" alt="">
					  @endif
				  </div>
				  <div>
					  {{ $pembacaan->link_materi }}
				  </div>
			  </div>
			</div>
		  </div>
		</div>
		<div class="modal fade" id="terjemahan{{ $pembacaan->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">{{ $pembacaan->judul }}</h4>
			  </div>
			  <div class="modal-body text-center">
				  <div>
					  @if(!empty($pembacaan->link_materi_terjemahan))
						  <img src="{!! url( 'qrcode?text=' . urlencode($pembacaan->link_materi_terjemahan) ) !!}" alt="">
					  @endif
				  </div>
				  <div>
					  {{ $pembacaan->link_materi }}
				  </div>
			  </div>
			</div>
		  </div>
		</div>
		@endforeach
