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
    public function ver(Request $req)
{
    $user = auth()->user();

    if ($req->has('cliente_id')) {
        $cliente = Cliente::findOrFail($req->cliente_id);
        $profesional = $user->tipo === 'profesional' 
            ? $user->profesional 
            : Profesional::findOrFail($req->profesional_id ?? 0);
    } elseif ($req->has('profesional_id')) {
        $profesional = Profesional::findOrFail($req->profesional_id);
        $cliente = $user->tipo === 'cliente' 
            ? $user->cliente 
            : Cliente::findOrFail($req->cliente_id ?? 0);
    } else {
        abort(404);
    }

   $mensajes = Mensaje::with('emisor')
    ->where('cliente_id', $cliente->id)
    ->where('profesional_id', $profesional->id)
    ->orderBy('created_at', 'asc')
    ->get();


    return view('chat', compact('cliente','profesional','mensajes'));
}



public function enviar(Request $req)
{
    $req->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'profesional_id' => 'required|exists:profesionales,id',
        'contenido' => 'required|string',
    ]);

    Mensaje::create([
        'cliente_id' => $req->cliente_id,
        'profesional_id' => $req->profesional_id,
        'de_user_id' => auth()->user()->id,
        'contenido' => $req->contenido,
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
