<!DOCTYPE HTML>
<html lang="en-us">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Najod Survey') }} - Login</title>
</head>
<body class="bg-light d-flex align-items-center min-vh-100 m-0">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Login Card -->
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body p-3 p-md-4">
                        <a href="/" class="d-block text-center mb-3">
                            <img src="{{ asset('img/caa-uganda-logo.png') }}" alt="CAA Uganda Logo" class="img-fluid" style="max-width: 150px; max-height: 100px;">
                        </a>

                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            @if(count($errors) > 0)
                                <div class="alert alert-danger text-center p-2">
                                    @foreach($errors->all() as $error)
                                        {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <small>Powered by: <a href="https://najod.co/" class="text-primary">NAJOD Surveillance</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>