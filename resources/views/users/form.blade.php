<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group" @if($errors->has('nama')) class="has-error" @endif>
		  {!! Form::label('nama', 'Nama') !!}
		  {!! Form::text('nama', null, ['class' => 'form-control rq']) !!}
		  @if($errors->has('nama'))<code>{{ $errors->first('nama') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group" @if($errors->has('inisial')) class="has-error" @endif>
		  {!! Form::label('inisial', 'Inisial') !!}
		  {!! Form::text('inisial', null, ['class' => 'form-control rq']) !!}
		  @if($errors->has('inisial'))<code>{{ $errors->first('inisial') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group" @if($errors->has('no_ktp')) class="has-error" @endif>
		  {!! Form::label('no_ktp', 'Nomor KTP') !!}
		  {!! Form::text('no_ktp' , null, ['class' => 'form-control rq']) !!}
		  @if($errors->has('no_ktp'))<code>{{ $errors->first('no_ktp') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group" @if($errors->has('sex')) class="has-error" @endif>
		  {!! Form::label('sex', 'Jenis Kelamin') !!}
		  {!! Form::select('sex', App\User::jenisKelamin(), null, ['class' => 'form-control rq']) !!}
		  @if($errors->has('sex'))<code>{{ $errors->first('sex') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group" @if($errors->has('nomor_induk')) class="has-error" @endif>
		  {!! Form::label('nomor_induk', 'Nomor Induk') !!}
		  {!! Form::text('nomor_induk' , null, ['class' => 'form-control rq']) !!}
		  @if($errors->has('nomor_induk'))<code>{{ $errors->first('nomor_induk') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group" @if($errors->has('role_id')) class="has-error" @endif>
		  {!! Form::label('role_id', 'Role') !!}
		  {!! Form::select('role_id' , App\Role::list(), null, ['class' => 'form-control rq']) !!}
		  @if($errors->has('role_id'))<code>{{ $errors->first('role_id') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group" @if($errors->has('tanggal_lahir')) class="has-error" @endif>
		  {!! Form::label('tanggal_lahir', 'Tanggal Lahir') !!}
		  @if( isset($user) )
			  {!! Form::text('tanggal_lahir', $user->tanggal_lahir_format2, ['class' => 'form-control rq tanggal']) !!}
			  @if($errors->has('tanggal_lahir'))<code>{{ $errors->first('tanggal_lahir') }}</code>@endif
		  @else
			  {!! Form::text('tanggal_lahir', null, ['class' => 'form-control rq tanggal']) !!}
			  @if($errors->has('tanggal_lahir'))<code>{{ $errors->first('tanggal_lahir') }}</code>@endif
		  @endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group" @if($errors->has('tempat_lahir')) class="has-error" @endif>
		  {!! Form::label('tempat_lahir', 'Tempat Lahir') !!}
		  {!! Form::text('tempat_lahir' , null, ['class' => 'form-control rq']) !!}
		  @if($errors->has('tempat_lahir'))<code>{{ $errors->first('tempat_lahir') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group" @if($errors->has('bulan_masuk_ppds')) class="has-error" @endif>
		  {!! Form::label('bulan_masuk_ppds', 'Bulan Masuk') !!}
		  @if( isset($user) )
			  {!! Form::text('bulan_masuk_ppds' , $user->bulan_masuk_ppds_format2, ['class' => 'form-control rq bulanTahun']) !!}
			  @if($errors->has('bulan_masuk_ppds'))<code>{{ $errors->first('bulan_masuk_ppds') }}</code>@endif
		  @else
			  {!! Form::text('bulan_masuk_ppds' , null, ['class' => 'form-control rq bulanTahun']) !!}
			  @if($errors->has('bulan_masuk_ppds'))<code>{{ $errors->first('bulan_masuk_ppds') }}</code>@endif
		  @endif
		</div>
	</div>
</div>
<div class="form-group" @if($errors->has('alamat_asal')) class="has-error" @endif>
  {!! Form::label('alamat_asal', 'Alamat Asal') !!}
  {!! Form::textarea('alamat_asal' , null, ['class' => 'form-control textareacustom rq']) !!}
  @if($errors->has('alamat_asal'))<code>{{ $errors->first('alamat_asal') }}</code>@endif
</div>
<div class="form-group" @if($errors->has('alamat_semarang')) class="has-error" @endif>
  {!! Form::label('alamat_semarang', 'Alamat Semarang') !!}
  {!! Form::textarea('alamat_semarang' , null, ['class' => 'form-control textareacustom rq']) !!}
  @if($errors->has('alamat_semarang'))<code>{{ $errors->first('alamat_asal') }}</code>@endif
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		@include('users.telps')
	</div>
</div>
<div class="form-group" @if($errors->has('email')) class="has-error" @endif>
  {!! Form::label('email', 'Email') !!}
  {!! Form::text('email' , null, ['class' => 'form-control rq']) !!}
  @if($errors->has('email'))<code>{{ $errors->first('email') }}</code>@endif
</div>
<div class="form-group" @if($errors->has('password')) class="has-error" @endif>
  {!! Form::label('password', 'Password') !!}
  {!! Form::password('password' ,['class' => 'form-control', 'placeholder' => 'kosongkan bila tidak mau diubah']) !!}
  @if($errors->has('password'))<code>{{ $errors->first('password') }}</code>@endif
</div>
<div class="form-group" @if($errors->has('password_confirmation')) class="has-error" @endif>
  {!! Form::label('password_confirmation', 'Repeat Password') !!}
  {!! Form::password('password_confirmation', ['class' => 'form-control',  'placeholder' => 'kosongkan bila tidak mau diubah']) !!}
  @if($errors->has('password_confirmation'))<code>{{ $errors->first('password_confirmation') }}</code>@endif
</div>
