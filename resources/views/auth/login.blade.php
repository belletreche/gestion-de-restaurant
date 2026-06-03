<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h5 class="fw-bold text-center mb-3" style="color: #1a1a2e;">Connexion</h5>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label small fw-semibold">Email</label>
            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   style="border-radius: 10px; padding: 10px 14px; border: 1px solid #e0e0e0;"
                   value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label small fw-semibold">Mot de passe</label>
            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   style="border-radius: 10px; padding: 10px 14px; border: 1px solid #e0e0e0;"
                   required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
            <label for="remember_me" class="form-check-label small">Se souvenir de moi</label>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            @if (Route::has('password.request'))
                <a class="small text-decoration-none" href="{{ route('password.request') }}" style="color: #d35400;">
                    Mot de passe oubli&#233;?
                </a>
            @endif
            <button type="submit" class="btn text-white px-4"
                    style="background: linear-gradient(135deg, #c0392b, #e74c3c); border-radius: 10px; padding: 10px 24px; border: none;">
                Se connecter
            </button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="text-center mt-4 pt-3 border-top">
            <p class="small text-muted mb-0">
                Pas encore de compte?
                <a href="{{ route('register') }}" class="fw-semibold text-decoration-none" style="color: #c0392b;">
                    S'inscrire
                </a>
            </p>
        </div>
    @endif
</x-guest-layout>
