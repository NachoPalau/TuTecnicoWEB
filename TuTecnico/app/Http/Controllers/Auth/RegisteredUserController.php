<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Cliente;
use App\Models\Profesional;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request): RedirectResponse
    {            
        //dd($request->all());// $request->validate([...]));

    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'telefono' => ['required', 'string', 'max:20'],
        'tipo' => ['required', 'in:cliente,profesional'],
        'especialidad' => ['required_if:,profesional', 'nullable', 'string', 'max:255'],
        'localidad' => ['required_if:tipo,profesional', 'string', 'max:255'],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'telefono' => $request->telefono,
        'tipo' => $request->tipo,
        'localidad' => $request->localidad ?? null
    ]);


    if ($request->tipo === 'cliente') {
        Cliente::create([
            'user_id' => $user->id,
        ]);
    } else {
        Profesional::create([
            'user_id' => $user->id,
            'especialidad' => $request->especialidad,
            'localidad' => $request->localidad,
        ]);
    }
        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended('/');
    }
}
