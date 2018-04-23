<div class="form-group @if($errors->has('judul')) has-error @endif">
  {!! Form::label('judul', 'Judul', ['class' => 'control-label']) !!}
  {!! Form::text('judul' , null, ['class' => 'form-control rq']) !!}
  @if($errors->has('judul'))<code>{{ $errors->first('judul') }}</code>@endif
</div>
<div class="form-group{{ $errors->has('filename') ? ' has-error' : '' }}">
	{!! Form::label('filename', 'Sertifikat') !!}
	{!! Form::file('filename', ['class' => 'rq']) !!}
		@if (isset($sertifikat) && $sertifikat->filename)
			<p> <img src="{{ \Storage::cloud()->url($sertifikat->filename) }}" class="img-rounded upload full-width" alt="" /> </p>
		@else
			<p> <img src="{{ \Storage::cloud()->url('no_image.jpeg') }}" class="img-rounded upload full-width" alt="" /> </p>
		@endif
	{!! $errors->first('filename', '<p class="help-block">:message</p>') !!}
</div>
