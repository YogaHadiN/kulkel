<div class="form-group @if($errors->has('user_id')) has-error @endif">
	{!! Form::label('user_id', 'Nama Residen', ['class' => 'control-label']) !!}
  {!! Form::select('user_id' , App\User::list(), null, ['class' => 'form-control selectpick rq', 'data-live-search' => 'true']) !!}
  @if($errors->has('user_id'))<code>{{ $errors->first('user_id') }}</code>@endif
</div>
<div class="form-group @if($errors->has('jaga_id')) has-error @endif">
	{!! Form::label('jaga_id', 'Jaga', ['class' => 'control-label']) !!}
  {!! Form::select('jaga_id' , App\Jaga::list(), null, ['class' => 'form-control rq']) !!}
  @if($errors->has('jaga_id'))<code>{{ $errors->first('jaga_id') }}</code>@endif
</div>
<div class="form-group @if($errors->has('tanggal')) has-error @endif">
	{!! Form::label('tanggal', 'Tanggal', ['class' => 'control-label']) !!}
  @if( isset($poli) )
	  {!! Form::text('tanggal' , $poli->tanggal->format('d-m-Y'), ['class' => 'form-control tanggal']) !!}
  @else
	  {!! Form::text('tanggal' , null, ['class' => 'form-control tanggal']) !!}
  @endif
  @if($errors->has('tanggal'))<code>{{ $errors->first('tanggal') }}</code>@endif
</div>
