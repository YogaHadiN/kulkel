<div class="form-group @if($errors->has('user_id')) has-error @endif">
	{!! Form::label('user_id', 'Nama Yang Diuji', ['class' => 'control-label']) !!}
  {!! Form::select('user_id', App\User::list(), null, [
	  'class' => 'form-control selectpick rq', 
	  'data-live-search' => 'true'
  ]) !!}
  @if($errors->has('user_id'))<code>{{ $errors->first('user_id') }}</code>@endif
</div>
<div class="form-group @if($errors->has('tanggal')) has-error @endif">
	{!! Form::label('tanggal', 'Tanggal', ['class' => 'control-label']) !!}
	  @if( isset( $ujian ) )
		  {!! Form::text('tanggal' , $ujian->tanggal->format('d-m-Y'), ['class' => 'form-control tanggal rq']) !!}
	  @else
		  {!! Form::text('tanggal' , null, ['class' => 'form-control tanggal rq']) !!}
	  @endif
  @if($errors->has('tanggal'))<code>{{ $errors->first('tanggal') }}</code>@endif
</div>
<div class="form-group @if($errors->has('jenis_ujian_id')) has-error @endif">
	{!! Form::label('jenis_ujian_id', 'Jenis Ujian', ['class' => 'control-label']) !!}
  {!! Form::select('jenis_ujian_id' , App\JenisUjian::list(), null, ['class' => 'form-control rq']) !!}
  @if($errors->has('jenis_ujian_id'))<code>{{ $errors->first('jenis_ujian_id') }}</code>@endif
</div>
<div class="form-group @if($errors->has('penguji[]')) has-error @endif">
	{!! Form::label('penguji[]', 'Penguji', ['class' => 'control-label']) !!}
  @if( isset( $ujian ) )
	  {!! Form::select('penguji[]' , App\User::listNoNull(), $edit_penguji, [
		  'class'            => 'form-control selectpick rq',
		  'data-live-search' => 'true',
		  'multiple'         => 'multiple'
	  ]) !!}
  @else
	  {!! Form::select('penguji[]' , App\User::listNoNull(), null, [
		  'class'            => 'form-control selectpick rq',
		  'data-live-search' => 'true',
		  'multiple'         => 'multiple'
	  ]) !!}
  @endif
  @if($errors->has('penguji[]'))<code>{{ $errors->first('penguji[]') }}</code>@endif
</div>
