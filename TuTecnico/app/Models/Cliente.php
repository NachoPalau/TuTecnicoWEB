<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    use HasFactory;

    protected $fillable = ['user_id'];
   public function user() {
    return $this->belongsTo(User::class, 'user_id');
}


    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
// App\Models\Cliente.php



}
