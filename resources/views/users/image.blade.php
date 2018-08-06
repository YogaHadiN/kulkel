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
					'title'     => 'Profile Pic',
					'filename'  => $user->profile_pic,
					'fieldname' => 'profile_pic'
				])
				@include('users.image_form_template', [
					'title'     => 'KTP',
					'filename'  => $user->ktp_pic,
					'fieldname' => 'ktp_pic'
				])
				@include('users.image_form_template', [
					'title'     => 'Kartu Mahasiswa',
					'filename'  => $user->kartu_mahasiswa,
					'fieldname' => 'kartu_mahasiswa'
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
					<div class="panel-heading">
						<h3 class="panel-title">
					<div class="panelLeft">
						Daftar Sertifikat
					</div>	
					<div class="panelRight">
						<a class="btn btn-primary" href="{{ url('users/' . $user->id . '/image/create_sertifikat') }}"><i class="fa fa-plus" aria-hidden="true"></i> Sertifikat</a>
					</div>
						</h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered DT">
								<thead>
									<tr>
										<th class="autofit">No</th>
										<th>Sertifikat</th>
										<th>Judul</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@if($user->sertifikat->count() > 0)
										@foreach($user->sertifikat as $k=> $sertifikat)
											<tr>
												<td class="autofit">{{ $k + 1 }}</td>
												<td>
													<a target="_blank" class="" href="{{ Storage::cloud()->url( $sertifikat->filename ) }}">
														<img src="{{ Storage::cloud()->url( $sertifikat->filename ) }}" alt="" class="full-width" />
													</a>
												</td>
												<td>{{ $sertifikat->judul }}</td>
												<td nowrap class="autofit">
													<a class="btn btn-info" href="{{ url('sertifikats/' . $sertifikat->id) }}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="3" class="text-center">Tidak ada data untuk ditampilkan</td>
										</tr>
									@endif
								</tbody>
							</table>
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
				console.log('image_name : ' + image_name);
				var image_extension = image_name.split('.').pop().toLowerCase();
				if(jQuery.inArray(image_extension,['gif', 'png', 'jpg', 'jpeg']) == -1){
					alert('Tipe file yang mau diupload bukan gambar');
				}
				var image_size = property.size;
				if(image_size > 3000000){
					alert('File maksimal 3 MB, ini terlalu besar');
				} else {
					$(this).closest('form').find('.progress').removeClass('hide');
					var progress  = $(this).closest('form').find('.progress-bar');
					var panel  = $(this).closest('.panel');
					var form_data = new FormData();
					form_data.append('file', property);
					var fieldname = panel.find('.fieldname').val();
					$.ajax({
						url : '{{ url("users/" . $user->id . '/upload') }}/' + fieldname,
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
									panel.find('.image-div').html('<i class="fa fa-spinner fa-spin" style="font-size:100px"></i>');
								}

							  }
							}, false);

							return xhr;
						  },
						success : function(data){
							panel.find('.image-div').html('<img src="' + data.link + '" alt="" class="full-width" />');
						}
					})
				}
			});
		});
	</script>
@stop

