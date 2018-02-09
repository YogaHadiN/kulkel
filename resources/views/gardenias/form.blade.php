<div class="form-group" @if($errors->has('user_id')) class="has-error" @endif>
  {!! Form::label('user_id', 'Nama Residen') !!}
  {!! Form::select('user_id' , App\User::list(), null, ['class' => 'form-control rq selectpick', 'data-live-search' => 'true']) !!}
  @if($errors->has('user_id'))<code>{{ $errors->first('user_id') }}</code>@endif
</div>

<div class="form-group" @if($errors->has('tanggal')) class="has-error" @endif>
  {!! Form::label('tanggal', 'Tanggal') !!}
  @if(isset($gardenia))
	  {!! Form::text('tanggal' , $gardenia->tanggal->format('d-m-Y'), ['class' => 'form-control tanggal rq']) !!}
  @else
	<div class="table-responsive">
		<table class="table table-hover table-condensed table-bordered">
			<thead>
				<tr>
					<th>Tanggal</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						  {!! Form::text('tanggal[]' , null, ['class' => 'form-control tanggal rq form']) !!}
					</td>
					<td class="action"> <button onclick="tambah(this);return false;" class="btn btn-primary btn-sm btn-block" type="button"> <i class="fa fa-plus" aria-hidden="true"></i> </button> </td>
				</tr>
			</tbody>
		</table>
	</div>
  @endif
  @if($errors->has('tanggal'))<code>{{ $errors->first('tanggal') }}</code>@endif
</div>
