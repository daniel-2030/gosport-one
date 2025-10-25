<x-guest-layout>
    <x-auth-session-status class="mb-3" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <x-input-label for="correo" value="Correo Electrónico" />
            <x-text-input id="correo"
                          type="email"
                          name="correo"
                          :value="old('correo')"
                          required
                          autofocus />
            <x-input-error :messages="$errors->get('correo')" class="mt-2" />
        </div>

        <div class="mb-3">
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password"
                          type="password"
                          name="password"
                          required
                          autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mb-3 form-check">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label">Recuérdame</label>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <x-primary-button>Iniciar Sesión</x-primary-button>
        </div>
    </form>
</x-guest-layout>
