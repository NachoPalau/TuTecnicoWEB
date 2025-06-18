<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{

    protected $table = 'profesionales';

   // Profesional.php
public function user()
{
    return $this->belongsTo(User::class);
}
public function reseñas()
{
    return $this->hasMany(Reserva::class);
}



    protected $fillable = ['user_id', 'especialidad'];

    use HasFactory;

    public static function localidades(){ 

        return self::join('users', 'profesionales.user_id', '=', 'users.id')
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
