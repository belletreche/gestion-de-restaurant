<x-app-layout>
    <div class="mb-4">
        <h4 class="fw-bold mb-1">Modifier le Plat</h4>
        <p class="text-muted mb-0 small">{{ $plat->nom }}</p>
    </div>

    <div class="card card-custom">
        <div class="card-body p-4">
            <form action="{{ route('plats.update', $plat) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Nom <span class="text-danger">*</span></label>
                        <input type="text" name="nom" class="form-control form-custom @error('nom') is-invalid @enderror" value="{{ old('nom', $plat->nom) }}" required>
                        @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small">Prix (DA) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="prix" class="form-control form-custom @error('prix') is-invalid @enderror" value="{{ old('prix', $plat->prix) }}" required min="0.01">
                        @error('prix') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small">Catégorie <span class="text-danger">*</span></label>
                        <select name="categorie_id" class="form-select form-custom @error('categorie_id') is-invalid @enderror">
                            <option value="">Sélectionner</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('categorie_id', $plat->categorie_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('categorie_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        @if ($plat->image)
                            <div class="mb-2">
                                <img src="{{ $plat->image_url }}" alt="{{ $plat->nom }}" class="rounded" width="100" height="100" style="object-fit: cover; border-radius: 10px;">
                            </div>
                        @endif
                        <label class="form-label fw-semibold small">Image</label>
                        <input type="file" name="image" class="form-control form-custom @error('image') is-invalid @enderror" accept="image/*">
                        <div class="form-text small">Laissez vide pour conserver l'image actuelle.</div>
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold small">Description</label>
                        <textarea name="description" rows="4" class="form-control form-custom @error('description') is-invalid @enderror">{{ old('description', $plat->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12 d-flex gap-2">
                        <button type="submit" class="btn text-white px-4" style="background: linear-gradient(135deg, #e67e22, #d35400); border-radius: 10px;">
                            <i class="bi bi-check-lg me-1"></i> Mettre à jour
                        </button>
                        <a href="{{ route('plats.index') }}" class="btn btn-outline-secondary px-4" style="border-radius: 10px;">Annuler</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
