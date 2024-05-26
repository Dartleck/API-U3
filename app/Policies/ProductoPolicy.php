<?php

namespace App\Policies;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class ProductoPolicy
{public function edit(User $user):bool
{
    
    return $user->rol === 'Supervisor'|| $user->rol === 'Encargado';
}

public function delete(User $user):bool
{
    // Solo permite eliminar si el usuario es un supervisor
    return $user->rol === 'Supervisor';
}

public function viewKardex(User $user)
{
    // Solo permite ver kardex si el usuario es un supervisor
    return $user->rol === 'Supervisor';
}
public function editvend(User $user)
{
    // Solo permite ver kardex si el usuario es un supervisor
    return $user->rol === 'Vendedor';
}
public function deletevend(User $user)
{
    // Solo permite ver kardex si el usuario es un supervisor
    return $user->rol === 'Vendedor';
}

public function pregunta(User $user){
    return $user->rol === 'Vendedor';

}

public function respuesta(User $user){
    return $user->rol === 'Cliente';

}
public function comprar(User $user){
    return $user->rol === 'Cliente';

}

public function viewState(User $user)
{
    // Solo permite ver el estado del producto si el usuario es un supervisor o un encargado
    return $user->rol === 'Supervisor' || $user->rol === 'Encargado'|| $user->rol === 'Vendedor' ;
}



}

