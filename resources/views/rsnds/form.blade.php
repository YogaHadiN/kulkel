<div class="form-group" @if($errors->has('user_id')) class="has-error" @endif>
  {!! Form::label('user_id', 'Nama Residen') !!}
  {!! Form::select('user_id' , App\User::list(), null, ['class' => 'form-control selectpick', 'data-live-search' => 'true']) !!}
  @if($errors->has('user_id'))<code>{{ $errors->first('user_id') }}</code>@endif
</div>
<div class="form-group" @if($errors->has('tanggal')) class="has-error" @endif>
  {!! Form::label('tanggal', 'Tanggal') !!}
  @if( isset($rsnd) )
	  {!! Form::text('tanggal' , $rsnd->tanggal->format('d-m-Y'), ['class' => 'form-control tanggal rq']) !!}
  @else
	  {!! Form::text('tanggal' , null, ['class' => 'form-control tanggal rq']) !!}
  @endif
  @if($errors->has('tanggal'))<code>{{ $errors->first('tanggal') }}</code>@endif
</div>
