@extends('layouts.app')

@section('title', $category->title)

@section('content')
<div class="container my-4">

    @if ($newsList->isEmpty())
        <div class="alert alert-info">Belum ada berita pada kategori ini.</div>
    @else

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($newsList as $post)
                <div class="col">
                    <a href="{{ $post->berita_url }}" class="text-decoration-none text-dark">
                        <div class="d-flex flex-column h-100">

                            @if ($post->image)
                                <img src="{{ asset('storage/public/posts/' . $post->image) }}" alt="{{ $post->title }}"
                                    class="img-fluid rounded mb-2" style="height: 180px; object-fit: cover;">
                            @endif

                            <h6 class="fw-bold mb-1" style="line-height: 1.4;">
                                {{ $post->title }}
                            </h6>

                            <div class="text-muted small">
                                <strong>{{ strtoupper($post->category->title ?? 'BERITA') }}</strong>
                                &bull; {{ $post->created_at->diffForHumans() }}
                            </div>

                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $newsList->links('vendor.pagination.rounded') }}
        </div>

    @endif

</div>
@endsection
