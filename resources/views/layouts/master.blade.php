<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link href="{!! asset('https://cdnjs.cloudflare.com/ajax/libs/ajax-bootstrap-select/1.4.3/css/ajax-bootstrap-select.min.css') !!}" rel="stylesheet">
    {{-- <link href="{!! asset('css/bootstrap-select.min.css') !!}" rel="stylesheet"> --}}
    <link href="{!! asset('https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap.min.css') !!}" rel="stylesheet">
    {{-- <link href="{!! asset('css/plugins/dataTables/dataTables.bootstrap.css') !!}" rel="stylesheet"> --}}
    <link href="{!! asset('css/plugins/dataTables/dataTables.responsive.css') !!}" rel="stylesheet">
    <link href="{!! asset('https://cdnjs.cloudflare.com/ajax/libs/datatables-tabletools/2.1.5/css/TableTools.min.css') !!}" rel="stylesheet">
    {{-- <link href="{!! asset('css/plugins/dataTables/dataTables.tableTools.min.css') !!}" rel="stylesheet"> --}}
    {{-- <link href="{!! asset('https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css') !!}" rel="stylesheet"> --}}
    <link href="{!! asset('css/animate.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/style.css') !!}" rel="stylesheet">
    <link href="{!! asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css') !!}" rel="stylesheet">
    {{-- <link href="{!! asset('css/jquery-ui.min.css') !!}" rel="stylesheet"> --}}
    {{-- <link href="{!! asset('css/plugins/datepicker/datepicker3.css') !!}" rel="stylesheet"> --}}
    <link href="{!! asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css') !!}" rel="stylesheet">
	<!-- Latest compiled and minified CSS -->
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
		
		input.has-error{
			border: 0.2px solid red;
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
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">
                                {!! \Auth::user()->nama !!}</strong>
                             </span> <span class="text-muted text-xs block">
                                

                             <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="{{ url('users/' . \Auth::id() . '/edit') }}">Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ url('/logout')}}">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    <li>
                        <a href="{{ url('home') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Home</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Data-data</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>{!! HTML::link('users', 'User')!!}</li>
							<li>{!! HTML::link('polis', 'Poli')!!}</li>
							<li>{!! HTML::link('pembacaans', 'Pembacaan')!!}</li>
                            <li>{!! HTML::link('stases', 'Stase')!!}</li>
                            <li>{!! HTML::link('rsnds', 'Rsnd')!!}</li>
                            <li>{!! HTML::link('gardenias', 'Gardenia')!!}</li>
                            <li>{!! HTML::link('ujians', 'Ujian')!!}</li>
                            <li>{!! HTML::link('sub_bagians', 'Sub Bagian')!!}</li>
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Pegangan</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
							<li>{!! HTML::link('pegangans/residen', 'Residen')!!}</li>
                            <li>{!! HTML::link('pegangans/staf', 'Staf')!!}</li>
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">E Library</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
                            <li>{!! HTML::link('library', 'Daftar Buku')!!}</li>
                            <li>{!! HTML::link('library/riwayatPeminjaman', 'Riwayat Peminjaman')!!}</li>
                        </ul>
                    </li>
					<li>
                        <a href="{{ url('events') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Berita</span></a>
                    </li>
					<li>
                        <a href="{{ url('seminars') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Seminar</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control hide" name="top-search" id="top-search">
                </div>
            </form>
        </div>
		<ul class="nav navbar-top-links navbar-right">
                <li>
                    <a href="{{ url('logout') }}">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
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
            {{--{!! HTML::script("js/all.js")!!}--}}
    <script src="{!! asset('js/all.js') !!}"></script>
    <script src="{!! asset('js/Numeral-js/min/numeral.min.js') !!}"></script>
    <script src="{!! url('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js') !!}"></script>
    <!-- Mainly scripts 
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
    WebCam -->
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
			            $('#timepicker5').timepicker({
                template: false,
                showInputs: false,
                minuteStep: 5
            });

            $('.jam').timepicker({
                showInputs: false,
                defaultTime: 'current',
                minuteStep: 5
            });
			$('.tanggal').attr('placeholder', 'dd-mm-YYYY');
			$('.bulanTahun').attr('placeholder', 'mm-YYYY');
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

