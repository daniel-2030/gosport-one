<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::with('rol')
            ->orderBy('id_usuario', 'asc')
            ->get();

        return view('usuarios.table', compact('usuarios'));
    }

    public function create()
    {
        $roles = Rol::orderBy('nombre_rol')->get(['id_rol', 'nombre_rol']);
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellidos' => 'nullable|string|max:100',
            'correo' => 'required|email|unique:usuarios,correo',
            'contraseña' => 'required|string|min:6',
            'telefono' => 'nullable|string|max:20',
            'Tipo_Doc' => 'nullable|string|max:20',
            'documento' => 'nullable|string|max:50',
            'id_rol' => 'nullable|integer|exists:rol,id_rol',
        ]);

        User::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'correo' => $request->correo,
            'contraseña' => Hash::make($request->contraseña),
            'telefono' => $request->telefono,
            'Tipo_Doc' => $request->Tipo_Doc,
            'documento' => $request->documento,
            'id_rol' => $request->id_rol,
        ]);

        return redirect()->route('usuarios.index')->with('ok', 'Usuario creado correctamente.');
    }

    public function edit(User $usuario)
    {
        $roles = Rol::orderBy('nombre_rol')->get(['id_rol', 'nombre_rol']);
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellidos' => 'nullable|string|max:100',
            'correo' => 'required|email|unique:usuarios,correo,' . $usuario->id_usuario . ',id_usuario',
            'telefono' => 'nullable|string|max:20',
            'Tipo_Doc' => 'nullable|string|max:20',
            'documento' => 'nullable|string|max:50',
            'id_rol' => 'nullable|integer|exists:rol,id_rol',
        ]);

        $usuario->update($request->only([
            'nombre',
            'apellidos',
            'correo',
            'telefono',
            'Tipo_Doc',
            'documento',
            'id_rol',
        ]));

        return redirect()->route('usuarios.index')->with('ok', 'Usuario actualizado exitosamente.');
    }

    public function destroy(User $usuario)
    {
        try {
            $usuario->delete();
            return back()->with('ok', 'Usuario eliminado correctamente.');
        } catch (\Throwable $e) {
            return back()->withErrors('No se puede eliminar: tiene registros relacionados.');
        }
    }
}
