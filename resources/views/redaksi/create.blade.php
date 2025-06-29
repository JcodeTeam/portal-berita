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
                <label for="image" class="form-label">Gambar</label>
                <input type="file" name="image" id="image"
                    class="form-control @error('image') border-danger @enderror" accept="image/*" required>
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

    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const formKey = 'autosave_news_form';
            const fields = ['title', 'category_id', 'is_published'];

            // Inisialisasi CKEditor
            CKEDITOR.replace('content');

            // Tunggu CKEditor ready dulu sebelum set value autosave
            CKEDITOR.instances.content.on('instanceReady', function() {
                const savedData = JSON.parse(localStorage.getItem(formKey) || '{}');
                if (savedData.content) {
                    CKEDITOR.instances.content.setData(savedData.content);
                }
            });

            // Set value field biasa dari autosave
            const savedData = JSON.parse(localStorage.getItem(formKey) || '{}');
            fields.forEach(field => {
                const input = document.querySelector(`[name="${field}"]`);
                if (!input) return;
                if (input.type === 'checkbox') {
                    input.checked = savedData[field] || false;
                } else {
                    input.value = savedData[field] || input.value;
                }
            });

            // Simpan ke localStorage tiap 3 detik
            setInterval(() => {
                const data = {};
                fields.forEach(field => {
                    const input = document.querySelector(`[name="${field}"]`);
                    if (!input) return;
                    data[field] = input.type === 'checkbox' ? input.checked : input.value;
                });
                data.content = CKEDITOR.instances.content.getData();
                localStorage.setItem(formKey, JSON.stringify(data));
            }, 3000);

            // Hapus localStorage saat submit
            document.querySelector('form').addEventListener('submit', () => {
                localStorage.removeItem(formKey);
            });
        });
    </script>

@endsection
