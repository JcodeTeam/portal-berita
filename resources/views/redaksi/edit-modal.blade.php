@extends('layouts.redaksi')

@section('title', 'Edit Berita')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Edit Berita</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('redaksi.update', $redaksi->news_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" id="title"
                    class="form-control @error('title') border-danger @enderror" value="{{ old('title', $redaksi->title) }}"
                    required>
                @error('title')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" id="category_id"
                    class="form-select @error('category_id') border-danger @enderror" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $redaksi->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            @if ($redaksi->image)
                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini</label><br>
                    <img src="{{ asset('storage/public/posts/' . $redaksi->image) }}" alt="Preview Gambar"
                        style="max-width: 250px;" class="img-thumbnail">
                </div>
            @endif

            <div class="mb-3">
                <label for="image" class="form-label">Ganti Gambar (opsional)</label>
                <input type="file" name="image" id="image"
                    class="form-control @error('image') border-danger @enderror" accept="image/*">
                @error('image')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Konten</label>
                <textarea name="content" id="content" rows="8" class="form-control @error('content') border-danger @enderror"
                    required>{{ old('content', $redaksi->content) }}</textarea>
                @error('content')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <input type="hidden" name="is_published" value="0">
            <div class="form-check mb-4">
                <input type="checkbox" name="is_published" id="is_published" class="form-check-input" value="1"
                    {{ old('is_published', $redaksi->is_published) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_published">Publish</label>
            </div>

            <button type="submit" class="btn btn-primary">Perbarui Berita</button>
            <a href="{{ route('redaksi.index') }}" class="btn btn-secondary ms-2">Batal</a>
        </form>
    </div>
@endsection
