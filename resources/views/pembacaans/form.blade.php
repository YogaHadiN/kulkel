
<div class="form-group @if($errors->has('user_id')) has-error @endif">
	{!! Form::label('user_id', 'Presentan', ['class' => 'control-label']) !!}
	@if(isset($user_id))
	  {!! Form::select('user_ids', App\User::list(), $user_id, [
		  'class' => 'form-control',
		  'disabled' => 'disabled'
	  ]) !!}
	  {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
	  {!! Form::hidden('user_create', $user_id, ['class' => 'form-control']) !!}
	@else
	  {!! Form::select('user_id', App\User::list(), null, [
		  'class' => 'form-control selectpick rq', 
		  'data-live-search' => 'true'
	  ]) !!}
	@endif
  @if($errors->has('user_id'))<code>{{ $errors->first('user_id') }}</code>@endif
</div>
<div class="form-group @if($errors->has('jenis_pembacaan_id')) has-error @endif">
	{!! Form::label('jenis_pembacaan_id', 'Jenis Pembacaan', ['class' => 'control-label']) !!}
	{!! Form::select('jenis_pembacaan_id' , App\JenisPembacaan::list(), null, ['class' => 'form-control rq', 'onchange' => 'changeJenisPembacaan(this);return false;']) !!}
  @if($errors->has('jenis_pembacaan_id'))<code>{{ $errors->first('jenis_pembacaan_id') }}</code>@endif
</div>
<div class="form-group @if($errors->has('tanggal')) has-error @endif">
	{!! Form::label('tanggal', 'Tanggal', ['class' => 'control-label']) !!}
  @if( isset( $pembacaan ) )
	  {!! Form::text('tanggal' , $pembacaan->tanggal->format('d-m-Y'), ['class' => 'form-control tanggal rq']) !!}
  @else
  {!! Form::text('tanggal' , null, ['class' => 'form-control tanggal rq']) !!}
  @endif
  @if($errors->has('tanggal'))<code>{{ $errors->first('tanggal') }}</code>@endif
</div>
<div class="form-group @if($errors->has('jam')) has-error @endif">
	{!! Form::label('jam', 'Jam', ['class' => 'control-label']) !!}
  @if( isset( $pembacaan ) )
	  {!! Form::text('jam' , $pembacaan->tanggal->format('H:i'), ['class' => 'form-control jam rq']) !!}
  @else
  {!! Form::text('jam' , null, ['class' => 'form-control jam rq']) !!}
  @endif
  @if($errors->has('jam'))<code>{{ $errors->first('jam') }}</code>@endif
</div>
@if( isset( $pembacaan ) )
	<div class="form-group @if($errors->has('judul')) has-error @endif">
		{!! Form::label('judul', 'Judul (Asli, bukan terjemahan)', ['class' => 'control-label']) !!}
		{!! Form::text('judul' , $pembacaan->judul, ['class' => 'form-control']) !!}
	  @if($errors->has('judul'))<code>{{ $errors->first('judul') }}</code>@endif
	</div>
	<div class="form-group @if($errors->has('doi')) has-error @endif">
		{!! Form::label('doi', 'DOI', ['class' => 'control-label']) !!}
		{!! Form::text('doi' , $pembacaan->doi, ['class' => 'form-control']) !!}
	  @if($errors->has('doi'))<code>{{ $errors->first('doi') }}</code>@endif
	</div>
	<div class="form-group{{ $errors->has('materi') ? ' has-error' : '' }}">
		{!! Form::label('materi', 'Upload materi') !!}
		{!! Form::file('materi') !!}
			@if (isset($pembacaan) && $pembacaan->nama_file_materi)
				<p>{{ $pembacaan->nama_file_materi }}</p>
			@endif
		{!! $errors->first('materi', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="upload_terjemahan form-group{{ $errors->has('terjemahan') ? ' has-error' : '' }}">
		{!! Form::label('terjemahan', 'Upload Terjemahan') !!}
		{!! Form::file('terjemahan') !!}
			@if (isset($pembacaan) && $pembacaan->nama_file_materi_terjemahan)
				<p>{{ $pembacaan->nama_file_materi_terjemahan }}</p>
			@endif
		{!! $errors->first('terjemahan', '<p class="help-block">:message</p>') !!}
	</div>
@endif
<div class="form-group @if($errors->has('moderator')) has-error @endif">
	{!! Form::label('moderator', 'Moderator', ['class' => 'control-label']) !!}
  @if( isset( $pembacaan ) )
  {!! Form::select('moderator[]', App\User::listNoNull() , $moderator_array_id, [
	  'class'            => 'form-control selectpick',
	  'multiple'         => 'multiple',
	  'data-live-search' => 'true'
  ]) !!}
  @else
  {!! Form::select('moderator[]', App\User::listNoNull() , null, [
	  'class'            => 'form-control selectpick',
	  'multiple'         => 'multiple',
	  'data-live-search' => 'true'
  ]) !!}
  @endif
  @if($errors->has('moderator'))<code>{{ $errors->first('moderator') }}</code>@endif
</div>
<div class="form-group @if($errors->has('pembahas')) has-error @endif">
	{!! Form::label('pembahas', 'Pembahas', ['class' => 'control-label']) !!}
  @if( isset($pembacaan) )
  {!! Form::select('pembahas[]', App\User::listNoNull() , $pembahas_array_id, [
	  'class'            => 'form-control selectpick',
	  'multiple'         => 'multiple',
	  'data-live-search' => 'true'
  ]) !!}
  @else
  {!! Form::select('pembahas[]', App\User::listNoNull() , null, [
	  'class'            => 'form-control selectpick',
	  'multiple'         => 'multiple',
	  'data-live-search' => 'true'
  ]) !!}
  	
  @endif
  @if($errors->has('pembahas'))<code>{{ $errors->first('pembahas') }}</code>@endif
</div>
