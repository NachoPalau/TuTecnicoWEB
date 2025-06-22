<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Profesional;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Mostrar la vista de registro.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Procesar el registro de usuario.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'telefono' => ['required', 'string', 'max:20'],
            'tipo' => ['required', 'in:cliente,profesional'],
            'especialidad' => ['required_if:tipo,profesional', 'nullable', 'string', 'max:255'],
            'localidad' => ['required_if:tipo,profesional', 'string', 'max:255'],
            'imagen' => ['image'],
        ]);

        $nombreImagen = 'fotoAvatar.png';

        // Subida de imagen solo si es profesional
        if ($request->tipo === 'profesional' && $request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('IMG/perfiles'), $nombreImagen);
        }

        // Crear el usuario base
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
            'tipo' => $request->tipo,
            'localidad' => $request->localidad ?? null,
        ]);

        // Crear el modelo relacionado
        if ($request->tipo === 'cliente') {
            Cliente::create([
                'user_id' => $user->id,
            ]);
        } else {
            Profesional::create([
                'user_id' => $user->id,
                'especialidad' => $request->especialidad,
                'localidad' => $request->localidad,
                'imagen' => $nombreImagen,
            ]);
        }

        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Usuario registrado. Inicia sesión.');
    }
}
