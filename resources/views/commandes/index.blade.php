<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Commandes</h4>
            <p class="text-muted mb-0 small">Suivez toutes les commandes de votre restaurant</p>
        </div>
        <a href="{{ route('commandes.create') }}" class="btn text-white" style="background: linear-gradient(135deg, #27ae60, #229954); border-radius: 10px; padding: 8px 20px;">
            <i class="bi bi-plus-lg me-1"></i> Nouvelle Commande
        </a>
    </div>

    <div class="card card-custom">
        <div class="card-header">
            <span><i class="bi bi-receipt me-2"></i> Liste des commandes</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width:60px;">#</th>
                            <th>Client</th>
                            <th>Total</th>
                            <th>Date commande</th>
                            <th>Créée le</th>
                            <th style="width:160px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($commandes as $commande)
                            <tr>
                                <td class="fw-bold">{{ $commande->id }}</td>
                                <td><span class="fw-semibold">{{ $commande->client }}</span></td>
                                <td class="fw-bold" style="color: var(--primary);">{{ number_format($commande->total, 2, ',', ' ') }} DA</td>
                                <td>{{ $commande->date_commande->format('d/m/Y') }}</td>
                                <td class="text-muted small">{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('commandes.show', $commande) }}" class="btn btn-sm btn-action btn-info text-white">
                                            <i class="bi bi-eye"></i> Détails
                                        </a>
                                        <button type="button" class="btn btn-sm btn-action btn-danger" data-bs-toggle="modal" data-bs-target="#del{{ $commande->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    <div class="modal fade" id="del{{ $commande->id }}" tabindex="-1">
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
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-5">Aucune commande trouvée.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <small class="text-muted">{{ $commandes->total() }} commande(s)</small>
            {{ $commandes->links() }}
        </div>
    </div>
</x-app-layout>
