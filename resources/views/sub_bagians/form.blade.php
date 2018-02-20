<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('user_id'))has-error @endif">
		  {!! Form::label('user_id', 'Nama Staf', ['class' => 'control-label']) !!}
			{!! Form::select('user_id', App\User::list(), null, array(
				'class'            => 'form-control selectpick rq',
				'data-live-search' => 'true'
			))!!}
		  @if($errors->has('user_id'))<code>{{ $errors->first('user_id') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('jenis_stase_id'))has-error @endif">
		  {!! Form::label('jenis_stase_id', 'Jenis Stase', ['class' => 'control-label']) !!}
			{!! Form::select('jenis_stase_id', App\JenisStase::list(), null, array(
				'class'         => 'form-control rq'
			))!!}
		  @if($errors->has('jenis_stase_id'))<code>{{ $errors->first('jenis_stase_id') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('jenis_penguji_id'))has-error @endif">
		  {!! Form::label('jenis_penguji_id', 'Jabatan', ['class' => 'control-label']) !!}
			{!! Form::select('jenis_penguji_id', App\JenisPenguji::list(), null, array(
				'class'         => 'form-control rq'
			))!!}
		  @if($errors->has('jenis_penguji_id'))<code>{{ $errors->first('jenis_penguji_id') }}</code>@endif
		</div>
	</div>
</div>
