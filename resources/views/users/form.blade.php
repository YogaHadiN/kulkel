<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('nama')) has-error @endif">
		  {!! Form::label('nama', 'Nama', ['class' => 'control-label']) !!}
		  {!! Form::text('nama', null, ['class' => 'form-control rq']) !!}
		  @if($errors->has('nama'))<code>{{ $errors->first('nama') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('inisial')) has-error @endif">
		  {!! Form::label('inisial', 'Inisial', ['class' => 'control-label']) !!}
		  {!! Form::text('inisial', null, ['class' => 'form-control']) !!}
		  @if($errors->has('inisial'))<code>{{ $errors->first('inisial') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('no_ktp')) has-error @endif">
		  {!! Form::label('no_ktp', 'Nomor KTP', ['class' => 'control-label']) !!}
		  {!! Form::text('no_ktp' , null, ['class' => 'form-control']) !!}
		  @if($errors->has('no_ktp'))<code>{{ $errors->first('no_ktp') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('sex')) has-error @endif">
		  {!! Form::label('sex', 'Jenis Kelamin', ['class' => 'control-label']) !!}
		  {!! Form::select('sex', App\User::jenisKelamin(), null, ['class' => 'form-control rq']) !!}
		  @if($errors->has('sex'))<code>{{ $errors->first('sex') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('nomor_induk')) has-error @endif">
		  {!! Form::label('nomor_induk', 'Nomor Induk', ['class' => 'control-label']) !!}
		  {!! Form::text('nomor_induk' , null, ['class' => 'form-control']) !!}
		  @if($errors->has('nomor_induk'))<code>{{ $errors->first('nomor_induk') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('role_id')) has-error @endif">
		  {!! Form::label('role_id', 'Role', ['class' => 'control-label']) !!}
		  {!! Form::select('role_id' , App\Role::list(), null, ['class' => 'form-control rq']) !!}
		  @if($errors->has('role_id'))<code>{{ $errors->first('role_id') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('tanggal_lahir')) has-error @endif">
		  {!! Form::label('tanggal_lahir', 'Tanggal Lahir') !!}
		  @if( isset($user) )
			  {!! Form::text('tanggal_lahir', $user->tanggal_lahir_format2, ['class' => 'form-control tanggal']) !!}
			  @if($errors->has('tanggal_lahir'))<code>{{ $errors->first('tanggal_lahir') }}</code>@endif
		  @else
			  {!! Form::text('tanggal_lahir', null, ['class' => 'form-control tanggal']) !!}
			  @if($errors->has('tanggal_lahir'))<code>{{ $errors->first('tanggal_lahir') }}</code>@endif
		  @endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('tanggal_lahir')) has-error @endif">
		  {!! Form::label('tempat_lahir', 'Tempat Lahir', ['class' => 'control-label']) !!}
		  {!! Form::text('tempat_lahir' , null, ['class' => 'form-control']) !!}
		  @if($errors->has('tempat_lahir'))<code>{{ $errors->first('tempat_lahir') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('bulan_masuk_ppds')) has-error @endif">
		  {!! Form::label('bulan_masuk_ppds', 'Bulan Masuk', ['class' => 'control-label']) !!}
		  @if( isset($user) )
			  {!! Form::text('bulan_masuk_ppds' , $user->bulan_masuk_ppds_format2, ['class' => 'form-control bulanTahun']) !!}
			  @if($errors->has('bulan_masuk_ppds'))<code>{{ $errors->first('bulan_masuk_ppds') }}</code>@endif
		  @else
			  {!! Form::text('bulan_masuk_ppds' , null, ['class' => 'form-control bulanTahun']) !!}
			  @if($errors->has('bulan_masuk_ppds'))<code>{{ $errors->first('bulan_masuk_ppds') }}</code>@endif
		  @endif
		</div>
	</div>
</div>
<div class="form-group @if($errors->has('alamat_asal')) has-error @endif">
  {!! Form::label('alamat_asal', 'Alamat Asal', ['class' => 'control-label']) !!}
  {!! Form::textarea('alamat_asal' , null, ['class' => 'form-control textareacustom']) !!}
  @if($errors->has('alamat_asal'))<code>{{ $errors->first('alamat_asal') }}</code>@endif
</div>
<div class="form-group @if($errors->has('alamat_semarang')) has-error @endif">
  {!! Form::label('alamat_semarang', 'Alamat Semarang') !!}
  {!! Form::textarea('alamat_semarang' , null, ['class' => 'form-control textareacustom']) !!}
  @if($errors->has('alamat_semarang'))<code>{{ $errors->first('alamat_asal') }}</code>@endif
</div>
<div class="row">
	<div class="table-responsive">
		<table id="tableTelp" class="table table-hover table-condensed table-bordered">
			<thead>
				<tr>
					<th>Jenis Telpon</th>
					<th>Nomor Telpon</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@if( isset( $user ) )
					@foreach( $user->no_telps as $k => $telp )
						<tr>
							<td>
								{!! Form::select('jenis_telpon_id[]' , App\JenisTelpon::list(), $telp->jenis_telpon_id, [
								  'class' => 'form-control jenis_telpon'
							  ]) !!}
							</td>
							<td>
								{!! Form::text('no_telp[]', $telp->no_telp, array(
									'class'         => 'form-control no_telp'
								))!!}
							</td>
							<td>
								@if( $k == $user->no_telps->count() -1 )
								<button class="btn btn-primary btn-sm" type="button" onclick="tambahTelp(this);">
									<i class="fa fa-plus" aria-hidden="true"></i>
								</button>
								@else
								<button class="btn btn-danger btn-sm" type="button" onclick="kurangTelp(this);">
									<i class="fa fa-minus" ariprimarya-hidden="true"></i>
								</button>
								@endif
							</td>
						</tr>
					@endforeach
				@else
				<tr>
					<td>
					  {!! Form::select('jenis_telpon_id[]' , App\JenisTelpon::list(), null, [
						  'class' => 'form-control jenis_telpon'
					  ]) !!}
					</td>
					<td>
						{!! Form::text('no_telp[]', null, array(
							'class'         => 'form-control no_telp'
						))!!}
					</td>
					<td>
						<button class="btn btn-primary btn-sm" type="button" onclick="tambahTelp(this);">
							<i class="fa fa-plus" aria-hidden="true"></i>
						</button>
					</td>
				</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>
<div class="form-group @if($errors->has('email')) has-error @endif">
  {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
  {!! Form::text('email' , null, ['class' => 'form-control rq']) !!}
  @if($errors->has('email'))<code>{{ $errors->first('email') }}</code>@endif
</div>
<div class="form-group @if($errors->has('password')) has-error @endif">
  {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
  {!! Form::password('password' ,['class' => 'form-control', 'placeholder' => 'kosongkan bila tidak mau diubah']) !!}
  @if($errors->has('password'))<code>{{ $errors->first('password') }}</code>@endif
</div>
<div class="form-group @if($errors->has('password_confirmation')) has-error @endif">
  {!! Form::label('password_confirmation', 'Repeat Password', ['class' => 'control-label']) !!}
  {!! Form::password('password_confirmation', ['class' => 'form-control',  'placeholder' => 'kosongkan bila tidak mau diubah']) !!}
  @if($errors->has('password_confirmation'))<code>{{ $errors->first('password_confirmation') }}</code>@endif
</div>
<div class="table-responsive hide">
	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>Jenis Telpon</th>
				<th>No Telpon</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="contoh">
			<tr>
				<td>
					{!! Form::select('jenis_telpon_id[]', App\JenisTelpon::list(), null, ['class' => 'form-control jenis_telpon']) !!}
				</td>
				<td>
					{!! Form::text('no_telp[]', null, ['class' => 'form-control no_telp']) !!}
				</td>
				<td>
					<button class="btn btn-primary btn-sm" type="button" onclick="tambahTelp(this);return false">
						<i class="fa fa-plus" aria-hidden="true"></i>
					</button>
				</td>
			</tr>
		</tbody>
	</table>
</div>
