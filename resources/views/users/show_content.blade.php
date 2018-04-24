<div class="hide" id="user_id">
	{{ $id }}
</div>
<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Detil {{ $user->role->role }}</a></li>
    <li role="presentation"><a href="#stase" aria-controls="stase" role="tab" data-toggle="tab">Stase</a></li>
    <li role="presentation"><a href="#pembacaan" aria-controls="pembacaan" role="tab" data-toggle="tab">Pembacaan</a></li>
    <li role="presentation"><a href="#tugas" aria-controls="tugas" role="tab" data-toggle="tab">Tugas</a></li>
    <li role="presentation"><a href="#ujian" aria-controls="ujian" role="tab" data-toggle="tab">Ujian</a></li>
    <li role="presentation"><a href="#tundaan_ujian" aria-controls="tundaan_ujian" role="tab" data-toggle="tab">Tundaan Ujian</a></li>
  </ul>
  <!-- Tab panes -->
	  <div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="home">
			@include('users.detil')	
		</div>
		<div role="tabpanel" class="tab-pane" id="stase">
				@include('users.stase')
		</div>
		<div role="tabpanel" class="tab-pane" id="pembacaan">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">
						<div class="panelLeft">
							Pembacaan
						</div>	
						<div class="panelRight">
							<a class="btn btn-primary" href="{{ url('users/' . $user->id . '/pembacaans/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Buat Pembacaan</a>
						</div>
					</h3>
				</div>
				<div class="panel-body">
					@include('pembacaans.pembacaan')	
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="tugas">
			<div class="panel panel-info">
				<div class="panel-body">
					@include('tugas')
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="ujian">
			@include('users.ujian')
		</div>
		<div role="tabpanel" class="tab-pane" id="tundaan_ujian">
			@include('users.tundaan_ujians')
		</div>
	</div>
</div>
