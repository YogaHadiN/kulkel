<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group" @if($errors->has('title')) class="has-error" @endif>
		  {!! Form::label('title', 'titile') !!}
		  {!! Form::text('title' , null, ['class' => 'form-control rq']) !!}
		  @if($errors->has('title'))<code>{{ $errors->first('title') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
		<div class="form-group" @if($errors->has('body')) class="has-error" @endif>
		  {!! Form::label('body', 'body') !!}
		  {!! Form::textarea('body' , null, ['class' => 'form-control rq']) !!}
		  @if($errors->has('body'))<code>{{ $errors->first('body') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
			{!! Form::label('image', 'upload gambar') !!}
			{!! Form::file('image') !!}
				@if (isset($event) && $event->image)
					<p> {!! Html::image(asset('img/events/'.$event->image), null, ['class'=>'img-rounded upload']) !!} </p>
				@else
					<p> {!! Html::image(asset('img/photo_not_available.png'), null, ['class'=>'img-rounded upload']) !!} </p>
				@endif
			{!! $errors->first('image', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
</div>
