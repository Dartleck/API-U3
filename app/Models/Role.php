<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description'];

    const ENCARGADO = 'Encargado';
    const CLIENTE = 'Cliente';
    const CONTADOR = 'Contador';
    const SUPERVISOR = 'Supervisor';
    const VENDEDOR = 'Vendedor';
}
