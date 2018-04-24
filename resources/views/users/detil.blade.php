<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">{{ $user->nama }}</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-condensed table-bordered">
						<tbody>
							<tr>
								<th class="text-left">Nama</th>
								<td>{{ $user->nama }}</td>
							</tr>
							<tr>
								<th class="text-left">Inisial</th>
								<td>{{ $user->inisial }}</td>
							</tr>
							<tr>
								<th class="text-left">Role</th>
								<td>{{ $user->role->role }}</td>
							</tr>
							<tr>
								<th class="text-left">Tanggal Lahir</th>
								<td>{{ $user->tanggal_lahir_format }}</td>
							</tr>
							<tr>
								<th class="text-left">Tempat Lahir</th>
								<td>{{ $user->tempat_lahir }}</td>
							</tr>
							<tr>
								<th class="text-left">Email</th>
								<td>{{ $user->email }}</td>
							</tr>
							<tr>
								<th class="text-left">No KTP</th>
								<td>{{ $user->no_ktp }}</td>
							</tr>
							<tr>
								<th class="text-left">Bulan Masuk PPDS</th>
								<td>{{ $user->bulan_masuk_ppds_format }}</td>
							</tr>
							<tr>
								<th class="text-left">Alamat Semarang</th>
								<td>{{ $user->alamat_semarang }}</td>
							</tr>
							<tr>
								<th class="text-left">Alamat Asal</th>
								<td>{{ $user->alamat_asal }}</td>
							</tr>
							<tr>
								<th class="text-left">No Telp</th>
								<td>
									<ul>
										@foreach($user->no_telps as $no_telp)	
											<li>{{ $no_telp->no_telp }}</li>
										@endforeach
									</ul>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<a class="btn btn-primary btn-block" href="{{ url('users/' . $user->id . '/edit') }}">Edit</a>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<a class="btn btn-danger btn-block" href="{{ url('users') }}">Cancel</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						@if( Storage::disk('s3')->exists( $user->profile_pic ) )
							<img class="full-width" src="{{ Storage::cloud()->url( $user->profile_pic ) }}" alt="" />
						@else
							<img class="full-width" src="{{ Storage::cloud()->url("no_image.jpeg") }}" alt="" />
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">
							<div class="panelLeft">
								Images Available
							</div>	
							<div class="panelRight">
								<a class="btn btn-primary btn-sm" href="{{ url('users/' . $user->id . '/image') }}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Lihat Detil</a>
							</div>
						</h3>
					</div>
					<div class="panel-body">
						<ul>
							<li>Profile Pic : (
								@if(Storage::cloud()->exists( $user->profile_pic ))
									1
								@else
									0
								@endif
								)
							</li>
							<li>KTP : (
								@if(Storage::cloud()->exists( $user->ktp_pic ))
									1
								@else
									0
								@endif
								)
							</li>
							<li>Ijazah SD : (
								@if(Storage::cloud()->exists( $user->ijazah_sd_pic ))
									1
								@else
									0
								@endif
								)
							</li>
							<li>Ijazah SMP : (
								@if(Storage::cloud()->exists( $user->ijazah_smp_pic ))
									1
								@else
									0
								@endif
								)
							</li>
							<li>Ijazah SMU : (
								@if(Storage::cloud()->exists( $user->ijazah_smu_pic ))
									1
								@else
									0
								@endif
								)
							</li>
							<li>Ijazah SKed : (
								@if(Storage::cloud()->exists( $user->ijazah_sked ))
									1
								@else
									0
								@endif
								)
							</li>
							<li>Ijazah SKed : (
								@if(Storage::cloud()->exists( $user->ijazah_sked ))
									1
								@else
									0
								@endif
								)
							</li>
							<li>Ijazah Dokter : (
								@if(Storage::cloud()->exists( $user->ijazah_sked ))
									1
								@else
									0
								@endif
								)
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

