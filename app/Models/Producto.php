<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock', 'state', 'category_id','user_id'];

    public function category()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }
}
