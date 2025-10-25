<x-app-layout>
    <div class="py-12" style="padding-top: 6rem;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-8">
                    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white p-6 shadow sm:rounded-lg">
                            
                            <div class="flex items-center justify-center gap-4 mb-6">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                                    {{ __('Editar Usuario') }}
                                </h2>
                            </div>

                            {{-- FORMULARIO --}}
                            <form action="{{ route('usuarios.update', $usuario) }}" method="POST" class="space-y-6">
                                @csrf
                                @method('PUT')

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    
                                    {{-- Nombre --}}
                                    <div>
                                        <label for="nombre" class="block text-sm font-medium mb-1">
                                            Nombre *
                                        </label>
                                        <input type="text" 
                                               name="nombre" 
                                               id="nombre" 
                                               value="{{ old('nombre', $usuario->nombre) }}"
                                               class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500"
                                               required>
                                        @error('nombre')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Apellidos --}}
                                    <div>
                                        <label for="apellidos" class="block text-sm font-medium mb-1">
                                            Apellidos
                                        </label>
                                        <input type="text" 
                                               name="apellidos" 
                                               id="apellidos" 
                                               value="{{ old('apellidos', $usuario->apellidos) }}"
                                               class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                                        @error('apellidos')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Correo --}}
                                    <div>
                                        <label for="correo" class="block text-sm font-medium mb-1">
                                            Correo Electrónico *
                                        </label>
                                        <input type="email" 
                                               name="correo" 
                                               id="correo" 
                                               value="{{ old('correo', $usuario->correo) }}"
                                               class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500"
                                               required>
                                        @error('correo')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Teléfono --}}
                                    <div>
                                        <label for="telefono" class="block text-sm font-medium mb-1">
                                            Teléfono
                                        </label>
                                        <input type="text" 
                                               name="telefono" 
                                               id="telefono" 
                                               maxlength="10" 
                                               pattern="[0-9]{6,10}"
                                               value="{{ old('telefono', $usuario->telefono) }}"
                                               class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                                        @error('telefono')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Tipo de Documento --}}
                                    <div>
                                        <label for="Tipo_Doc" class="block text-sm font-medium mb-1">
                                            Tipo de Documento
                                        </label>
                                        <select name="Tipo_Doc" 
                                                id="Tipo_Doc" 
                                                class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                                            <option value="">Seleccione...</option>
                                            <option value="CC" {{ old('Tipo_Doc', $usuario->Tipo_Doc) == 'CC' ? 'selected' : '' }}>
                                                Cédula de Ciudadanía
                                            </option>
                                            <option value="TI" {{ old('Tipo_Doc', $usuario->Tipo_Doc) == 'TI' ? 'selected' : '' }}>
                                                Tarjeta de Identidad
                                            </option>
                                            <option value="CE" {{ old('Tipo_Doc', $usuario->Tipo_Doc) == 'CE' ? 'selected' : '' }}>
                                                Cédula de Extranjería
                                            </option>
                                            <option value="PAS" {{ old('Tipo_Doc', $usuario->Tipo_Doc) == 'PAS' ? 'selected' : '' }}>
                                                Pasaporte
                                            </option>
                                        </select>
                                        @error('Tipo_Doc')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Número de Documento --}}
                                    <div>
                                        <label for="documento" class="block text-sm font-medium mb-1">
                                            Número de Documento
                                        </label>
                                        <input type="text" 
                                               name="documento" 
                                               id="documento" 
                                               value="{{ old('documento', $usuario->documento) }}"
                                               class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                                        @error('documento')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Rol --}}
                                    <div>
                                        <label for="id_rol" class="block text-sm font-medium mb-1">
                                            Rol
                                        </label>
                                        <select name="id_rol" 
                                                id="id_rol" 
                                                class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                                            <option value="">Sin rol asignado</option>
                                            @foreach($roles as $rol)
                                                <option value="{{ $rol->id_rol }}" 
                                                        {{ old('id_rol', $usuario->id_rol) == $rol->id_rol ? 'selected' : '' }}>
                                                    {{ $rol->nombre_rol }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_rol')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>

                                {{-- Nota sobre contraseña --}}
                                <div class="bg-blue-900 border border-blue-700 rounded p-3">
                                    <p class="text-sm text-blue-200">
                                        ℹ️ <strong>Nota:</strong> La contraseña no se puede editar desde aquí. 
                                        El usuario debe cambiarla desde su perfil.
                                    </p>
                                </div>

                                {{-- BOTONES --}}
                                <div class="pt-4 flex gap-3">
                                    <button type="submit" 
                                            class="px-6 py-2 border rounded bg-indigo-600 text-white hover:bg-indigo-700 transition">
                                        💾 Actualizar Usuario
                                    </button>

                                    <a href="{{ route('usuarios.index') }}"
                                       class="px-6 py-2 border rounded bg-gray-500 text-white hover:bg-gray-600 transition">
                                        ❌ Cancelar
                                    </a>
                                </div>
                            </form>
                            {{-- FIN FORMULARIO --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #32373dff !important;
            color: white;
        }
        
        .bg-white {
            background-color: #32373dff !important;
            color: white;
        }
        
        input, select {
            color: black !important;
            background-color: white !important;
        }

        .text-gray-800 {
            color: #fff !important;
        }

        label {
            color: #e5e7eb !important;
        }
    </style>
</x-app-layout>