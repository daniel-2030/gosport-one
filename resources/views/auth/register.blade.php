<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre -->
        <div class="mb-3">
            <x-input-label for="nombre" value="Nombre" />
            <x-text-input id="nombre" type="text" name="nombre" :value="old('nombre')" required autofocus />
            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
        </div>

        <!-- Apellidos -->
        <div class="mb-3">
            <x-input-label for="apellidos" value="Apellidos" />
            <x-text-input id="apellidos" type="text" name="apellidos" :value="old('apellidos')" />
            <x-input-error :messages="$errors->get('apellidos')" class="mt-2" />
        </div>

        <!-- Correo -->
        <div class="mb-3">
            <x-input-label for="correo" value="Correo Electrónico" />
            <x-text-input id="correo" type="email" name="correo" :value="old('correo')" required />
            <x-input-error :messages="$errors->get('correo')" class="mt-2" />
        </div>

        <!-- Teléfono -->
        <div class="mb-3">
            <x-input-label for="telefono" value="Teléfono" />
            <x-text-input id="telefono" type="text" name="telefono" :value="old('telefono')" maxlength="15" />
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>

        <!-- Tipo de Documento -->
        <div class="mb-3">
            <x-input-label for="Tipo_Doc" value="Tipo de Documento" />
            <select id="Tipo_Doc" name="Tipo_Doc" class="form-select w-full border-gray-300 rounded-md">
                <option value="">Seleccione...</option>
                <option value="CC" {{ old('Tipo_Doc') == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                <option value="TI" {{ old('Tipo_Doc') == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                <option value="CE" {{ old('Tipo_Doc') == 'CE' ? 'selected' : '' }}>Cédula de Extranjería</option>
            </select>
            <x-input-error :messages="$errors->get('Tipo_Doc')" class="mt-2" />
        </div>

        <!-- Documento -->
        <div class="mb-3">
            <x-input-label for="documento" value="Número de Documento" />
            <x-text-input id="documento" type="text" name="documento" :value="old('documento')" maxlength="50" />
            <x-input-error :messages="$errors->get('documento')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div class="mb-3">
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Contraseña -->
        <div class="mb-4">
            <x-input-label for="password_confirmation" value="Confirmar Contraseña" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex justify-end items-center">
            <a class="text-sm text-gray-600 hover:text-gray-900 me-3" href="{{ route('login') }}">
                ¿Ya tienes cuenta?
            </a>
            <x-primary-button>
                Registrarse
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
