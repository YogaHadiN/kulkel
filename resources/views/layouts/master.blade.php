<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <link href="{!! asset('css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/bootstrap-select.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/plugins/dataTables/dataTables.bootstrap.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/plugins/dataTables/dataTables.responsive.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/plugins/dataTables/dataTables.tableTools.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/animate.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/style.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/jquery-ui.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/plugins/datepicker/datepicker3.css') !!}" rel="stylesheet">
    {{-- <link href="{!! asset('css/all.css') !!}" rel="stylesheet" media="screen"> --}}

<link href="{!! asset('css/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet">
	<style type="text/css" media="all">
		.fixed {
			position: fixed;
			bottom: 0px;
			text-align:right;
			left: 0px;
			z-index: 999;
		}
		.fixed-left{
			width:39% !important;
		}
		.fixed-right{
			width:39% !important;
		}

		.full {
			width:100% !important;
		}
		

		@media (max-width: 767px) {
		  .table-responsive .dropdown-menu,
		  .table-responsive .dropdown-toggle {
				position: static !important;
		  }
		}

		@media (min-width: 768px) {
			.table-responsive {
				overflow: visible;
			}
		}
	</style>

    @yield('head')
</head>
<body>
    <div id="overlayd"></div>
    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
							<img alt="image" class="img-circle" width="75px" height="75px" src="{{ url('img/nurse.jpeg') }}" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"> 
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Yoga</strong>
                             </span> <span class="text-muted text-xs block">
                                
                             <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="{{ url('users/' . \Auth::id() . '/edit') }}">Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ url('/logout')}}">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+asdfasdfasdf
                        </div>
                    </li>
                    <li>
                        <a href="{{ url('home') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Home</span></a>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Data-data</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
                            <li>{!! HTML::link('users', 'User')!!}</li>
                            <li>{!! HTML::link('dosens', 'Dosen')!!}</li>
                            <li>{!! HTML::link('residens', 'Residen')!!}</li>
                            <li>{!! HTML::link('karyawans', 'Karyawan')!!}</li>
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Cek List Harian</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>{!! HTML::link('cek_list_harian/obat', 'Obat')!!}</li>
                            <li>{!! HTML::link('cek_list_harian/pulsa', 'Pulsa')!!}</li>
                            <li>{!! HTML::link('cek_list_harian/listrik', 'Listrik')!!}</li>
                        </ul>
                    </li>
					 <li>{!! HTML::link('backup', 'Backup Database', ['onclick' => 'return confirm("Anda yakin mau backup database saat ini?")'])!!}</li>
					 <li>{!! HTML::link('copy_log_file', 'Copy Log File')!!}</li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
			<div class="panelLeft">
				<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
			</div>
        </div>
		<ul class="nav navbar-top-links navbar-right">
		</ul>
        </nav>
        </div>
            <div class="row border-bottom white-bg page-heading">
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    @yield('page-title')
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    
                </div>
            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                    <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                @if (count($errors) > 0)
                                  <div class="alert alert-danger">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{!! $error !!}</li>
                                        @endforeach
                                    </ul>
                                  </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                @if (Session::has('pesan'))
                                    {!! Session::get('pesan')!!}
                                @endif
                            </div>
                        </div>
							@if( gethostname() == 'dell' )
								<div class="row fixed" id="antrianPasien" >
									<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bg-red fixed-left">
										<p>Sudah Diperiksa No :</p>
										<h4 id="antrianMaster">{{ App\Antrian::find(1)->antrian_terakhir }}</h4>
									</div>
									<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bg-primary fixed-right">
										<p>Antrian Terakhir No : </p>
										<h4 id="antrianMaster">{{ App\Classes\Yoga::antrianTerakhir( date('Y-m-d') ) }}</h4>
									</div>
								</div>
							@endif
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        </div>
    <script src="{!! asset('js/all.js') !!}"></script>
    <script src="{!! asset('js/Numeral-js/min/numeral.min.js') !!}"></script>
    <script src="{!! url('js/jquery-2.1.1.js') !!}"></script>
    <script src="{!! url('js/bootstrap.min.js') !!}"></script>
    <script src="{!! url('js/plugins/metisMenu/jquery.metisMenu.js') !!}"></script>
    <script src="{!! url('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}"></script>
    <script src="{!! url('js/plugins/jeditable/jquery.jeditable.js') !!}"></script>
    <script src="{!! url('js/bootstrap-select.min.js') !!}"></script>
    <script src="{!! url('js/plugins/datepicker/bootstrap-datepicker.js') !!}" type="text/javascript"></script>
    <script src="{!! url('js/plugins/dataTables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! url('js/plugins/dataTables/dataTables.bootstrap.min.js') !!}"></script>
    <script src="{!! url('js/plugins/dataTables/dataTables.responsive.min.js') !!}"></script>
    <script src="{!! url('js/inspinia.js') !!}"></script>
    <script src="{!! url('js/plugins/pace/pace.min.js') !!}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
		@if( gethostname() == 'dell' )
			{{--setInterval(function(){--}}
				{{--$.get('{{ url("master/ajax/antrianTerakhir") }}', { 'tanggal' : '{{ date('Y-m-d') }}' }, function(data) {--}}
					{{--var before = $('#antrianMaster').html();--}}
					{{--data = $.trim(data)--}}
						{{--if( before != data ){--}}
							{{--if( parseInt(data) > 0 ){--}}
								{{--$('#antrianPasien').hide().fadeIn(300);--}}
								{{--$('#antrianMaster').html(data);--}}
							{{--} else {--}}
								{{--$('#antrianPasien').fadeOut(300);--}}
								{{--$('#antrianMaster').html(data);--}}
							{{--}--}}
						{{--}--}}
				{{--});--}}
			{{--}, 5000);--}}
		@endif

        $(document).ready(function() {

            {{-- $('.uangInput').autoNumeric('init', { --}}
            {{--     aSep: '.', --}}
            {{--     aDec: ',', --}} 
            {{--     aSign: 'Rp. ', --}}
            {{--     vMin: '-9999999999999.99' , --}}
            {{--     mDec: 0 --}}
            {{-- }); --}}

            formatUang();
            
            $('.jumlah').each(function() {
                var number = $(this).html();
                number = number.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."); // 43,434
                $(this).html(number);
            });

            $('.selectpick')
                .selectpicker({
                style: 'btn-default',
                size: 10,
                selectOnTab : true,
                style : 'btn-white'
            });

        //plug in datetimepicker waktu bebas terserah
            $('.tanggal').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd-mm-yyyy'
            });

            $('.bulanTahun').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'mm-yyyy',
                minViewMode: 'months'
            });

            $('.DTa').dataTable({
                "dom": 'T<"clear">lfrtip',
            });

            $('.DT').dataTable({
                "dom": 'T<"clear">lfrtip',
                "bSort" : false
            });
            $('.DTi').dataTable({
                "aaSorting": [[ 6, "desc" ]],
                "responsive" : true,
                "dom": 'T<"clear">lfrtip',
                // "bSort" : false,
                "tableTools": {
                    "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });
            /* Init DataTables */
            var oTable = $('#editable').dataTable();
            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },
                "width": "90%",
                "height": "100%"
            });
        });
      function fnClickAddRow() {
            $('#editable').dataTable().fnAddData( [
                "Custom row",
                "New row",
                "New row",
                "New row",
                "New row" ] );
        }
		{{--$('.table-responsive tbody tr').slice(-2).find('.dropdown').addClass('dropup');--}}
    </script>
        @yield('footer')
</body>
</html>

