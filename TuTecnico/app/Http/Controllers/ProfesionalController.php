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
        $localidades = Profesional::join('users', 'profesionales.user_id', '=', 'users.id')
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
                                        ->join('users', 'profesionales.user_id', '=', 'users.id')
                                        ->where('users.localidad', $localidad)
                                        ->select('profesionales.*', 'users.localidad')
                                        ->get();
        }

        // Retornamos la vista con los datos
        return response(
            view('cliente/servicio', [
                'localidades' => $localidades,
                'profesionales' => $profesionales,
                'especialidad' => $especialidad
            ])
        );
    }
   public function update(Request $request, $id)
{
    if ($request->isMethod('get')) {
        // Mostrar vista (equivalente a show)
        $profesional = Profesional::with('user')->findOrFail($id);
        return view('profesional/perfilProf', compact('profesional'));
    }

    if ($request->isMethod('post')) {
        // Actualizar datos (equivalente a update)
            $request->validate([
                'name' => 'required|string',
                'especialidad' => 'required|string',
                'localidad' => 'required|string',
                'descripcion' => 'nullable|string',
            ]);

            $profesional = Profesional::findOrFail($id);
            $user = $profesional->user;

            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado para este profesional'], 400);
            }

            // Actualiza usuario
            $user->name = $request->input('name');
            $user->localidad = $request->input('localidad');
            $user->save();

            // Actualiza profesional
            $profesional->especialidad = $request->input('especialidad');
            $profesional->descripcion = $request->input('descripcion');
            $profesional->save();

            return view('profesional/perfilProf', compact('profesional'))
                ->with('success', 'Perfil actualizado correctamente.');
        }
}

    public function clientes()
    {
        $clientes = Profesional::with('user')
            ->whereHas('user', function ($query) {
                $query->where('tipo', 'cliente');
            })
            ->get();

        return view('profesional/clientes', compact('clientes'));
    }

    
  public function mensajes()
    {
        // Aquí puedes implementar la lógica para obtener las estadísticas del profesional
        return view('mensajes');
    }

   public function cambPerfProf($id)
{
    $profesional = Profesional::with('user')->findOrFail($id);
    return view('profesional.cambPerfProf', compact('profesional'));
}

}


