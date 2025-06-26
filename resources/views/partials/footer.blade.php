<footer class="bg-light text-dark pt-5 pb-3 mt-5 border-top">
    <div class="container">
        <div class="row">

            <!-- Brand & Deskripsi -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold text-orange">CNEWS</h5>
                <p class="text-muted">Portal berita terpercaya seputar politik, kesehatan, pariwisata, dan lainnya.</p>
            </div>

            <!-- Link Navigasi -->
            <div class="col-md-4 mb-4">
                <h6 class="fw-semibold mb-3">Kategori</h6>
                <ul class="list-unstyled">
                    @foreach ($categories ?? [] as $cat)
                        <li class="mb-2">
                            <a href="{{ route('berita.category', $cat->slug) }}" class="text-decoration-none text-dark">
                                {{ $cat->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Sosial Media -->
            <div class="col-md-4 mb-4">
                <h6 class="fw-semibold mb-3">Ikuti Kami</h6>
                <a href="#" class="text-dark me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-dark me-3"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="text-dark me-3"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-dark"><i class="bi bi-youtube"></i></a>
            </div>

        </div>

        <div class="text-center mt-4 small text-muted">
            &copy; {{ date('Y') }} CNEWS. All rights reserved.
        </div>
    </div>
</footer>
