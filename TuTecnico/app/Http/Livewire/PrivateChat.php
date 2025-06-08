<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Mensaje; // Ajusta al modelo real que uses para los mensajes
use Illuminate\Support\Facades\Auth;

class PrivateChat extends Component
{
    public $chatWithUserId;
    public $mensaje;

    public function mount($chatWithUserId)
    {
        $this->chatWithUserId = $chatWithUserId;
    }

    // Método para obtener los mensajes (puede ser una propiedad o método)
    public function getMensajesProperty()
    {
        // Suponiendo que tienes un modelo Mensaje con columnas:
        // de_user_id (emisor), para_user_id (receptor), mensaje
        $userId = Auth::id();

        return Mensaje::where(function ($query) use ($userId) {
            $query->where('de_user_id', $userId)
                  ->orWhere('para_user_id', $userId);
        })->where(function ($query) {
            $query->where('de_user_id', $this->chatWithUserId)
                  ->orWhere('para_user_id', $this->chatWithUserId);
        })->orderBy('created_at', 'asc')->get();
    }

    public function sendMensaje()
    {
        $this->validate([
            'mensaje' => 'required|string',
        ]);

        Mensaje::create([
            'de_user_id' => Auth::id(),
            'para_user_id' => $this->chatWithUserId,
            'mensaje' => $this->mensaje,
        ]);

        $this->mensaje = '';
    }

    public function render()
    {
        return view('livewire.private-chat', [
            'mensajes' => $this->mensajes, // Pasamos los mensajes a la vista
        ]);
    }

    // En tu controlador:
public function chat($userId) {
    return view('chat', ['chatWithUserId' => $userId]);
}

}
