@extends('layouts.admin')
@section('title','Tambah Kategori')
@section('content')
<div class="container my-4">
  <h2>Tambah Kategori Berita</h2>
  <form action="{{ route('news_categories.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
             value="{{ old('title') }}">
      @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('news_categories.index') }}" class="btn btn-secondary ms-2">Batal</a>
  </form>
</div>
@endsection
