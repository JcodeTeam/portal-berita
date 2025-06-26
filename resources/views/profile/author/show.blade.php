@extends('layouts.profile')

@section('title', 'Profil ' . $author->user->name)

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center bg-white p-5 rounded shadow position-relative">

                <a href="{{ url()->previous() }}" class="text-dark fs-4 position-absolute top-0 start-0 m-3">
                    <i class="bi bi-arrow-left"></i>
                </a>

                @if ($author->user->avatar)
                    @if (Str::startsWith($author->user->avatar, ['http://', 'https://']))
                        <img src="{{ $author->user->avatar }}" alt="Foto Profil" class="rounded-circle mb-3"
                            style="width: 100px; height: 100px; object-fit: cover;">
                    @else
                        <img src="{{ asset('storage/public/profiles/' . $author->user->avatar) }}" alt="Foto Profil"
                            class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                    @endif
                @else
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white fw-bold mx-auto mb-3"
                        style="width: 100px; height: 100px; font-size: 32px;">
                        {{ strtoupper(Str::limit($author->user->name, 2, '')) }}
                    </div>
                @endif

                <h2 class="fw-bold mb-1">{{ $author->user->name }}</h2>

                @if ($author->bio)
                    <p class="mt-3">{{ $author->bio }}</p>
                @endif

            </div>

        </div>
    </div>
@endsection
