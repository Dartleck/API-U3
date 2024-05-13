<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

class Categoria extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    // Especifica el nombre del campo de la clave foránea
    public function productos()
    {
        return $this->hasMany(Producto::class, 'category_id');
    }
}


