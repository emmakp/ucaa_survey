<!DOCTYPE HTML>
<html lang="en-us">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Styles -->
		<link rel="stylesheet" href="{{ asset('css/login/style.css') }}" type='text/css' />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">


        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Najod Survey') }}-Login</title>
	</head>
	<body>
	<div class="header text-center mb-5">
		<div class="container-fluid">
<div class="login-form-bx">
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-6 cards">
		<div class="authincation-content">

			<a class="login-logo " href="/">
				<img src="{{ asset('img/caa-uganda-logo.png') }} " alt="" height="170px" width="80%" >
			</a>
				<div class="mb-4">

				</div>
					<form action="{{ route('login') }}" method="post">
                        @csrf
                        @if(count($errors)> 0)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger text-center">
                                    {{$error}}
                                </div>
                            @endforeach
                        @endif
						<div class="form-group">
							<label class="mb-2 tag">
							<strong class="">Email</strong></label>
									{{-- <input type="text" name="username" placeholder="Enter your email"class="form-control  input " required /> --}}
                                    <input id="email" type="email" class="form-control input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email">
								</div>


						<div class="form-group">
							<label class="mb-2 tag">
								<strong class="">Password</strong>
							</label>
                            <input id="password" type="password" class="form-control input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"  placeholder="Enter your password">
						</div>

						<div class="form-row d-flex justify-content-between mt-4 mb-2">
							<div class="form-group">
								<div class="custom-control custom-checkbox ml-1 ">
								{{-- <input type="checkbox" class="form-check-input" id="basic_checkbox_1"> --}}
                                <input class="form-check-input" type="checkbox" name="remember" id="basic_checkbox_1">
								<label class="form-check-label" for="basic_checkbox_1">Remember my preference</label>
							</div>
						</div>
					</div>
					<div class="text-center">
						<button type="submit" name="admin_login" class="btn btn-primary btn-block">login</button>
					</div>
				</form>

				<div class="new-account mt-2 tag">
					<b>Powered by : <a href="https://najod.co/">NAJOD Survaillance</a></b>
					</p>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-5 d-flex box-skew1">

		</div>
	</div>
</div>


	</div>
</div>
</body>
</html>
