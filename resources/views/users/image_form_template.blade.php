<div class="panel panel-default">
	<div class="panel-body">
		<h2>{{ $title }}</h2>
		<div class="row">
			<div class="col-md-6 image-div">
				@if(Storage::cloud()->exists( $filename ))
					<a target="_blank" class="" href="{{ Storage::cloud()->url( $filename ) }}">
						<img class="full-width" src="{{Storage::cloud()->url( $filename )}}" alt="" />
					</a>
				@else
					<img class="full-width" src="{{Storage::cloud()->url('no_image.jpeg')}}" alt="" />
				@endif
			</div>
			<div class="col-md-6">
				{!! Form::open(['url' => 'users/' . $user->id . '/upload', 'method' => 'post']) !!}
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							{!! Form::file($fieldname, ['class' => 'image_source']) !!}
							{!! Form::text('fieldname', $fieldname, ['class' => 'form-control fieldname hide']) !!}
						</div>
					</div>
					<div class="progress hide">
					  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
						0%
					  </div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
