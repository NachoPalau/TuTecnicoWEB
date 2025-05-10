<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}

    protected $fillable = ['user_id', 'especialidad'];

    use HasFactory;

    public static function localidades(){ 

        return self::join('users', 'profesionals.user_id', '=', 'users.id')
        ->distinct()
        ->pluck('users.localidad');
    }

    public static function especialidadYLocalidad($especialidad, $localidad)
    {
        return self::where('especialidad', $especialidad)
                   ->where('localidad', $localidad)
                   ->get();
    }
    
    
    public const especialidades= [
        'Carpinteria', 
        'Electricidad', 
        'Pintura', 
        'Fontaneria', 
        'Jardineria',
        'Obra',
        'Mudanza',
        'Cerrajeria'
    ];

    
    
}
