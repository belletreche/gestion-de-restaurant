<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Plats</h4>
            <p class="text-muted mb-0 small">Gérez tous les plats de votre restaurant</p>
        </div>
        <a href="{{ route('plats.create') }}" class="btn text-white" style="background: linear-gradient(135deg, #e67e22, #d35400); border-radius: 10px; padding: 8px 20px;">
            <i class="bi bi-plus-lg me-1"></i> Nouveau Plat
        </a>
    </div>

    <div class="card card-custom">
        <div class="card-header d-flex flex-wrap gap-2 align-items-center justify-content-between">
            <form method="GET" action="{{ route('plats.index') }}" class="d-flex gap-2">
                <div class="input-group" style="max-width: 320px;">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control form-custom border-start-0" placeholder="Rechercher un plat..." value="{{ $search }}">
                </div>
                <button type="submit" class="btn btn-dark btn-action">Chercher</button>
                @if ($search)
                    <a href="{{ route('plats.index') }}" class="btn btn-outline-secondary btn-action">Réinitialiser</a>
                @endif
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width:70px;">Photo</th>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Prix</th>
                            <th>Date</th>
                            <th style="width:150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($plats as $plat)
                            <tr>
                                <td><img src="{{ $plat->image_url }}" alt="{{ $plat->nom }}" class="dish-img"></td>
                                <td><span class="fw-semibold">{{ $plat->nom }}</span></td>
                                <td><span class="badge-cat"><i class="bi bi-tag-fill me-1"></i>{{ $plat->category->name }}</span></td>
                                <td class="fw-bold" style="color: var(--primary);">{{ number_format($plat->prix, 2, ',', ' ') }} DA</td>
                                <td class="text-muted small">{{ $plat->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('plats.edit', $plat) }}" class="btn btn-sm btn-action btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-action btn-danger" data-bs-toggle="modal" data-bs-target="#del{{ $plat->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    <div class="modal fade" id="del{{ $plat->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content modal-content-custom">
                                                <div class="modal-header modal-header-custom">
                                                    <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2"></i>Confirmer</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body py-4">
                                                    Supprimer <strong>{{ $plat->nom }}</strong> ? Cette action est irréversible.
                                                </div>
                                                <div class="modal-footer border-top-0 pt-0">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('plats.destroy', $plat) }}" method="POST">
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
                            <tr><td colspan="6" class="text-center text-muted py-5">Aucun plat trouvé.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <small class="text-muted">{{ $plats->total() }} plat(s)</small>
            {{ $plats->links() }}
        </div>
    </div>
</x-app-layout>
