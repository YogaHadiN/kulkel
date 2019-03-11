<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('seminar'))has-error @endif">
		  {!! Form::label('seminar', 'Nama', ['class' => 'control-label']) !!}
			{!! Form::text('seminar', null, array(
				'class'         => 'form-control rq'
			))!!}
		  @if($errors->has('seminar'))<code>{{ $errors->first('seminar') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('lokasi'))has-error @endif">
		  {!! Form::label('lokasi', 'Lokasi', ['class' => 'control-label']) !!}
			{!! Form::text('lokasi', null, array(
				'class'         => 'form-control rq'
			))!!}
		  @if($errors->has('lokasi'))<code>{{ $errors->first('lokasi') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('tanggal'))has-error @endif">
		  {!! Form::label('tanggal', 'Tanggal', ['class' => 'control-label']) !!}
		  @if(isset($seminar))
			  {!! Form::text('tanggal', App\Yoga::updateDatePrep($seminar->tanggal), array(
				'class'         => 'form-control rq tanggal'
			))!!}
		  @else
			{!! Form::text('tanggal', null, array(
				'class'         => 'form-control rq tanggal'
			))!!}
		  @endif
		  @if($errors->has('tanggal'))<code>{{ $errors->first('tanggal') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		  {!! Form::label('link_materi', 'Link Materi', ['class' => 'control-label']) !!}
		  {!! Form::text('link_materi', $seminar->link_materi, array(
				'class'         => 'form-control'
			))!!}
		  @if($errors->has('link_materi'))<code>{{ $errors->first('link_materi') }}</code>@endif
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		  {!! Form::label('link_first_announcement', 'Link First Announcement', ['class' => 'control-label']) !!}
		  {!! Form::text('link_first_announcement', $seminar->link_first_announcement, array(
				'class'         => 'form-control'
			))!!}
		  @if($errors->has('link_first_announcement'))<code>{{ $errors->first('link_first_announcement') }}</code>@endif
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		  {!! Form::label('link_final_announcement', 'Link Final Announcement', ['class' => 'control-label']) !!}
		  {!! Form::text('link_final_announcement', $seminar->link_final_announcement, array(
				'class'         => 'form-control'
			))!!}
		  @if($errors->has('link_final_announcement'))<code>{{ $errors->first('link_final_announcement') }}</code>@endif
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('password'))has-error @endif">
		  {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
			{!! Form::text('password', null, array(
				'class'         => 'form-control rq'
			))!!}
		  @if($errors->has('password'))<code>{{ $errors->first('password') }}</code>@endif
		</div>
	</div>
</div>
