<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Login</title>
    {!! HTML::style('css/bootstrap.min.css')!!}
    {!! HTML::style('font-awesome/css/font-awesome.css')!!}
    {!! HTML::style('css/animate.css')!!}
    {!! HTML::style('css/style.css')!!}
  {{--   <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"> --}}

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">KJE+</h1>

            </div>
            <h3>Selamat Datang di {{ env("NAMA_KLINIK") }}</h3>
            <p>Silahkan masukkan email dan password dengan benar.</p>

            {!! Form::open(array('url' => 'login', 'class' => 'm-t', 'method' => 'post')) !!}

				<div class="form-group @if($errors->has('email'))has-error @endif">
                    {!! Form::email('email', null, array('class'=>'form-control', 'placeholder' => 'email', 'autocomplete' => 'false'))!!}
                </div>
				<div class="form-group @if($errors->has('password'))has-error @endif">
                    {!! Form::password('password',  array('placeholder' => 'password', 'class'=>'form-control', 'autocomplete' => 'false'))!!}
                </div>
                <div class="form-group">
                    {!! Form::submit('submit', array('class' => 'btn btn-sm btn-primary btn-block'))!!}
                </div>

            {!! Form::close() !!}

            <p><a href="{{ url('users/create') }}">Klik Disini</a> untuk membuat akun baru</p> 
           @if(\Session::has('pesan'))
                <p class="m-t"> <code> {!! \Session::get('pesan') !!}</code> </p>
            @endif
        </div>
    </div>

    <!-- Mainly scripts -->

    {!! HTML::script('js/jquery-2.1.1.js')!!}
    {!! HTML::script('js/bootstrap.min.js')!!}

</body>

</html>
{{-- @extends('layouts.master') --}}

{{-- @section('content') --}}
{{-- <div class="container"> --}}
{{--     <div class="row"> --}}
{{--         <div class="col-md-8 col-md-offset-2"> --}}
{{--             <div class="panel panel-default"> --}}
{{--                 <div class="panel-heading">Login</div> --}}

{{--                 <div class="panel-body"> --}}
{{--                     <form class="form-horizontal" method="POST" action="{{ route('login') }}"> --}}
{{--                         {{ csrf_field() }} --}}

{{--                         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"> --}}
{{--                             <label for="email" class="col-md-4 control-label">E-Mail Address</label> --}}

{{--                             <div class="col-md-6"> --}}
{{--                                 <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus> --}}

{{--                                 @if ($errors->has('email')) --}}
{{--                                     <span class="help-block"> --}}
{{--                                         <strong>{{ $errors->first('email') }}</strong> --}}
{{--                                     </span> --}}
{{--                                 @endif --}}
{{--                             </div> --}}
{{--                         </div> --}}

{{--                         <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}"> --}}
{{--                             <label for="password" class="col-md-4 control-label">Password</label> --}}

{{--                             <div class="col-md-6"> --}}
{{--                                 <input id="password" type="password" class="form-control" name="password" required> --}}

{{--                                 @if ($errors->has('password')) --}}
{{--                                     <span class="help-block"> --}}
{{--                                         <strong>{{ $errors->first('password') }}</strong> --}}
{{--                                     </span> --}}
{{--                                 @endif --}}
{{--                             </div> --}}
{{--                         </div> --}}

{{--                         <div class="form-group"> --}}
{{--                             <div class="col-md-6 col-md-offset-4"> --}}
{{--                                 <div class="checkbox"> --}}
{{--                                     <label> --}}
{{--                                         <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me --}}
{{--                                     </label> --}}
{{--                                 </div> --}}
{{--                             </div> --}}
{{--                         </div> --}}

{{--                         <div class="form-group"> --}}
{{--                             <div class="col-md-8 col-md-offset-4"> --}}
{{--                                 <button type="submit" class="btn btn-primary"> --}}
{{--                                     Login --}}
{{--                                 </button> --}}

{{--                                 <a class="btn btn-link" href="{{ route('password.request') }}"> --}}
{{--                                     Forgot Your Password? --}}
{{--                                 </a> --}}
{{--                             </div> --}}
{{--                         </div> --}}
{{--                     </form> --}}
{{--                 </div> --}}
{{--             </div> --}}
{{--         </div> --}}
{{--     </div> --}}
{{-- </div> --}}
{{-- @endsection --}}
