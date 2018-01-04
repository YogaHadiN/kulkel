<div class="form-group" @if($errors->has('user_id')) class="has-error" @endif>
  {!! Form::label('user_id', 'Nama Residen') !!}
  {!! Form::select('user_id' , App\User::list(), null, ['class' => 'form-control selectpick rq', 'data-live-search' => 'true']) !!}
  @if($errors->has('user_id'))<code>{{ $errors->first('user_id') }}</code>@endif
</div>
<div class="form-group" @if($errors->has('jenis_stase_id')) class="has-error" @endif>
  {!! Form::label('jenis_stase_id', 'Jenis Stase') !!}
  {!! Form::select('jenis_stase_id' , App\JenisStase::list(), null, ['class' => 'form-control rq']) !!}
  @if($errors->has('jenis_stase_id'))<code>{{ $errors->first('jenis_stase_id') }}</code>@endif
</div>
<div class="form-group" @if($errors->has('periode_bulan')) class="has-error" @endif>
  {!! Form::label('periode_bulan', 'Bulan Periode') !!}
  @if( isset( $stase ) )
	  {!! Form::text('periode_bulan' , $stase->periode_bulan->format('m-Y'), ['class' => 'form-control bulanTahun']) !!}
  @else
	  {!! Form::text('periode_bulan' , null, ['class' => 'form-control bulanTahun']) !!}
  @endif
  @if($errors->has('periode_bulan'))<code>{{ $errors->first('periode_bulan') }}</code>@endif
</div>
