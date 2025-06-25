@extends('layouts.admin')
@section('title','Daftar Kategori Berita')
@section('content')
<div class="container my-4">
  <div class="d-flex justify-content-between mb-3">
    <h2>Kategori Berita</h2>
    <a href="{{ route('news_categories.create') }}" class="btn btn-primary">Tambah Kategori</a>
  </div>

  @if(session('success'))
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
        <td>{{ $loop->iteration + ($categories->currentPage()-1)*$categories->perPage() }}</td>
        <td>{{ $cat->title }}</td>
        <td>{{ $cat->slug }}</td>
        <td class="d-flex gap-1">
          <a href="{{ route('news_categories.edit', $cat->id) }}" class="btn btn-sm btn-warning">Edit</a>
          <form action="{{ route('news_categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">Hapus</button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="4" class="text-center">Belum ada kategori.</td></tr>
      @endforelse
    </tbody>
  </table>

  {{ $categories->links() }}
</div>
@endsection
