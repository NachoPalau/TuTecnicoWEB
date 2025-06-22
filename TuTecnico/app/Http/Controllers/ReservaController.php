<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Profesional;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
public function crear(Request $request)
{
   $request->validate([
    'fecha' => 'required|date',
    'profesional_id' => 'required|integer|exists:profesionales,id',
]);


    $cliente = Cliente::where('user_id', auth()->id())->first();

    if (!$cliente) {
        return redirect()->back();
    }

    // Validar si ya hay reserva pendiente en ese día y hora para el profesional
    $fecha = Carbon::parse($request->fecha);
    $inicioSlot = $fecha->copy()->startOfMinute();
    $finSlot = $fecha->copy()->endOfMinute();

  $yaReservado = Reserva::where('fecha', $request->fecha)
    ->where('profesional_id', $request->profesional_id)
    ->where('cliente_id', $cliente->id) 
    ->where('estado', 'pendiente')
    ->exists();


    if ($yaReservado) {
        return redirect()->back();
    }

   Reserva::create([
    'fecha' => $request->fecha,
    'profesional_id' => $request->profesional_id, // debe ser un número
    'cliente_id' => $cliente->id, // debe ser número, no texto
    'estado' => 'pendiente',
]);


    return redirect()->back();
}


public function cancelar(Request $request, $id)
{
    $reserva = Reserva::findOrFail($id); // Usa el ID que Laravel te pasa, no lo fuerces

    $cliente = \App\Models\Cliente::where('user_id', auth()->id())->first();

    if (!$cliente || $reserva->cliente_id !== $cliente->id) {
        return redirect()->back()->with('error', 'No puedes eliminar esta reserva.');
    }

    if ($reserva->estado !== 'pendiente') {
        return redirect()->back()->with('error', 'Solo puedes eliminar reservas pendientes.');
    }

    $reserva->delete();

    return redirect()->back()->with('success', 'Reserva eliminada correctamente.');
}




public function mostrarReservas(Request $request, $id) {
    $profesional = User::findOrFail($id);

    $inicioSemanaStr = $request->query('inicioSemana');
    if ($inicioSemanaStr && Carbon::hasFormat($inicioSemanaStr, 'Y-m-d')) {
        $inicioSemana = Carbon::createFromFormat('Y-m-d', $inicioSemanaStr)->startOfWeek();
    } else {
        $inicioSemana = Carbon::now()->startOfWeek();
    }

    $finSemana = $inicioSemana->copy()->addDays(6)->endOfDay();

    $reservas = Reserva::where('profesional_id', $id)
        ->whereBetween('fecha', [$inicioSemana, $finSemana])
        ->get();

    $reservasBD = $reservas->keyBy(function($item) {
        return $item->fecha->format('Y-m-d H:i');
    });

    return response(view('reservas', compact('reservasBD', 'profesional', 'inicioSemana')));
}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cambiarEstado(Request $request, $id)
{
    $request->validate([
        'estado' => 'required|in:pendiente,aceptada,rechazada',
    ]);

    $reserva = Reserva::findOrFail($id);

    if (auth()->user()->profesional->id !== $reserva->profesional_id) {
        abort(403);
    }

    $reserva->estado = $request->estado;
    $reserva->save();

    return redirect()->back();
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
{
    $request->validate([
        'fecha' => 'required|date',
        'profesional_id' => 'required|exists:profesionales,id',
    ]);

    Reserva::create([
        'cliente_id' => auth()->user()->cliente->id,
        'profesional_id' => $request->input('profesional_id'),
        'fecha' => $request->input('fecha'),
        'estado' => 'reservar',
    ]);

    return response(back()->with('ok', 'Reserva solicitada'));
}


 public function reservas()
{
    $inicioSemana = now()->startOfWeek(); // lunes

    // Traer reservas existentes para la semana
    $reservasBD = Reserva::whereBetween('fecha', [
        $inicioSemana,
        $inicioSemana->copy()->addDays(7)
    ])->get()->keyBy(function ($r) {
        return $r->fecha->format('Y-m-d H:i');
    });

    $slots = [];

    // Generar todos los slots posibles de la semana
    for ($dia = 0; $dia < 7; $dia++) {
        for ($hora = 8; $hora < 18; $hora += 2) {
            $slot = $inicioSemana->copy()->addDays($dia)->setTime($hora, 0);
            $clave = $slot->format('Y-m-d H:i');

            $reserva = $reservasBD->get($clave);

            $slots[] = (object)[
                'fecha' => $slot,
                'estado' => $reserva->estado ?? 'reservar',
                'id' => $reserva->id ?? null,
            ];
        }
    }

    return view('reservas', [
        'reservas' => $slots,
        'reservasBD' => $reservasBD,
        'inicioSemana' => $inicioSemana,
    ]);
}
public function misReservas()
{
    if ($cliente = Cliente::where('user_id', auth()->id())->first()) {
        $reservas = Reserva::with('profesional.user')
            ->where('cliente_id', $cliente->id)
            ->orderBy('fecha', 'asc')
            ->get();

        return view('cliente/misReservas', compact('reservas'));
    } elseif ($profesional = Profesional::where('user_id', auth()->id())->first()) {
        $reservas = Reserva::with('cliente.user')
            ->where('profesional_id', $profesional->id)
            ->orderBy('fecha', 'asc')
            ->get();

        return view('cliente/misReservas', compact('reservas'));
    } else {
        abort(403, 'No autorizado.');
    }
}



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    

    
}
