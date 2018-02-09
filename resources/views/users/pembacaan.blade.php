<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Pembacaan Sudah</h3>
			</div>
			<div class="panel-body">
				
				<div class="table-responsive">
					<table class="table table-hover table-condensed table-bordered">
						<thead>
							<tr>
								<th>Tanggal</th>
								<th>Judul</th>
								<th>Pembahas</th>
								<th>Moderator</th>
							</tr>
						</thead>
						<tbody>
							@if(count($pembacaans_sudah) > 0)
								@foreach($pembacaans_sudah as $pembacaan)
									<tr>
										<td>{{ $pembacaan->tanggal->format('d-m-Y') }}</td>
										<td>{{ $pembacaan->judul }}</td>
										<td>
											<ul>
												@foreach($pembacaan->pembahas as $pembahas)	
													<li>{{ $pembahas->user->inisial }}</li>
												@endforeach
											</ul>
										</td>
										<td>
											<ul>
												@foreach($pembacaan->moderator as $moderator)	
													<li>{{ $moderator->user->nama }}</li>
												@endforeach
											</ul>
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="4">
										Tidak ada data untuk ditampilkan
									</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title">Pembacaan Belum</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-condensed table-bordered">
						<thead>
							<tr>
								<th>Tanggal</th>
								<th>Pembahas</th>
								<th>Moderator</th>
							</tr>
						</thead>
						<tbody>
							@if(count($pembacaans_belum) > 0)
								@foreach($pembacaans_belum as $pembacaan)
									<tr>
										<td>{{ $pembacaan->tanggal->format('d-m-Y') }}</td>
										<td>
											<ul>
												@foreach($pembacaan->pembahas as $pembahas)	
													<li>{{ $pembahas->user->inisial }}</li>
												@endforeach
											</ul>
										</td>
										<td>
											<ul>
												@foreach($pembacaan->moderator as $moderator)	
													<li>{{ $moderator->user->nama }}</li>
												@endforeach
											</ul>
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="4">
										Tidak ada data untuk ditampilkan
									</td>
								</tr>
							@endif
					</table>
						</tbody>
				</div>
				
			</div>
		</div>
	</div>
</div>


