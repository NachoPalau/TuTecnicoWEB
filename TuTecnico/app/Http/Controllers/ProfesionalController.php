<?php
namespace App\Http\Controllers;

use App\Models\Profesional;
use Illuminate\Http\Request;

class ProfesionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function listEspecialidad(Request $request, $especialidad) {
        // Obtenemos las localidades disponibles usando la relación con la tabla 'users'
        $localidades = Profesional::join('users', 'profesionals.user_id', '=', 'users.id')
                                  ->distinct()
                                  ->pluck('users.localidad');
        
        // Obtenemos los profesionales de la especialidad seleccionada
        $profesionales = Profesional::with('user')
                            ->where('especialidad', $especialidad)
                            ->get();


        // Si hay una localidad seleccionada en el POST
        if ($request->isMethod('post') && $request->has('localidad')) {
            $localidad = $request->input('localidad');
            
            // Modificamos la consulta para filtrar por especialidad y localidad
            $profesionales = Profesional::where('especialidad', $especialidad)
                                        ->join('users', 'profesionals.user_id', '=', 'users.id')
                                        ->where('users.localidad', $localidad)
                                        ->select('profesionals.*', 'users.localidad')
                                        ->get();
        }

        // Retornamos la vista con los datos
        return view('servicio', [
            'localidades' => $localidades,
            'profesionales' => $profesionales,
            'especialidad' => $especialidad
        ]);
    }
    public function show($id)
{
    $profesional = Profesional::with('user')->findOrFail($id);
    return view('perfilProf', compact('profesional'));
}
}
