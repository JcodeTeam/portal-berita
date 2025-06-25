@extends('layouts.errors')

@section('title', '404 - Halaman Tidak Ditemukan')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1">404</h1>
    <p class="h4 mb-4">Halaman yang Anda cari tidak ditemukan.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">
        <i class="bi bi-house"></i> Kembali ke Beranda
    </a>
</div>
@endsection
