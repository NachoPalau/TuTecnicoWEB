<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Mensaje.php

class Mensaje extends Model
{
    protected $fillable = [
        'cliente_id', 'profesional_id', 'de_user_id', 'contenido'
    ];

 public function emisor()
{
    return $this->belongsTo(User::class, 'de_user_id'); // o como se llame tu campo emisor en mensajes
}

}

