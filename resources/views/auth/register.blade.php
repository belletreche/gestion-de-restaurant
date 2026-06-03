<x-guest-layout>
    <h5 class="fw-bold text-center mb-3" style="color: #1a1a2e;">Inscription</h5>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label small fw-semibold">Nom</label>
            <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   style="border-radius: 10px; padding: 10px 14px; border: 1px solid #e0e0e0;"
                   value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label small fw-semibold">Email</label>
            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   style="border-radius: 10px; padding: 10px 14px; border: 1px solid #e0e0e0;"
                   value="{{ old('email') }}" required autocomplete="username">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label small fw-semibold">Mot de passe</label>
            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   style="border-radius: 10px; padding: 10px 14px; border: 1px solid #e0e0e0;"
                   required autocomplete="new-password">
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label small fw-semibold">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   style="border-radius: 10px; padding: 10px 14px; border: 1px solid #e0e0e0;"
                   required autocomplete="new-password">
            @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a class="small text-decoration-none" href="{{ route('login') }}" style="color: #d35400;">
                D&#233;j&#224; inscrit?
            </a>
            <button type="submit" class="btn text-white px-4"
                    style="background: linear-gradient(135deg, #c0392b, #e74c3c); border-radius: 10px; padding: 10px 24px; border: none;">
                S'inscrire
            </button>
        </div>
    </form>
</x-guest-layout>
