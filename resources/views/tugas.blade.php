<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<h2>
			Poli {{ date('M Y') }}
		</h2>
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Jenis Jaga</th>
					</tr>
				</thead>
				<tbody>
					@if($poli_bulan_inis->count() > 0)
						@foreach($poli_bulan_inis as $poli)
							@if( $poli->tanggal->format('Y-m-d') == date('Y-m-d') )
								<tr class="info">
							@else
								<tr>
							@endif
								<td>
									<a class="btn btn-warning btn-sm" href="{{ url('polis/' . $poli->id . '/edit') }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									{{ $poli->tanggal->format('d M Y, l') }}
								</td>
								<td>{{ $poli->jaga->jaga }}</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="2" class="text-center">
								Tidak ada data untuk ditampilkan 
							</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<h2>Kosme {{ date('M Y') }}</h2>
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<th>tanggal</th>
					</tr>
				</thead>
				<tbody>
					@if($gardenias->count() > 0)
						@foreach($gardenias as $gardenia)
							@if( $gardenia->tanggal->format('Y-m-d') == date('Y-m-d') )
								<tr class="info">
							@else
								<tr>
							@endif
								<td>{{ $gardenia->tanggal->format('d M Y') }}</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="1" class="text-center">
								Tidak ada data untuk ditampilkan 
							</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
		
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<h2>RSND {{ date('M Y') }}</h2>
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<th>tanggal</th>
					</tr>
				</thead>
				<tbody>
					@if($rsnds->count() > 0)
						@foreach($rsnds as $rsnd)
							@if( $rsnd->tanggal->format('Y-m-d') == date('Y-m-d') )
								<tr class="info">
							@else
								<tr>
							@endif
									<td>{{ $rsnd->tanggal->format('d M Y') }}</td>
								</tr>
						@endforeach
					@else
						<tr>
							<td colspan="1" class="text-center">
								Tidak ada data untuk ditampilkan 
							</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
		
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h2>Pembacaan</h2>
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Jenis</th>
						<th>Pembahas</th>
						<th>Moderator</th>
					</tr>
				</thead>
				<tbody>
					@if($pembacaan_bulan_inis->count() > 0)
						@foreach($pembacaan_bulan_inis as $pembacaan)
							@if( $pembacaan->tanggal->format('Y-m-d') == date('Y-m-d') )
								<tr class="info">
							@else
								<tr>
							@endif
								<td>
									<a class="btn btn-warning btn-sm" href="{{ url('pembacaans/' . $pembacaan->id . '/edit') }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>

									{{ $pembacaan->tanggal->format('d M Y') }}</td>
								<td>{{ $pembacaan->jenisPembacaan->jenis_pembacaan }}</td>
								<td>
									<ul>
										@foreach($pembacaan->pembahas as $pembahas)	
											<li>{{  $pembahas->user->nama }}</li>
										@endforeach
									</ul>
								</td>
								<td>
									<ul>
										@foreach($pembacaan->moderator as $moderator)	
											<li>{{  $moderator->user->nama }}</li>
										@endforeach
									</ul>
								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="5" class='text-center'>
								Tidak ada data untuk ditampilkan
							</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>

	
	</div>
</div>
<div role="tabpanel" class="tab-pane" id="pembacaan">

</div>

