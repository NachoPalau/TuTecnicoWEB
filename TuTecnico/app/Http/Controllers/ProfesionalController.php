<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use PhpParser\Builder\Function_;

class ProfesionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listEspecialidad(Request $request, $especialidad) {
    // Obtenemos las localidades disponibles
    $localidades = Profesional::localidades();
        
    // Obtenemos los profesionales de la especialidad seleccionada
    $profesionales = Profesional::where('especialidad', $especialidad)->get();

    // Si hay una localidad seleccionada en el POST
    if ($request->isMethod('post') && $request->has('localidad')) {
        $localidad = $request->input('localidad');
        $profesionales = Profesional::especialidadYLocalidad($especialidad, $localidad);
    }

    // Retornamos la vista con los datos:
    return view('servicio', [
        'localidades' => $localidades,
        'profesionales' => $profesionales,
        'especialidad' => $especialidad ]);
    }
}
