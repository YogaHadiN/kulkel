@if( isset($user) )
	{!! Form::textarea('no_telps', json_encode( $user->arraytelp ), array(
		'class' => 'form-control hide',
		'id'    => 'telps'
	))!!}
@else
	{!! Form::textarea('no_telps', null, array(
		'class' => 'form-control hide',
		'id'    => 'telps'
	))!!}
	
@endif
<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>Jenis Telpon</th>
				<th>Nomor</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="body_telpon">

		</tbody>
		<tfoot>
			<tr>
				<td>
					{!! Form::select('jenis_telpon', App\JenisTelpon::list(), null, array(
						'class'         => 'form-control jenis_telpon_id inp_tel',
						'id'         => 'jenis_telpon_id'
					))!!}
				</td>
				<td>
					{!! Form::text('nomor_telpon',  null, array(
						'class'         => 'form-control nomor_telpon inp_tel'
					))!!}
				</td>
				<td>
					<button class="btn btn-sm btn-info btn-block" onclick="inputTelpon(this);return false;" type="button">Input</button>
				</td>
			</tr>
		</tfoot>
	</table>
</div>
