<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Catégories</h4>
            <p class="text-muted mb-0 small">Gérez les catégories de votre menu</p>
        </div>
        <a href="{{ route('categories.create') }}" class="btn text-white" style="background: linear-gradient(135deg, #e74c3c, #c0392b); border-radius: 10px; padding: 8px 20px;">
            <i class="bi bi-plus-lg me-1"></i> Nouvelle
        </a>
    </div>

    <div class="card card-custom">
        <div class="card-header d-flex flex-wrap gap-2 align-items-center justify-content-between">
            <form method="GET" action="{{ route('categories.index') }}" class="d-flex gap-2">
                <div class="input-group" style="max-width: 320px;">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control form-custom border-start-0" placeholder="Rechercher..." value="{{ $search }}">
                </div>
                <button type="submit" class="btn btn-dark btn-action">Chercher</button>
                @if ($search)
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-action">Réinitialiser</a>
                @endif
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width:60px;">#</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th style="width:150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td class="fw-bold">{{ $category->id }}</td>
                                <td><span class="fw-semibold">{{ $category->name }}</span></td>
                                <td class="text-muted">{{ $category->description ?? '—' }}</td>
                                <td class="text-muted small">{{ $category->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-action btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-action btn-danger" data-bs-toggle="modal" data-bs-target="#del{{ $category->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    <div class="modal fade" id="del{{ $category->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content modal-content-custom">
                                                <div class="modal-header modal-header-custom">
                                                    <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2"></i>Confirmer</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body py-4">
                                                    Supprimer <strong>{{ $category->name }}</strong> ? Cette action est irréversible.
                                                </div>
                                                <div class="modal-footer border-top-0 pt-0">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('categories.destroy', $category) }}" method="POST">
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
                            <tr><td colspan="5" class="text-center text-muted py-5">Aucune catégorie trouvée.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <small class="text-muted">{{ $categories->total() }} catégorie(s)</small>
            {{ $categories->links() }}
        </div>
    </div>
</x-app-layout>
