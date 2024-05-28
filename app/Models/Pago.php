<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'monto_total', 'entregado'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
