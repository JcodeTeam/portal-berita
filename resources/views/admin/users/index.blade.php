@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
    <div class="container my-5">

        <a href="{{ route('users.create') }}" class="btn btn-primary mb-4">
            <i class="bi bi-plus-lg me-1"></i> Tambah User
        </a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive card shadow-sm">
            <table class="table table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Avatar</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                        @continue($user->id === auth()->id())
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($user->avatar)
                                    @if (Str::startsWith($user->avatar, ['http://', 'https://']))
                                        <img src="{{ $user->avatar }}" width="40" height="40"
                                            class="rounded-circle object-fit-cover">
                                    @else
                                        <img src="{{ asset('storage/public/profiles/' . $user->avatar) }}" width="40"
                                            height="40" class="rounded-circle object-fit-cover">
                                    @endif
                                @else
                                    <div class="bg-secondary text-white text-center rounded-circle"
                                        style="width: 40px; height: 40px; line-height: 40px;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name ?? '-' }}</td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
