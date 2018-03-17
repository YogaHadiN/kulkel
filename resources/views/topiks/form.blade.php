<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('topik'))has-error @endif">
		  {!! Form::label('topik', 'Topik', ['class' => 'control-label']) !!}
			{!! Form::text('topik', null, array(
				'class'         => 'form-control rq'
			))!!}
		  @if($errors->has('topik'))<code>{{ $errors->first('topik') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('pembicara'))has-error @endif">
		  {!! Form::label('pembicara', 'Pembicara', ['class' => 'control-label']) !!}
			{!! Form::text('pembicara', null, array(
				'class'         => 'form-control rq'
			))!!}
		  @if($errors->has('pembicara'))<code>{{ $errors->first('pembicara') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('jam_mulai'))has-error @endif">
		  {!! Form::label('jam_mulai', 'Mulai', ['class' => 'control-label']) !!}
			{!! Form::text('jam_mulai', null, array(
				'class'         => 'form-control rq jam'
			))!!}
		  @if($errors->has('jam_mulai'))<code>{{ $errors->first('jam_mulai') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group{{ $errors->has('materi') ? ' has-error' : '' }}">
			{!! Form::label('materi', 'Materi') !!}
			@if(isset($topik))
				<a class="" href="{{ $topik->link_materi }}">{{ $topik->nama_file_materi }}</a><br /> Upload untuk ubah
			@endif
			{!! Form::file('materi') !!}
			<div>maksimal 8 MB</div>
			{!! $errors->first('materi', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
</div>

