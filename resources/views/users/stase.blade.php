<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">
					<div class="panelLeft">
						Stase
					</div>
					<div class="panelRight">
						<a class="btn btn-info btn-sm" href="{{ url('users/ ' . $user->id . '/stase/create') }}"> <i class="fa fa-plus" aria-hidden="true"></i>Buat Stase Baru</a>
					</div>
				</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-condensed table-bordered" id="tableStase">
						<thead>
							<tr>
								<th>Stase</th>
								<th>Mulai</th>
								<th>Akhir</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@if( $stasesResidens->count() )	
								@foreach($stasesResidens as $staseResiden)	
									{{-- if( 16-02-2018 >= 01-01-2018 && 31-03-2018 >= 16-02-2018 ) --}}
									@if( strtotime(date('Y-m-d H:i:s')) >= strtotime($staseResiden->mulai) && strtotime($staseResiden->akhir) >= strtotime(date('Y-m-d H:i:s')) )
									<tr class="info">
									@else
									<tr>
									@endif
										<td>{{ $staseResiden->jenisStase->jenis_stase }}</td>
										<td>{{ $staseResiden->mulai->format('d M Y') }}</td>
										<td>{{ $staseResiden->akhir->format('t M Y') }}</td>
										<td> 


											{!! Form::open(['url' => 'stases/' . $staseResiden->id , 'method' => 'delete']) !!}
											<a class="btn btn-warning btn-sm" href="{{ url('users/' . $user->id . '/stase/' . $staseResiden->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
											<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus stase ini?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
											{!! Form::close() !!}
										</td> 
									</tr>
								@endforeach
							@else
								<tr>
									<td class='text-center' colspan="4"> Tidak ada data untuk ditampilkan </td>
								</tr>
							@endif
						
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>	

