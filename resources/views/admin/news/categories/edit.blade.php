<div class="modal fade" id="editCategoryModal{{ $cat->id }}" tabindex="-1"
    aria-labelledby="editCategoryModalLabel{{ $cat->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('news_categories.update', $cat->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel{{ $cat->id }}">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title{{ $cat->id }}" class="form-label">Judul Kategori</label>
                        <input type="text" name="title" id="title{{ $cat->id }}"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $cat->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
