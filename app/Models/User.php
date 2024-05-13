<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use Carbon\Carbon;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

   // En el modelo User.php

public function hasRole($role)
{
    return $this->role === $role;
}

public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }

    public function fechaAlta()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

    public function totalTransacciones()
    {
        return $this->transacciones()->count();
    }

    public function totalProductos()
    {
        return $this->productos()->count();
    }
   public function productosComprados()
{
    return $this->hasManyThrough(Producto::class, Transaccion::class, 'user_id', 'id', 'id', 'producto_id');
}

    
}
