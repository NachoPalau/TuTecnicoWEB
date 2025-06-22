<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use App\Models\Profesional;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResenaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Solo usuarios autenticados
    }

    // Mostrar formulario para crear reseña a un profesional
    public function create(Profesional $profesional)
    {
        // Solo clientes pueden ver el formulario
        if (Auth::user()->tipo !== 'cliente') {
            abort(403, 'Solo clientes pueden escribir reseñas.');
        }

        return view('resenas.create', compact('profesional'));
    }

    // Guardar reseña
    public function store(Request $request, Profesional $profesional)
{
    if (Auth::user()->tipo !== 'cliente') {
        abort(403, 'Solo clientes pueden escribir reseñas.');
    }

    $request->validate([
        'comentario' => ['required', 'string', 'max:1000'],
        'valoracion' => ['required', 'integer', 'between:1,5'],
    ]);

    $cliente = Cliente::where('user_id', Auth::id())->firstOrFail();

    Resena::create([
        'cliente_id' => $cliente->id,
        'profesional_id' => $profesional->id,
        'comentario' => $request->comentario,
        'valoracion' => $request->valoracion,
    ]);

    return redirect()->route('perfilProf', ['id' => $profesional->id])->with('success', 'Reseña enviada.');
}
}
