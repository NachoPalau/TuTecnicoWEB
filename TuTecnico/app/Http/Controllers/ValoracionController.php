<?php

namespace App\Http\Controllers;

use App\Models\Valoracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValoracionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'profesional_id' => 'required|exists:profesionales,id',
            'valoracion' => 'required|integer|between:1,5',
            'comentario' => 'nullable|string|max:500'
        ]);

        // Verificar que el usuario es cliente
        if (Auth::user()->tipo != 'cliente') {
            return back()->with('error', 'Solo los clientes pueden valorar profesionales.');
        }

        // Verificar que no haya valorado antes
        $existing = Valoracion::where('cliente_id', Auth::id())
                            ->where('profesional_id', $request->profesional_id)
                            ->exists();
        
        if ($existing) {
            return back()->with('error', 'Ya has valorado a este profesional.');
        }

        // Crear la valoración
        $valoracion = Valoracion::create([
            'cliente_id' => Auth::id(),
            'profesional_id' => $request->profesional_id,
            'valoracion' => $request->valoracion,
            'comentario' => $request->comentario
        ]);

        // Actualizar el promedio del profesional
        $profesional = $valoracion->profesional;
        $profesional->valoracion = $profesional->valoraciones()->avg('valoracion');
        $profesional->save();

        return back()->with('success', 'Valoración enviada correctamente.');
    }
}