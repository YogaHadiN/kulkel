<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('nama')) has-error @endif">
		  {!! Form::label('nama', 'Nama', ['class' => 'control-label']) !!}
		  {!! Form::text('nama' , null, ['class' => 'form-control tq']) !!}
		  @if($errors->has('nama'))<code>{{ $errors->first('nama') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('seminar_id')) has-error @endif">
		  {!! Form::label('seminar_id', 'Seminar', ['class' => 'control-label']) !!}
		  {!! Form::select('seminar_id' , App\Seminar::lists(), null, ['class' => 'form-control selectpick']) !!}
		  @if($errors->has('seminar_id'))<code>{{ $errors->first('seminar_id') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('no_telp')) has-error @endif">
		  {!! Form::label('no_telp', 'Nomor Telepon', ['class' => 'control-label']) !!}
		  {!! Form::text('no_telp' , null, ['class' => 'form-control']) !!}
		  @if($errors->has('no_telp'))<code>{{ $errors->first('no_telp') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('email')) has-error @endif">
		  {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
		  {!! Form::text('email' , null, ['class' => 'form-control']) !!}
		  @if($errors->has('email'))<code>{{ $errors->first('email') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
		{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<a class="btn btn-danger btn-block" href="{{ url('home') }}">Cancel</a>
	</div>
</div>
