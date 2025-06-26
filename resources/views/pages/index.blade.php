@extends('layouts.app')

@section('title', 'Berita Terbaru')

@section('content')
    <div class="container my-4">

        @if ($posts->isEmpty())
            <div class="alert alert-info">Belum ada berita tersedia.</div>
        @else
            <div class="row g-3 mb-4 align-items-stretch">
                <div class="col-lg-8">
                    <div class="position-relative h-100">
                        @if ($trendingPost->image)
                            <a href="{{ $trendingPost->berita_url }}">
                                <img src="{{ asset('storage/public/posts/' . $trendingPost->image) }}" class="w-100"
                                    style="height: 400px; object-fit: cover;">
                        @endif
                        <div class="position-absolute bottom-0 start-0 w-100 p-3 text-white bg-dark bg-opacity-50">
                            <h4 class="mb-0">{{ $trendingPost->title }}</h4>

                            <div class="d-flex justify-content-between pt-2">
                                <span
                                    class="badge bg-secondary">{{ strtoupper($trendingPost->category->title ?? 'Uncategorized') }}</span>
                                <span class="small">{{ $trendingPost->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                <!-- Iklan Afiliasi -->
                <div class="col-lg-4">
                    <div class="p-2 border bg-light text-center h-100" style="height: 400px;">
                        <small class="text-muted d-block mb-1">Iklan Afiliasi</small>
                        <a href="https://shopee.co.id/MSI-Crosshair-16-HX-AI-D2XWGKG-(9S7-15P421-041)-Intel-Core-Ultra-9-275HX-16GB-1TB-SSD-RTX5070-8GB-16%E2%80%B3-QHD-240Hz-Win-11-Home-OHM-2024-Cosmos-Grey-i.41303795.27137232836?sp_atk=6cb81c21-2f63-4f85-b7ae-9008428726e8&xptdk=6cb81c21-2f63-4f85-b7ae-9008428726e8"
                            target="_blank" rel="noopener noreferrer">
                            <img src="https://down-id.img.susercontent.com/file/id-11134207-7rbk2-mamdmmz86kdwa1.webp"
                                alt="MSI Crosshair 16 HX" class="img-fluid mb-2"
                                style="max-height: 300px; object-fit: contain;">
                            <div class="fw-bold text-primary">MSI Crosshair 16 HX – Diskon!</div>
                        </a>
                    </div>
                </div>
            </div>



            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($posts as $post)
                    <div class="col">
                        <a href="{{ $post->berita_url }}" class="text-decoration-none text-dark">
                            <div class="d-flex flex-column h-100">

                                @if ($post->image)
                                    <img src="{{ asset('storage/public/posts/' . $post->image) }}" alt="{{ $post->title }}"
                                        class="img-fluid rounded mb-2" style="height: 180px; object-fit: cover;">
                                @endif

                                <h6 class="fw-bold mb-1 hover-title" style="line-height: 1.4;">
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
                {{ $posts->links('vendor.pagination.rounded') }}
            </div>

        @endif
    </div>
@endsection
