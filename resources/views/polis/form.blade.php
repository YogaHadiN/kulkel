<div class="form-group" @if($errors->has('user_id')) class="has-error" @endif>
  {!! Form::label('user_id', 'Nama Residen') !!}
  @if( isset( $poli ) )
	  {!! Form::select('user_id' , App\User::list(), null, ['class' => 'form-control rq', 'readonly' => 'true']) !!}
  @else
	  {!! Form::select('user_id' , App\User::list(), null, ['class' => 'form-control selectpick rq', 'data-live-search' => 'true']) !!}
  @endif
  @if($errors->has('user_id'))<code>{{ $errors->first('user_id') }}</code>@endif
</div>
<div class="form-group" @if($errors->has('jaga_id')) class="has-error" @endif>
  {!! Form::label('jaga_id', 'Jaga') !!}
  {!! Form::select('jaga_id' , App\Jaga::list(), null, ['class' => 'form-control rq']) !!}
  @if($errors->has('jaga_id'))<code>{{ $errors->first('jaga_id') }}</code>@endif
</div>
<div class="form-group" @if($errors->has('tanggal')) class="has-error" @endif>
  {!! Form::label('tanggal', 'Tanggal') !!}
  @if( isset($poli) )
	  {!! Form::text('tanggal' , $poli->tanggal->format('d-m-Y'), ['class' => 'form-control tanggal']) !!}
  @else
	  {!! Form::text('tanggal' , null, ['class' => 'form-control tanggal']) !!}
  @endif
  @if($errors->has('tanggal'))<code>{{ $errors->first('tanggal') }}</code>@endif
</div>
