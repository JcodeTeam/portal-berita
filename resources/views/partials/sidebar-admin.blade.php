<div class="d-flex flex-column flex-shrink-0 p-3 bg-light border-end" style="width: 250px; height: 100vh;">
    <a href="{{ route('admin.dashboard') }}"
        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
        <span class="fs-4 fw-bold text-dark">Admin Panel</span>
    </a>
    <hr>

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link text-dark">
                <i class="bi bi-house-fill me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link text-dark">
                <i class="bi bi-people-fill me-2"></i> Users
            </a>
        </li>
        <li>
            <a href="{{ route('roles.index') }}" class="nav-link text-dark">
                <i class="bi bi-shield-lock-fill me-2"></i> Roles
            </a>
        </li>
        <li>
            <a href="{{ route('news_categories.index') }}" class="nav-link text-dark">
                <i class="bi bi-folder-fill me-2"></i> News Category
            </a>
        </li>
    </ul>

    <hr>

    @php
        use Illuminate\Support\Str;
        $avatar = Auth::check() ? Auth::user()->avatar : null;
    @endphp

    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
            id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">

            @if ($avatar)
                @if (Str::startsWith($avatar, ['http://', 'https://']))
                    <img src="{{ $avatar }}" class="rounded-circle me-2" alt="profile" width="32"
                        height="32">
                @else
                    <img src="{{ asset('storage/public/profiles/' . $avatar) }}" alt="profile" width="32"
                        height="32" class="rounded-circle me-2">
                @endif
            @else
                <div class="bg-secondary text-white text-center rounded-circle me-2"
                    style="width: 40px; height: 40px; line-height: 40px;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
            @endif

            <strong>{{ Auth::user()->name }}</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser">
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</div>
