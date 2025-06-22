<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{
   protected $fillable = ['cliente_id', 'profesional_id', 'comentario', 'valoracion'];

public function cliente() {
    return $this->belongsTo(Cliente::class, 'cliente_id');
}
public function resenas()
{
    return $this->hasMany(Resena::class, 'profesional_id');
}



    use HasFactory;
}
