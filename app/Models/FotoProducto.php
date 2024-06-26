<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoProducto extends Model
{
    use HasFactory;

    protected $fillable = ['producto_id', 'ruta'];

    public function producto() {
        return $this->belongsTo(Producto::class);
    }
}
