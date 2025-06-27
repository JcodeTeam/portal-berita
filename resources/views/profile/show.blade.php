@extends('layouts.profile')

@section('title', 'Profil Saya')

@section('content')
    <div class="container py-4" style="max-width: 540px;">
        <div class="mb-3 d-flex align-items-center">
            <a href="{{ url()->previous() }}" class="me-3 text-dark">
            {{-- <a href="{{ route('berita.index') }}" class="me-3 text-dark"> --}}
                <i class="bi bi-arrow-left"></i>
            </a>
            <h5 class="mb-0 fw-semibold">Profil Saya</h5>
        </div>

        <div class="text-center mb-3">
            <div class="mx-auto rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center"
                style="width: 80px; height: 80px; font-size: 32px;">
                @if ($user->avatar)
                    @if (Str::startsWith($user->avatar, ['http://', 'https://']))
                        <img src="{{ $user->avatar }}" class="rounded-circle"
                            style="width: 80px; height: 80px; object-fit: cover;">
                    @else
                        <img src="{{ asset('storage/public/profiles/' . $user->avatar) }}" class="rounded-circle"
                            style="width: 80px; height: 80px; object-fit: cover;">
                    @endif
                @else
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                @endif
            </div>

            <div class="mt-2">
                <h5 class="fw-bold text-dark mb-1">{{ $user->name }}</h5>
                <div class="text-muted fw-semibold">CNEWS</div>
                <div class="text-muted">{{ $user->email }}</div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body p-3">
                <a href="{{ route('profile.edit') }}"
                    class="text-decoration-none text-primary fw-semibold d-block mb-2">Ubah Profil</a>
                <a href="{{ route('password.form') }}" class="text-decoration-none text-primary fw-semibold d-block">Ganti Password</a>
            </div>
        </div>

    </div>
@endsection
