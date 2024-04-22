<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Crear usuarios de prueba
        $supervisor = User::create([
            'name' => 'Yahir Cigarroa',
            'email' => 'Supervisor@gmail.com',
            'password' => bcrypt('Supervisor@gmail.com'),
            'rol' => Role::SUPERVISOR, // Cambio aquí
        ]);

        $encargado = User::create([
            'name' => 'Brian Hernandez',
            'email' => 'Encargado@gmail.com',
            'password' => bcrypt('Encargado@gmail.com'),
            'rol' => Role::ENCARGADO, // Cambio aquí
        ]);

        $cliente = User::create([
            'name' => 'Oscar Gustavo',
            'email' => 'Cliente@gmail.com',
            'password' => bcrypt('Cliente@gmail.com'),
            'rol' => Role::CLIENTE, // Cambio aquí
        ]);

        $contador = User::create([
            'name' => 'juan',
            'email' => 'Contador@gmail.com',
            'password' => bcrypt('Contador@gmail.com'),
            'rol' => Role::CONTADOR, // Cambio aquí
        ]);

        $vendedor = User::create([
            'name' => 'juan2',
            'email' => 'Vendedor@gmail.com',
            'password' => bcrypt('Vendedor@gmail.com'),
            'rol' => Role::VENDEDOR, // Cambio aquí
        ]);
        
        // También puedes usar el factory de usuarios para crear múltiples usuarios
        // factory(User::class, 10)->create();
    }
}
