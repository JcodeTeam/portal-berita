@extends('layouts.redaksi')

@section('title', 'Daftar Berita')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h4">Daftar Berita</h1>
            <a class="btn btn-success" href="{{ route('redaksi.create') }}">
                <i class="bi bi-plus-circle"></i> Tambah Berita
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($posts->isEmpty())
            <div class="alert alert-info">Belum ada berita.</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Gambar</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Status</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $news)
                            <tr>
                                <td style="width: 100px;">
                                    @if ($news->image)
                                        <img src="{{ asset('storage/public/posts/' . $news->image) }}" alt="Gambar"
                                            class="img-thumbnail" style="width: 80px;">
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td>{{ $news->title }}</td>
                                <td>
                                    @if ($news->is_published == 1)
                                        <span class="badge bg-success">Published</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>
                                <td>{{ $news->category->title ?? '-' }}</td>
                                <td>{{ $news->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('redaksi.edit', $news->news_id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('redaksi.destroy', $news->news_id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus berita ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $posts->links('vendor.pagination.rounded') }}

        @endif
    </div>

@endsection
