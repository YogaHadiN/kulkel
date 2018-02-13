<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('name')) has-error @endif">
		  {!! Form::label('name', 'Nama', ['class' => 'control-label']) !!}
			{!! Form::text('name', null, array(
				'class'         => 'form-control required'
			))!!}
		  @if($errors->has('name'))<code>{{ $errors->first('name') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('alamat'))has-error @endif">
		  {!! Form::label('alamat', 'Alamat', ['class' => 'control-label']) !!}
		  @if(isset($edit) &&  $dosen->alamats->count()  )
				{!! Form::textarea('alamat', $dosen->alamats->first()->alamat, array(
					'class'         => 'form-control textareacustom required'
				))!!}
			@else
				{!! Form::textarea('alamat', null, array(
					'class'         => 'form-control textareacustom required'
				))!!}
			@endif
		  @if($errors->has('alamat'))<code>{{ $errors->first('alamat') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('nip'))has-error @endif">
		  {!! Form::label('nip', 'Nomor Induk Pegawai', ['class' => 'control-label']) !!}
			{!! Form::text('nip', null, array(
				'class'         => 'form-control required'
			))!!}
		  @if($errors->has('nip'))<code>{{ $errors->first('nip') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('email'))has-error @endif">
		  {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
			  @if(isset(  $edit ) && $dosen->emails->count())
				{!! Form::text('email', $dosen->emails->first()->email, array(
					'class'         => 'form-control required'
				))!!}
			@else
				{!! Form::text('email', null, array(
					'class'         => 'form-control required'
				))!!}
			@endif
		  @if($errors->has('email'))<code>{{ $errors->first('email') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('no_telp'))has-error @endif">
		  {!! Form::label('no_telp', 'Nomor Telepon', ['class' => 'control-label']) !!}
		  @if(isset(  $edit ) && $dosen->no_telps->count())
				{!! Form::text('no_telp', $dosen->no_telps->first()->no_telp, array(
					'class'         => 'form-control required'
				))!!}
			@else
				{!! Form::text('no_telp', null, array(
					'class'         => 'form-control required'
				))!!}
			@endif
		  @if($errors->has('no_telp'))<code>{{ $errors->first('no_telp') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('tanggal_lahir'))has-error @endif">
			  {!! Form::label('tanggal_lahir', 'Tanggal Lahir', ['class' => 'control-label']) !!}
			  @if(isset(  $edit, $dosen->tanggal_lahir ) )
				{!! Form::text('tanggal_lahir', $dosen->tanggal_lahir->format('d-m-Y'), array(
					'class'         => 'form-control tanggal'
				))!!}
			@else
				{!! Form::text('tanggal_lahir', null, array(
					'class'         => 'form-control tanggal'
				))!!}
			@endif
		  @if($errors->has('tanggal_lahir'))<code>{{ $errors->first('tanggal_lahir') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('no_ktp'))has-error @endif">
		  {!! Form::label('no_ktp', 'Nomor KTP', ['class' => 'control-label']) !!}
			{!! Form::text('no_ktp', null, array(
				'class'         => 'form-control required'
			))!!}
		  @if($errors->has('no_ktp'))<code>{{ $errors->first('no_ktp') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>
			@if(isset($edit))
				Update
			@else
				Submit
			@endif
		</button>
		{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<a class="btn btn-danger btn-block" href="{{ url('home') }}">Cancel</a>
	</div>
</div>
