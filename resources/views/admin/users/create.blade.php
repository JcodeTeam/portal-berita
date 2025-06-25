@extends('layouts.admin')

@section('title', 'Buat Akun User')

@section('content')
<div class="container my-5">
  <h2 class="mb-4">Buat Akun User</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
      <label for="role_id" class="form-label">Role</label>
      <select name="role_id" id="role_id" class="form-select @error('role_id') is-invalid @enderror" required>
        <option value="">— Pilih Role —</option>
        @foreach($roles as $role)
          <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
            {{ $role->name }}
          </option>
        @endforeach
      </select>
      @error('role_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label for="name" class="form-label">Nama</label>
      <input type="text" name="name" id="name"
             class="form-control @error('name') is-invalid @enderror"
             value="{{ old('name') }}" required>
      @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" id="email"
             class="form-control @error('email') is-invalid @enderror"
             value="{{ old('email') }}" required>
      @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" id="password"
             class="form-control @error('password') is-invalid @enderror" required>
      @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
      <input type="password" name="password_confirmation" id="password_confirmation"
             class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="avatar" class="form-label">Avatar (opsional)</label>
      <input type="file" name="avatar" id="avatar"
             class="form-control @error('avatar') is-invalid @enderror">
      @error('avatar')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <button type="submit" class="btn btn-primary">Buat Akun</button>
    <a href="{{ url()->previous() }}" class="btn btn-secondary ms-2">Batal</a>
  </form>
</div>
@endsection
