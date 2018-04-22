@extends('layouts.master')

@section('title') 
	Kulit Kelamin UNDIP
@stop

@section('head') 
	<style type="text/css" media="all">
		#tableStase tr td:first-child, #tableStase tr th:first-child {
			width:20%;
		}
		#tableStase tr td:nth-child(2), #tableStase tr th:nth-child(2) {
			width:20%;
		}
		#tableStase tr td:nth-child(3), #tableStase tr th:nth-child(3) {
			width:20%;
		}
		#tableStase tr td:nth-child(4), #tableStase tr th:nth-child(4) {
			width:20%;
		}
	</style>
@stop
@section('page-title') 
<h2>Detil User</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('users')}}">User</a>
	  </li>
	  <li class="active">
		  <strong>{{ $user->nama }}</strong>
	  </li>
</ol>

@stop
@section('content') 
	@include('users.show_content')
@stop
@section('footer') 
	<script type="text/javascript" charset="utf-8">
		function editStase(control){
			var mulai = $(control).closest('tr').find('.mulai').html();
			var akhir = $(control).closest('tr').find('.akhir').html();

			$('.updateButton').each(function(){
				cancelUpdate(this);
			});

			$(control).closest('tr').find('.mulai').html("<input type='text' class='form-control tanggal inputMulai' title='" + mulai + "' value='" + mulai + "'/>");
			$(control).closest('tr').find('.akhir').html("<input type='text' class='form-control tanggal inputAkhir' title= '" + akhir + "' value='" + akhir + "'/>");


            $('.tanggal').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd-mm-yyyy'
            });



			$(control).closest('td').html('<button class="btn btn-xs btn-primary updateButton" type="button" onclick="updateStase(this);return false;"> Update</button>  <button class="btn btn-xs btn-danger" type="button" onclick="cancelUpdate(this);return false;"> Cancel</button>');
		}
		function cancelUpdate(control){
			var mulai = $(control).closest('tr').find('.inputMulai').attr('title');
			var akhir = $(control).closest('tr').find('.inputAkhir').attr('title');
			$(control).closest('tr').find('.mulai').html(mulai);
			$(control).closest('tr').find('.akhir').html(akhir);

			$(control).closest('td').html('<button class="btn btn-xs btn-warning btn-block" type="button" onclick="editStase(this);return false;"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit </button>');
		}
		function updateStase(control){
			var mulai = $(control).closest('tr').find('.inputMulai').val();
			var akhir = $(control).closest('tr').find('.inputAkhir').val();
			var stase_id = $(control).closest('tr').find('td:first-child').attr('title');
			var jenis_stase_id = $(control).closest('td').attr('title');
			var user_id = $('#user_id').html();
			console.log(stase_id);
			console.log(mulai);
			console.log(akhir);
			console.log(user_id);
			console.log('jenis_stase_id  = ' + jenis_stase_id);
			$.post('{{ url('users/ajax') }}',
				{ 
					mulai : mulai,
					jenis_stase_id : jenis_stase_id,
					akhir : akhir,
					stase_id : stase_id,
					user_id : user_id
				},
				function (data, textStatus, jqXHR) {
					data = $.trim(data);
					console.log('date = ' + data);
					$(control).closest('tr').find('.mulai').html(mulai);
					$(control).closest('tr').find('.akhir').html(akhir);
					if( data != '' ){
						alert('yuhuuudffdf');
						$(control).closest('tr').find('td:first-child').attr('title', data);

					}
					$(control).closest('td').html('<button class="btn btn-xs btn-warning btn-block" type="button" onclick="editStase(this);return false;"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit </button>');


				}
			);
		}
	</script>
@stop

