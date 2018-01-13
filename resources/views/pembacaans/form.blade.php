<div class="form-group" @if($errors->has('user_id')) class="has-error" @endif>
  {!! Form::label('user_id', 'Presentan') !!}
  {!! Form::select('user_id', App\User::list(),null, [
	  'class'            => 'form-control selectpick',
	  'data-live-search' => 'true'
  ]) !!}
  @if($errors->has('user_id'))<code>{{ $errors->first('user_id') }}</code>@endif
</div>
<div class="form-group" @if($errors->has('jenis_pembacaan_id')) class="has-error" @endif>
  {!! Form::label('jenis_pembacaan_id', 'Jenis Pembacaan') !!}
  {!! Form::select('jenis_pembacaan_id' , App\JenisPembacaan::list(), null, ['class' => 'form-control rq']) !!}
  @if($errors->has('jenis_pembacaan_id'))<code>{{ $errors->first('jenis_pembacaan_id') }}</code>@endif
</div>
<div class="form-group" @if($errors->has('tanggal')) class="has-error" @endif>
  {!! Form::label('tanggal', 'Tanggal') !!}
  @if( isset( $pembacaan ) )
	  {!! Form::text('tanggal' , $pembacaan->tanggal->format('d-m-Y'), ['class' => 'form-control tanggal rq']) !!}
  @else
  {!! Form::text('tanggal' , null, ['class' => 'form-control tanggal rq']) !!}
  @endif
  @if($errors->has('tanggal'))<code>{{ $errors->first('tanggal') }}</code>@endif
</div>

@if( isset( $pembacaan ) )
	<div class="form-group" @if($errors->has('judul')) class="has-error" @endif>
	  {!! Form::label('judul', 'Judul') !!}
	  {!! Form::text('judul' , null, ['class' => 'form-control']) !!}
	  @if($errors->has('judul'))<code>{{ $errors->first('judul') }}</code>@endif
	</div>
	<div class="form-group" @if($errors->has('doi')) class="has-error" @endif>
	  {!! Form::label('doi', 'DOI') !!}
	  {!! Form::text('doi' , null, ['class' => 'form-control']) !!}
	  @if($errors->has('doi'))<code>{{ $errors->first('doi') }}</code>@endif
	</div>
@endif
<div class="form-group" @if($errors->has('moderator')) class="has-error" @endif>
  {!! Form::label('moderator', 'Moderator') !!}
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
<div class="form-group" @if($errors->has('pembahas')) class="has-error" @endif>
  {!! Form::label('pembahas', 'Pembahas') !!}
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
