@extends('layouts.app')

@section('title', 'Hasil Pencarian')

@section('content')
<div class="container my-5">

    @if ($results->isEmpty())
        <div class="alert alert-warning">Tidak ditemukan berita dengan kata kunci tersebut.</div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($results as $post)
                <div class="col">
                    <a href="{{ $post->berita_url }}" class="text-decoration-none text-dark">
                        <div class="d-flex flex-column h-100">
                            @if ($post->image)
                                <img src="{{ asset('storage/public/posts/' . $post->image) }}" class="img-fluid rounded mb-2" style="height: 180px; object-fit: cover;">
                            @endif
                            <h6 class="fw-bold mb-1">{{ $post->title }}</h6>
                            <div class="text-muted small">
                                <strong>{{ strtoupper($post->category->title ?? 'BERITA') }}</strong> &bull;
                                {{ $post->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $results->links('vendor.pagination.rounded') }}
        </div>
    @endif
</div>
@endsection
