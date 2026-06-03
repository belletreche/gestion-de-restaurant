<x-app-layout>
    <div class="mb-4">
        <h4 class="fw-bold mb-1">Nouvelle Commande</h4>
        <p class="text-muted mb-0 small">Enregistrez une nouvelle commande client</p>
    </div>

    <div class="card card-custom">
        <div class="card-body p-4">
            <form action="{{ route('commandes.store') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Client <span class="text-danger">*</span></label>
                        <input type="text" name="client" class="form-control form-custom @error('client') is-invalid @enderror" value="{{ old('client') }}" required>
                        @error('client') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small">Total (DA) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="total" class="form-control form-custom @error('total') is-invalid @enderror" value="{{ old('total') }}" required min="0">
                        @error('total') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small">Date commande <span class="text-danger">*</span></label>
                        <input type="date" name="date_commande" class="form-control form-custom @error('date_commande') is-invalid @enderror" value="{{ old('date_commande', date('Y-m-d')) }}" required>
                        @error('date_commande') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12 d-flex gap-2">
                        <button type="submit" class="btn text-white px-4" style="background: linear-gradient(135deg, #27ae60, #229954); border-radius: 10px;">
                            <i class="bi bi-check-lg me-1"></i> Enregistrer
                        </button>
                        <a href="{{ route('commandes.index') }}" class="btn btn-outline-secondary px-4" style="border-radius: 10px;">Annuler</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
