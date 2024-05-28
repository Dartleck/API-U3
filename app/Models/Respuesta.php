<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    protected $fillable = ['contenido', 'user_id', 'pregunta_id'];

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}
