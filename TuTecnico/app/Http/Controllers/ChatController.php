<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use App\Models\Profesional;
use App\Models\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ChatController extends Controller
{
    public function ver(Request $request)
{
    $cliente_id = $request->cliente_id;
    $profesional_id = $request->profesional_id;

    if (!$cliente_id && !$profesional_id) {
        abort(404, 'No especificado cliente o profesional.');
    }

    if ($cliente_id) {
        $cliente = Cliente::with('user')->findOrFail($cliente_id);
    }
    if ($profesional_id) {
        $profesional = Profesional::with('user')->findOrFail($profesional_id);
    }

    $mensajes = Mensaje::where(function($q) use ($cliente_id, $profesional_id) {
        $q->where('cliente_id', $cliente_id)
          ->where('profesional_id', $profesional_id);
    })->orderBy('created_at')->get();

    return view('chat', compact('cliente', 'profesional', 'mensajes'));
}

    public function enviar(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'profesional_id' => 'required|exists:profesionales,id',
            'contenido' => 'required|string',
        ]);

        Mensaje::create([
            'cliente_id' => $request->cliente_id,
            'profesional_id' => $request->profesional_id,
            'contenido' => $request->contenido,
            'emisor_id' => auth()->id(), // ID del user autenticado
        ]);

        return back();
    }
public function seleccionar()
{
    $user = Auth::user();

    if ($user->tipo === 'profesional') {
        $profesional = Profesional::where('user_id', $user->id)->firstOrFail();

        $clientes = Cliente::whereHas('reservas', function ($q) use ($profesional) {
            $q->where('profesional_id', $profesional->id);
        })->with('user')->get();

        return view('seleccionarChat', compact('clientes'))->with('tipo', 'profesional');

    } else {
        $cliente = Cliente::where('user_id', $user->id)->firstOrFail();

        $profesionales = Profesional::whereHas('reservas', function ($q) use ($cliente) {
            $q->where('cliente_id', $cliente->id);
        })->with('user')->get();

        return view('seleccionarChat', compact('profesionales'))->with('tipo', 'cliente');
    }
}




}
