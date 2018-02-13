<div class="form-group @if($errors->has('user_id')) has-error @endif">
	{!! Form::label('user_id', 'Nama User', ['class' => 'control-label']) !!}
  {!! Form::select('user_id' , App\User::list(), null, ['class' => 'form-control selectpick', 'data-live-search' => 'true']) !!}
  @if($errors->has('user_id'))<code>{{ $errors->first('user_id') }}</code>@endif
</div>
<div class="form-group @if($errors->has('staf_id')) has-error @endif">
	{!! Form::label('staf_id', 'Nama Staf', ['class' => 'control-label']) !!}
  {!! Form::select('staf_id' , App\User::list(), null, ['class' => 'form-control selectpick', 'data-live-search' => 'true']) !!}
  @if($errors->has('staf_id'))<code>{{ $errors->first('staf_id') }}</code>@endif
</div>
