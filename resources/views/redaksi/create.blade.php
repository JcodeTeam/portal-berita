@extends('layouts.redaksi')

@section('title', 'Tambah Berita')

@section('content')
<div class="container my-5">
  <h2 class="mb-4">Tambah Berita</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ route('redaksi.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
      <label class="form-label">Judul</label>
      <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
             value="{{ old('title') }}" required>
      @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Gambar (opsional)</label>
      <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
      @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Kategori</label>
      <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
        <option value="" disabled selected>-- Pilih Kategori --</option>
        @foreach($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->title }}
          </option>
        @endforeach
      </select>
      @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Konten</label>
      <textarea name="content" rows="8" class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
      @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="form-check mb-4">
      <input type="checkbox" name="is_published" id="is_published" class="form-check-input"
             {{ old('is_published', true) ? 'checked' : '' }}>
      <label class="form-check-label" for="is_published">Publish</label>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Berita</button>
    <a href="{{ route('redaksi.index') }}" class="btn btn-secondary ms-2">Batal</a>
  </form>
</div>
@endsection
