@extends('layouts.profile')

@section('title', 'Profil Saya')

@section('content')
<div class="container py-4" style="max-width: 800px;">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">Profil Pengguna</h5>
                </div>
                <div class="card-body">

                    @if ($editMode)
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                    @endif

                    <div class="mb-3 text-center">
                        <div class="rounded-circle bg-secondary text-white d-inline-flex justify-content-center align-items-center" style="width: 80px; height: 80px; font-size: 32px;">
                            @if ($user->avatar)
                                @if (Str::startsWith($user->avatar, ['http://', 'https://']))
                                    <img src="{{ $user->avatar }}" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('storage/public/profiles/' . $user->avatar) }}" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                                @endif
                            @else
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            @endif
                        </div>

                    </div>

                    @if ($editMode)
                        <div class="mb-3">
                            <label class="form-label">Ganti Foto Profil</label>
                            <input type="file" class="form-control" name="avatar">
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name"
                            value="{{ old('name', $user->name) }}" {{ $editMode ? '' : 'disabled' }}>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" name="email"
                            value="{{ old('email', $user->email) }}"
                            {{ $editMode && $user->role->id === 1 ? '' : 'disabled' }}>
                    </div>

                    @if (in_array($user->role->id, [2]))
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username"
                                value="{{ old('username', $user->author->username ?? '') }}"
                                {{ $editMode ? '' : 'disabled' }}>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Employee Code</label>
                            <input type="text" class="form-control" name="employee_code"
                                value="{{ $user->author->employee_code ?? '' }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bio</label>
                            <textarea class="form-control" name="bio"
                                {{ $editMode ? '' : 'disabled' }}>{{ old('bio', $user->author->bio ?? '') }}</textarea>
                        </div>
                    @endif

                    @if ($editMode)
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold mb-3">
                            Simpan
                        </button>

                        <div class="text-center mt-3">
                            <a href="{{ route('berita.index') }}"
                                class="text-primary text-decoration-none fw-semibold">
                                Kembali ke CNEWS
                            </a>
                        </div>

                        </form>
                    @else
                        <div class="text-end">
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">Edit Profil</a>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
