<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    use HasFactory;

    public static function localidades(){ 

    return self::distinct()->pluck('localidad');
    }

    public static function especialidadYLocalidad($especialidad, $localidad)
    {
        return self::where('especialidad', $especialidad)
                   ->where('localidad', $localidad)
                   ->get();
    }
}
