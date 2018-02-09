<div class="form-group" @if($errors->has('user_id')) class="has-error" @endif>
  {!! Form::label('user_id', 'Nama Residen') !!}
  @if(isset( $user_id ))
	  {!! Form::select('user_id' , App\User::list(), $user_id, ['class' => 'form-control rq', 'readonly' => 'true']) !!}
  @else
	  {!! Form::select('user_id' , App\User::list(), null, ['class' => 'form-control selectpick rq', 'data-live-search' => 'true']) !!}
  @endif
  @if($errors->has('user_id'))<code>{{ $errors->first('user_id') }}</code>@endif
</div>
@if( isset($stase) )
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<div class="form-group" @if($errors->has('jenis_stase_id')) class="has-error" @endif>
			  {!! Form::label('jenis_stase_id', 'Jenis Stase') !!}
			  {!! Form::select('jenis_stase_id' , App\JenisStase::list(), null, ['class' => 'form-control rq']) !!}
			  @if($errors->has('jenis_stase_id'))<code>{{ $errors->first('jenis_stase_id') }}</code>@endif
			</div>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<div class="form-group" @if($errors->has('mulai')) class="has-error" @endif>
			  {!! Form::label('mulai', 'Mulai') !!}
			  {!! Form::text('mulai' , $stase->mulai->format('m-Y'), ['class' => 'form-control bulanTahun rq']) !!}
			  @if($errors->has('mulai'))<code>{{ $errors->first('mulai') }}</code>@endif
			</div>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<div class="form-group" @if($errors->has('akhir')) class="has-error" @endif>
			  {!! Form::label('akhir', 'Akhir') !!}
			  {!! Form::text('akhir' , $stase->akhir->format('m-Y'), ['class' => 'form-control bulanTahun rq']) !!}
			  @if($errors->has('akhir'))<code>{{ $errors->first('akhir') }}</code>@endif
			</div>
		</div>
	</div>
@else
<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>Jenis Stase</th>
				<th>Mulai</th>
				<th>Akhir</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{!! Form::select('jenis_stase_id[]' , App\JenisStase::list(), null, ['class' => 'form-control rq stase']) !!}</td>
				<td>
					  @if( isset( $stase ) )
						  {!! Form::text('mulai[]' , $stase->mulai->format('m-Y'), ['class' => 'form-control bulanTahun']) !!}
					  @else
						  {!! Form::text('mulai[]' , null, ['class' => 'form-control bulanTahun']) !!}
					  @endif
				</td>
				<td>
					  @if( isset( $stase ) )
						  {!! Form::text('akhir[]' , $stase->akhir->format('m-Y'), ['class' => 'form-control bulanTahun']) !!}
					  @else
						  {!! Form::text('akhir[]' , null, ['class' => 'form-control bulanTahun']) !!}
					  @endif
				</td>
				<td><button class="btn btn-success btn-sm" onclick="tambahInput(this);return false;" type="button"> <i class="fa fa-plus" aria-hidden="true"></i>  </button></td>
			</tr>
		</tbody>
	</table>
</div>
@endif
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		@if( isset($stase) )
		<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Update</button>
		@else
		<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Create</button>
		@endif
		{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<a class="btn btn-danger btn-block" href="{{ url('stases') }}">Cancel</a>
	</div>
</div>
