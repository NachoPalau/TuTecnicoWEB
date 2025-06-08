<div class="position-fixed start-50 bottom-0 translate-middle-x mb-3" style="max-width: 400px; z-index: 1050;">
  <div class="border rounded p-3 bg-light" style="font-family: Arial, sans-serif; font-size: 14px;">
    <div class="border rounded p-2 bg-white" style="height: 250px; overflow-y: auto;">
        @foreach ($mensajes as $msg)
            <div style="margin-bottom: 5px; @if($msg->de_user_id == auth()->id()) text-align: right; @endif">
                <strong>{{ $msg->deUser->name }}:</strong> {{ $msg->mensaje }}
                <br><small>{{ $msg->created_at->format('H:i d/m') }}</small>
            </div>
        @endforeach
    </div>

    <form wire:submit.prevent="sendMensaje" style="margin-top: 10px;">
        <input type="text" wire:model.defer="mensaje" placeholder="Escribe tu mensaje..." style="width: 80%;" />
        <button type="submit">Enviar</button>
    </form>
</div>
</div>
