<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $fillable = ['contenido', 'user_id', 'producto_id'];

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }
}
