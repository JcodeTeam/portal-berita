@extends('layouts.admin')
@section('title',$category->title)
@section('content')
<div class="container my-4">
  <h2>Detail Kategori</h2>
  <div class="mb-3">
    <strong>Title:</strong> {{ $category->title }}
  </div>
  <div class="mb-3">
    <strong>Slug:</strong> {{ $category->slug }}
  </div>
  <a href="{{ route('news_categories.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
