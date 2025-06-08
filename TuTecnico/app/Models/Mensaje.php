<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $fillable = ['de_user_id', 'para_user_id', 'mensaje'];

    public function deUser()
    {
        return $this->belongsTo(User::class, 'de_user_id');
    }

    public function paraUser()
    {
        return $this->belongsTo(User::class, 'para_user_id');
    }
}
