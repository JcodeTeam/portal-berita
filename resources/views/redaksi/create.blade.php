@extends('layouts.redaksi')

@section('title', 'Tambah Berita')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Tambah Berita</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('redaksi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" id="title"
                    class="form-control @error('title') border-danger @enderror" value="{{ old('title') }}">
                @error('title')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar (opsional)</label>
                <input type="file" name="image" id="image"
                    class="form-control @error('image') border-danger @enderror" accept="image/*">
                @error('image')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" id="category_id"
                    class="form-select @error('category_id') border-danger @enderror">
                    <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Konten</label>
                <textarea name="content" id="content" rows="8" class="form-control @error('content') border-danger @enderror">{{ old('content') }}</textarea>
                @error('content')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-4">
                <input type="hidden" name="is_published" value="0">

                <input type="checkbox" name="is_published" id="is_published" class="form-check-input" value="1"
                    {{ old('is_published') ? 'checked' : '' }}>

                <label class="form-check-label" for="is_published">Publish</label>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Berita</button>
            <a href="{{ route('redaksi.index') }}" class="btn btn-secondary ms-2">Batal</a>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fields = ['title', 'content', 'category_id', 'is_published'];
            const formKey = 'autosave_news_form';

            // Ambil data tersimpan
            const savedData = JSON.parse(localStorage.getItem(formKey) || '{}');

            // Set nilai field dari localStorage jika ada
            fields.forEach(field => {
                const input = document.querySelector(`[name="${field}"]`);
                if (!input) return;

                if (input.type === 'checkbox') {
                    input.checked = savedData[field] || false;
                } else {
                    input.value = savedData[field] || input.value;
                }
            });

            // Auto-save tiap 3 detik
            setInterval(() => {
                const data = {};
                fields.forEach(field => {
                    const input = document.querySelector(`[name="${field}"]`);
                    if (!input) return;

                    data[field] = input.type === 'checkbox' ? input.checked : input.value;
                });

                localStorage.setItem(formKey, JSON.stringify(data));
            }, 3000);

            // Hapus auto-save saat form disubmit
            const form = document.querySelector('form');
            form.addEventListener('submit', () => {
                localStorage.removeItem(formKey);
            });
        });
    </script>

@endsection
