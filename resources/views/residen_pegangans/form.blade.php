	<div class="form-group" @if($errors->has('user_id')) class="has-error" @endif>
	  {!! Form::label('user_id', 'Nama User') !!}
	  {!! Form::select('user_id' , App\User::list(), null, ['class' => 'form-control selectpick', 'data-live-search' => 'true']) !!}
	  @if($errors->has('user_id'))<code>{{ $errors->first('user_id') }}</code>@endif
	</div>
	<div class="form-group" @if($errors->has('residen_id')) class="has-error" @endif>
	  {!! Form::label('residen_id', 'Residen Pegangan') !!}
	  {!! Form::select('residen_id' , App\User::list(), null, ['class' => 'form-control selectpick', 'data-live-search']) !!}
	  @if($errors->has('residen_id'))<code>{{ $errors->first('residen_id') }}</code>@endif
	</div>
				
