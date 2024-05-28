<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    protected $table = 'transacciones'; // Nombre de la tabla en la base de datos
    protected $fillable = ['producto_id', 'user_id', 'interesado', 'comprado', 'cantidad', 'voucher_path', 'validado'];

    // Define las relaciones con otros modelos, si es necesario
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
