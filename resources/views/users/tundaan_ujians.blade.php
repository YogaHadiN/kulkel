<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Tundaan Ujian</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-condensed table-bordered">
						<thead>
							<tr>
								<th>Jenis Ujian</th>
								{{-- <th>Tertunda Selama</th> --}}
								{{-- <th>Sejak</th> --}}
							</tr>
						</thead>
						<tbody>
							@if(count($tundaan_ujians) > 0)
								@foreach($tundaan_ujians as $ujian)
										<tr>
											<td>{{ $ujian->jenis_ujian }}</td>
										</tr>
								@endforeach
							@else
								<tr>
									<td colspan="3" class="text-center">
										Tidak ada data untuk ditampilkan :p
									</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
