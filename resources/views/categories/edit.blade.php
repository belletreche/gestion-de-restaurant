<x-app-layout>
    <div class="mb-4">
        <h4 class="fw-bold mb-1">Modifier la Catégorie</h4>
        <p class="text-muted mb-0 small">{{ $category->name }}</p>
    </div>

    <div class="card card-custom">
        <div class="card-body p-4">
            <form action="{{ route('categories.update', $category) }}" method="POST">
                @csrf @method('PUT')
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Nom <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-custom @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold small">Description</label>
                        <textarea name="description" rows="4" class="form-control form-custom @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12 d-flex gap-2">
                        <button type="submit" class="btn text-white px-4" style="background: linear-gradient(135deg, #e74c3c, #c0392b); border-radius: 10px;">
                            <i class="bi bi-check-lg me-1"></i> Mettre à jour
                        </button>
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary px-4" style="border-radius: 10px;">Annuler</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
