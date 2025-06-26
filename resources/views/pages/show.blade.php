@extends('layouts.app')

@section('title', $news->title)

@section('content')
    <div class="container my-5">

        <div class="row justify-content-center mb-3">

            <div class="col-md-8">
                <div class="mb-2 text-muted">
                    <small class="text-uppercase">
                        {{ $news->category->title }} | {{ $news->created_at->format('d M Y') }}
                    </small>
                </div>

                <h1 class="fw-bold mb-3">{{ $news->title }}</h1>

                <div class="d-flex align-items-center mt-3">
                    <a href="{{ route('author.username', $news->author) }}"
                        class="d-flex align-items-center text-decoration-none text-dark">

                        @if ($news->author->user->avatar)
                            @if (Str::startsWith($news->author->user->avatar, ['http://', 'https://']))
                                <img src="{{ $news->author->user->avatar }}"
                                    class="rounded-circle me-2 border border-2 border-light shadow-sm" width="40"
                                    height="40" style="object-fit: cover;">
                            @else
                                <img src="{{ asset('storage/public/profiles/' . $news->author->user->avatar) }}"
                                    class="rounded-circle me-2 border border-2 border-light shadow-sm" width="40"
                                    height="40" style="object-fit: cover;">
                            @endif
                        @else
                            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2"
                                style="width: 40px; height: 40px; font-size: 14px;">
                                {{ strtoupper(Str::limit($news->author->user->name, 2, '')) }}
                            </div>
                        @endif

                        <strong>{{ $news->author->user->name ?? 'Unknown' }}</strong>
                    </a>

                    <div class="ms-auto">
                        <div class="d-flex gap-2">

                            <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . request()->fullUrl()) }}"
                                class="btn btn-success btn-sm" target="_blank">
                                <i class="bi bi-whatsapp"></i> WhatsApp
                            </a>

                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($news->title) }}&url={{ urlencode(request()->fullUrl()) }}"
                                class="btn btn-primary btn-sm" target="_blank">
                                <i class="bi bi-twitter-x"></i> Twitter
                            </a>

                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                class="btn btn-primary btn-sm" style="background-color: #3b5998" target="_blank">
                                <i class="bi bi-facebook"></i> Facebook
                            </a>

                            <a href="https://t.me/share/url?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($news->title) }}"
                                class="btn btn-info btn-sm text-white" target="_blank">
                                <i class="bi bi-telegram"></i> Telegram
                            </a>
                        </div>
                    </div>

                </div>


            </div>
        </div>

        @if ($news->image)
            <div class="row justify-content-center mb-4">
                <div class="col-md-8">
                    <img src="{{ asset('storage/public/posts/' . $news->image) }}" alt="{{ $news->title }}"
                        class="w-100" style="height: 400px; object-fit: cover;">
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-2"></div>

            <div class="col-md-8">

                <article class="fs-5" style="line-height: 1.8;">
                    {!! nl2br(e($news->content)) !!}
                </article>

                <div class="col-md-2"></div>
            </div>

        </div>
    @endsection
