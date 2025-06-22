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

    public function listEspecialidad(Request $request, $especialidad)
    {
        
        $localidad = $request->input('localidad');

        $profesionales = Profesional::with('user')
            ->where('especialidad', $especialidad)
            ->when($localidad, function ($query) use ($localidad) {
                $query->whereHas('user', function ($q) use ($localidad) {
                    $q->where('localidad', $localidad);
                });
            })
            ->get();

        return response(
            view('cliente/servicio', [
                'especialidad' => $especialidad,
                'profesionales' => $profesionales,
                'localidadSeleccionada' => $localidad,

            ])
        );
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            // Mostrar vista (equivalente a show)
            $profesional = Profesional::with(['user', 'resenas.cliente.user'])->findOrFail($id);
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

$profesional = Profesional::with(['user', 'resenas.cliente.user'])->findOrFail($id);
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




    public function cambPerfProf($id)
    {
        $profesional = Profesional::with('user')->findOrFail($id);
        return view('profesional.cambPerfProf', compact('profesional'));
    }

}


