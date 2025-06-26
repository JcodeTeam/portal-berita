{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="card p-4 shadow-sm" style="width: 400px;">
        <h3 class="text-center">Login</h3>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <a class="btn btn-danger my-3" href="{{ route('google.redirect') }}">Login with Google</a>


    </div>
</body>
</html>
 --}}


@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 2rem;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-primary {
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-google {
            background-color: #fff;
            border: 1px solid #ddd;
            color: #444;
            border-radius: 8px;
            font-weight: 500;
            transition: background-color 0.2s ease;
        }

        .btn-google:hover {
            background-color: #f5f5f5;
        }
    </style>

    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="login-card w-100" style="max-width: 400px;">
            <div class="text-center mb-4">
                <h3 class="fw-bold">Masuk ke Akun Anda</h3>
                <p class="text-muted small">Silakan login untuk melanjutkan</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') border-danger @enderror" value="{{ old('email') }}" required
                        autofocus>
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') border-danger @enderror" required>
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>


            <hr class="my-4">

            <a class="btn btn-google w-100 d-flex align-items-center justify-content-center"
                href="{{ route('google.redirect') }}">
                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Logo" width="20"
                    height="20" class="me-2">
                Login dengan Google
            </a>

        </div>
    </div>
@endsection
