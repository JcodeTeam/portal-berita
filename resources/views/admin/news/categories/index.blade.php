@extends('layouts.admin')
@section('title', 'Daftar Kategori Berita')
@section('content')
    <div class="container my-4">
        <div class="d-flex justify-content-between mb-3">
            <h2>Kategori Berita</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal">
                <i class="bi bi-plus-circle"></i> Tambah Kategori
            </button>

        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                    <tr>
                        <td>{{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}</td>
                        <td>{{ $cat->title }}</td>
                        <td>{{ $cat->slug }}</td>
                        <td class="d-flex gap-1">
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editCategoryModal{{ $cat->id }}">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>

                            <form action="{{ route('news_categories.destroy', $cat->id) }}" method="POST"
                                onsubmit="return confirmDelete(event, this);">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    @include('admin.news.categories.edit', ['category' => $cat])
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $categories->links() }}
    </div>
    @include('admin.news.categories.create')
@endsection
