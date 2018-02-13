<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Register</title>

    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ url('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ url('css/animate.css') }}" rel="stylesheet">
    <link href="{{ url('css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="text-center middle-box loginscreen animated fadeInDown">
		<div>
			<div>
				<h1 class="logo-name">IN+</h1>
			</div>
			<h3>Register to KK UNDIP+</h3>
			<p>Create account to see it in action.</p>
			{!! Form::open(['url' => 'register', 'method' => 'post']) !!}
				<div class="form-group @if($errors->has('nama')) has-error @endif">
					{!! Form::text('nama' , null, ['class' => 'form-control rq', 'placeholder' => 'Nama']) !!}
				  @if($errors->has('nama'))<code>{{ $errors->first('nama') }}</code>@endif
				</div>
				<div class="form-group @if($errors->has('email')) has-error @endif">
					{!! Form::email('email', null, ['class' => 'form-control rq', 'placeholder' => 'Email']) !!}
				  @if($errors->has('email'))<code>{{ $errors->first('email') }}</code>@endif
				</div>
				<div class="form-group @if($errors->has('password')) has-error @endif">
				  {!! Form::password('password', ['class' => 'form-control rq', 'placeholder' => 'Password']) !!}
				  @if($errors->has('password'))<code>{{ $errors->first('password') }}</code>@endif
				</div>
				<div class="form-group @if($errors->has('password_confirmation')) has-error @endif">
					{!! Form::password('password_confirmation', ['class' => 'form-control rq', 'placeholder' => 'Retype password']) !!}
				  @if($errors->has('password_confirmation'))<code>{{ $errors->first('password_confirmation') }}</code>@endif
				</div>
				<div class="form-group">
					<div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
				</div>
				<button type="submit" class="btn btn-primary block full-width m-b">Register</button>

				<p class="text-muted text-center"><small>Already have an account?</small></p>
				<a class="btn btn-sm btn-white btn-block" href="{{ url('login') }}">Login</a>
			{!! Form::close() !!}
			<p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
           @if(\Session::has('pesan'))
                <p class="m-t"> <code> {!! \Session::get('pesan') !!}</code> </p>
            @endif
		</div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ url('js/jquery-2.1.1.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ url('js/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>

</html>
