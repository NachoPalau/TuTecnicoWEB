<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Cliente;
use App\Models\Profesional;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function cliente()
{
    return $this->hasOne(Cliente::class);
}
public function profesional(){
    return $this->hasOne(Profesional::class);
}
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'telefono', 'tipo', 'localidad'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public const localidades = [
        'Madrid',
        'Barcelona',
        'Valencia',
        'Sevilla',
        'Zaragoza',
        'Málaga',
        'Murcia',
        'Palma',
        'Bilbao',
        'Alicante',
        'Córdoba',
        'Valladolid',
        'Vigo',
        'Gijón',
        'Hospitalet de Llobregat',
        'La Coruña',
        'Granada',
        'Vitoria',
        'Elche',
        'Oviedo'
    ];

}
