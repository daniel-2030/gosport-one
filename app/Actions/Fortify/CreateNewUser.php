<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        Validator::make($input, [
            'nombre' => ['required', 'string', 'max:255'],
            'apellidos' => ['nullable', 'string', 'max:255'],
            'correo' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('usuarios', 'correo'),
            ],
            'telefono' => ['nullable', 'string', 'max:20'],
            'Tipo_Doc' => ['nullable', 'string', 'max:50'],
            'documento' => ['nullable', 'string', 'max:50'],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'nombre' => $input['nombre'],
            'apellidos' => $input['apellidos'] ?? null,
            'correo' => $input['correo'],
            'telefono' => $input['telefono'] ?? null,
            'Tipo_Doc' => $input['Tipo_Doc'] ?? null,
            'documento' => $input['documento'] ?? null,
            'contraseña' => Hash::make($input['password']),
            'id_rol' => 1, // Rol por defecto
        ]);
    }
}
