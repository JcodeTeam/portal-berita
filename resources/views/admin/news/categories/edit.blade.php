@extends('layouts.admin')
@section('title','Edit Kategori')
@section('content')
<div class="container my-4">
  <h2>Edit Kategori</h2>
  <form action="{{ route('news_categories.update', $category->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
             value="{{ old('title', $category->title) }}">
      @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <button type="submit" class="btn btn-primary">Perbarui</button>
    <a href="{{ route('news_categories.index') }}" class="btn btn-secondary ms-2">Batal</a>
  </form>
</div>
@endsection
