<x-app-layout>
    <div class="mb-4">
        <h4 class="fw-bold mb-1">Détails de la Commande #{{ $commande->id }}</h4>
        <p class="text-muted mb-0 small">{{ $commande->client }}</p>
    </div>

    <div class="card card-custom">
        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold small text-muted">Client</label>
                    <p class="fw-semibold fs-5 mb-0">{{ $commande->client }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold small text-muted">Total</label>
                    <p class="fw-bold fs-4 mb-0" style="color: var(--primary);">{{ number_format($commande->total, 2, ',', ' ') }} DA</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold small text-muted">Date de commande</label>
                    <p class="fw-semibold mb-0">{{ $commande->date_commande->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold small text-muted">Enregistrée le</label>
                    <p class="fw-semibold mb-0">{{ $commande->created_at->format('d/m/Y à H:i') }}</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="d-flex gap-2">
                <a href="{{ route('commandes.index') }}" class="btn btn-outline-secondary px-4" style="border-radius: 10px;">
                    <i class="bi bi-arrow-left me-1"></i> Retour
                </a>
                <button type="button" class="btn btn-danger px-4" style="border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#delModal">
                    <i class="bi bi-trash me-1"></i> Supprimer
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content modal-content-custom">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2"></i>Confirmer</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body py-4">
                    Supprimer la commande de <strong>{{ $commande->client }}</strong> ?
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form action="{{ route('commandes.destroy', $commande) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
