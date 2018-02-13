<div class="form-group @if($errors->has('nomor_buku')) has-error @endif">
	{!! Form::label('nomor_buku', 'Nomor Buku', ['class' => 'control-label']) !!}
  {!! Form::text('nomor_buku', null, ['class' => 'form-control rq']) !!}
  @if($errors->has('nomor_buku'))<code>{{ $errors->first('nomor_buku') }}</code>@endif
</div>
<div class="form-group @if($errors->has('nama_buku')) has-error @endif">
	{!! Form::label('nama_buku', 'Nama Buku', ['class' => 'control-label']) !!}
  {!! Form::text('nama_buku', null, ['class' => 'form-control rq']) !!}
  @if($errors->has('nama_buku'))<code>{{ $errors->first('nama_buku') }}</code>@endif
</div>
<div class="form-group @if($errors->has('pengarang')) has-error @endif">
	{!! Form::label('pengarang', 'Pengarang', ['class' => 'control-label']) !!}
  {!! Form::text('pengarang' , null, ['class' => 'form-control rq']) !!}
  @if($errors->has('pengarang'))<code>{{ $errors->first('pengarang') }}</code>@endif
</div>
<div class="form-group @if($errors->has('terbit')) has-error @endif">
	{!! Form::label('terbit', 'Tahun Terbit', ['class' => 'control-label']) !!}
  {!! Form::text('terbit' , null, ['class' => 'form-control rq']) !!}
  @if($errors->has('terbit'))<code>{{ $errors->first('terbit') }}</code>@endif
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		@if( isset($buku) )
			<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Update</button>
			{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
		@else
			<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
			{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
		@endif
	</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<a class="btn btn-danger btn-block" href="{{ url('library') }}">Cancel</a>
		</div>
</div>

