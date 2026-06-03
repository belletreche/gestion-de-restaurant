@php $featured = App\Models\Plat::with('category')->latest()->take(4)->get(); @endphp

<x-app-layout>
    <div class="welcome-section">
        <i class="bi bi-cup-hot-fill chef-icon"></i>
        <h3>Bienvenue, {{ Auth::user()->name }}!</h3>
        <p class="mb-0">Gérez votre restaurant en toute simplicité — catégories, plats et commandes.</p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card stat-card text-white" style="background: linear-gradient(135deg, #e74c3c, #c0392b);">
                <div class="card-body d-flex align-items-start gap-3">
                    <div class="stat-icon" style="background: rgba(255,255,255,.15);">
                        <i class="bi bi-list-ul"></i>
                    </div>
                    <div>
                        <p class="stat-label">Catégories</p>
                        <h3 class="stat-number">{{ $categories }}</h3>
                        <a href="{{ route('categories.index') }}" class="text-white text-decoration-none small">Voir tout →</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card text-white" style="background: linear-gradient(135deg, #e67e22, #d35400);">
                <div class="card-body d-flex align-items-start gap-3">
                    <div class="stat-icon" style="background: rgba(255,255,255,.15);">
                        <i class="bi bi-egg-fried"></i>
                    </div>
                    <div>
                        <p class="stat-label">Plats</p>
                        <h3 class="stat-number">{{ $plats }}</h3>
                        <a href="{{ route('plats.index') }}" class="text-white text-decoration-none small">Voir tout →</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card text-white" style="background: linear-gradient(135deg, #27ae60, #229954);">
                <div class="card-body d-flex align-items-start gap-3">
                    <div class="stat-icon" style="background: rgba(255,255,255,.15);">
                        <i class="bi bi-cart-check-fill"></i>
                    </div>
                    <div>
                        <p class="stat-label">Commandes</p>
                        <h3 class="stat-number">{{ $commandes }}</h3>
                        <a href="{{ route('commandes.index') }}" class="text-white text-decoration-none small">Voir tout →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-star-fill text-warning me-2"></i> Plats récents</span>
                    <a href="{{ route('plats.index') }}" class="btn btn-sm btn-outline-dark btn-action">Voir tous les plats</a>
                </div>
                <div class="card-body p-4">
                    @if ($featured->count())
                        <div class="row g-3">
                            @foreach ($featured as $plat)
                                <div class="col-md-3 col-6">
                                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 14px;">
                                        <img src="{{ $plat->image_url }}" alt="{{ $plat->nom }}"
                                             style="height: 160px; object-fit: cover; border-radius: 14px 14px 0 0;">
                                        <div class="card-body p-3">
                                            <h6 class="fw-bold mb-1" style="font-size:.9rem;">{{ $plat->nom }}</h6>
                                            <span class="badge-cat">{{ $plat->category->name }}</span>
                                            <div class="mt-2 fw-bold" style="color: var(--primary);">
                                                {{ number_format($plat->prix, 2, ',', ' ') }} DA
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center py-4 mb-0">Aucun plat pour le moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
