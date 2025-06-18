<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    use HasFactory;

    protected $table = 'valoraciones';

    protected $fillable = ['cliente_id', 'profesional_id', 'valoracion', 'comentario'];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function profesional()
    {
        return $this->belongsTo(Profesional::class);
    }
}