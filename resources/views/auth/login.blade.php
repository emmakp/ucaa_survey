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

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh; /* Full viewport height */
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
        }

        .login-form-bx {
            max-width: 500px; /* Limit the overall width */
            width: 100%; /* Responsive but capped by max-width */
            padding: 20px;
        }

        .box-skew1 {
            /* Background image applied here, replace with actual image if not in external CSS */
            background: url('{{ asset('img/your-background.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            width: 100%; /* Fills the .login-form-bx container */
            height: 100%; /* Fills the container height */
            display: flex;
            justify-content: center; /* Center the form inside */
            align-items: center; /* Vertically center the form */
        }

        .authincation-content {
            background: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%; /* Full width within .login-form-bx, capped by max-width */
            max-width: 400px; /* Optional: Slightly narrower than the container for better aesthetics */
        }

        /* Ensure form elements remain fully opaque */
        .authincation-content input,
        .authincation-content label,
        .authincation-content button,
        .authincation-content .tag {
            opacity: 1;
        }

        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="login-form-bx">
        <div class="box-skew1">
            <div class="authincation-content">
                <form action="{{ route('login') }}" method="post">
                    <div class="row col text-center">
                        <img src="{{ asset('img/caa-uganda-logo.png') }}" alt="Logo" class="img-fluid ml-3" width="180px">
                    </div>
                    @csrf
                    @if(count($errors) > 0)
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger text-center">
                                {{$error}}
                            </div>
                        @endforeach
                    @endif

                    <div class="form-group">
                        <label class="mb-2 tag"><strong>Email</strong></label>
                        <input id="email" type="email" class="form-control input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email">
                    </div>

                    <div class="form-group">
                        <label class="mb-2 tag"><strong>Password</strong></label>
                        <input id="password" type="password" class="form-control input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
                    </div>

                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox ml-1">
                                <input class="form-check-input" type="checkbox" name="remember" id="basic_checkbox_1">
                                <label class="form-check-label" for="basic_checkbox_1">Remember my preference</label>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" name="admin_login" class="btn btn-primary btn-block">Login</button>
                    </div>
                </form>

                <div class="new-account mt-2 tag text-center offset-2">
                    <b>Powered by: <a href="https://najod.co/" target="__blanc">NAJOD Surveillance</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>