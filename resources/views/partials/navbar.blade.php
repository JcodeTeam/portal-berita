<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 px-4 mb-5 fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-orange" href="{{ route('berita.index') }}">CNEWS</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Menu -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-4">
                <li class="nav-item"><a class="nav-link active" href="#">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Kesehatan</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Politik</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Pariwisata</a></li>
            </ul>

            <!-- Search -->
            <form class="d-flex me-3" role="search">
                <input class="form-control rounded-pill px-3" type="search" placeholder="Cari berita..."
                    aria-label="Search">
            </form>

            <!-- Autentikasi -->
            @php
                use Illuminate\Support\Str;
                $avatar = Auth::check() ? Auth::user()->avatar : null;
            @endphp
            @auth
                <div class="dropdown">
                    <button class="btn btn-light rounded-circle border-0 p-0" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" style="width: 40px; height: 40px;">
                        @if ($avatar)
                            @if (Str::startsWith($avatar, ['http://', 'https://']))
                                <img src="{{ $avatar }}" class="rounded-circle"
                                    style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <img src="{{ asset('storage/public/profiles/' . $avatar) }}" class="rounded-circle"
                                    style="width: 40px; height: 40px; object-fit: cover;">
                            @endif
                        @else
                            <span class="badge bg-secondary rounded-circle d-flex justify-content-center align-items-center"
                                style="width: 40px; height: 40px;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </span>
                        @endif
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <a href="{{ route('profile.show') }}" class="dropdown-item px-3 py-2">
                                <div class="fw-bold">{{ Auth::user()->name }}</div>
                                <div class="text-muted small">{{ Auth::user()->email }}</div>
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-warning rounded-pill px-4">Masuk</a>
            @endauth
        </div>
    </div>
</nav>
