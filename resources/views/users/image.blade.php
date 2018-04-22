@extends('layouts.master')

@section('title') 
	Kulkel UNDIP | Gambar {{ $user->nama }}

@stop
@section('page-title') 
<h2>	Kulkel UNDIP | Gambar {{ $user->nama }}</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
			<a href="{{ url('users/' . $user->id)}}">{{ $user->nama }}</a>
	  </li>
	  <li class="active">
		  <strong>Gambar</strong>
	  </li>
</ol>
@stop
@section('content') 
	<div>
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#dokumen" aria-controls="dokumen" role="tab" data-toggle="tab">Dokumen</a></li>
			<li role="presentation"><a href="#sertifikat" aria-controls="sertifikat" role="tab" data-toggle="tab">Sertifikat</a></li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="dokumen">
				@include('users.image_form_template', [
					'title'     => 'KTP',
					'filename'  => $user->ktp_pic,
					'fieldname' => 'ktp_pic'
				])
				@include('users.image_form_template', [
					'title'     => 'Ijazah SD',
					'filename'  => $user->ijazah_sd_pic,
					'fieldname' => 'ijazah_sd_pic'
				])
				@include('users.image_form_template', [
					'title'     => 'Ijazah SMP',
					'filename'  => $user->ijazah_smp_pic,
					'fieldname' => 'ijazah_smp_pic'
				])
				@include('users.image_form_template', [
					'title'     => 'Ijazah SMU',
					'filename'  => $user->ijazah_smu_pic,
					'fieldname' => 'ijazah_smu_pic'
				])
				@include('users.image_form_template', [
					'title'     => 'Ijazah SKed',
					'filename'  => $user->ijazah_sked_pic,
					'fieldname' => 'ijazah_sked_pic'
				])
				@include('users.image_form_template', [
					'title'     => 'Ijazah Dokter',
					'filename'  => $user->ijazah_dokter_pic,
					'fieldname' => 'ijazah_dokter_pic'
				])
			</div>
			<div role="tabpanel" class="tab-pane" id="sertifikat">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								@foreach($user->sertifikat as $sertifikat)	
									<div class="panel panel-default">
										<div class="panel-body">
											<img src="{{Storage::cloud()->url( $user->ijazah_sked_pic )}}" alt="" />
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
@section('footer') 
	<script type="text/javascript" charset="utf-8">
		$('.image_source').each(function(){
			$(this).on('change', function(){
				var property = $(this).prop('files')[0];
				var image_name = property.name;
				var image_extension = image_name.split('.').pop().toLowerCase();
				if(jQuery.inArray(image_extension,['gif', 'png', 'jpg', 'jpeg']) == -1){
					alert('Tipe file yang mau diupload bukan gambar');
				}
				var image_size = property.size;
				{{-- if(image_size > 3000000){ --}}
				{{-- 	alert('File maksimal 3 MB, ini terlalu besar'); --}}
				{{-- } else { --}}
					$(this).closest('form').find('.progress').removeClass('hide');
					var progress  = $(this).closest('form').find('.progress-bar');
					var form_data = new FormData();
					form_data.append('file', property);
					$.ajax({
						url : '{{ url("users/" . $user->id . '/upload') }}',
						type : 'POST',
						data : form_data,
						contentType : false,
						cache: false,
						processData: false,
						beforeSend : function(){
							progress.width('0%'); 
							progress.html('0%'); 
						},
						xhr: function() {
							var xhr = new window.XMLHttpRequest();

							xhr.upload.addEventListener("progress", function(evt) {
							  if (evt.lengthComputable) {
								var percentComplete = evt.loaded / evt.total;
								percentComplete = parseInt(percentComplete * 100);
								console.log(percentComplete);
								progress.width(percentComplete + '%'); 
								progress.html(percentComplete + '%'); 

								if (percentComplete === 100) {

								}

							  }
							}, false);

							return xhr;
						  },
						success : function(data){
							console.log(data);
						}
					})
				{{-- } --}}
			});
		});
	</script>
@stop

