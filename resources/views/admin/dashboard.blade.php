@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }} 👋</h1>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-people-fill me-2"></i>Total Users</h5>
                    <p class="fs-3 fw-bold">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-shield-lock-fill me-2"></i>Total Roles</h5>
                    <p class="fs-3 fw-bold">{{ $totalRoles }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-folder-fill me-2"></i>News Categories</h5>
                    <p class="fs-3 fw-bold">{{ $totalCategories }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
