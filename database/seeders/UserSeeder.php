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
        //Supervisores
        $supervisor = User::create([
            'name' => 'Yahir Cigarroa',
            'email' => 'Supervisor1@gmail.com',
            'password' => bcrypt('Supervisor1@gmail.com'),
            'rol' => Role::SUPERVISOR, // Cambio aquí
        ]);
        $supervisor = User::create([
            'name' => 'Supervisor2',
            'email' => 'Supervisor2@gmail.com',
            'password' => bcrypt('Supervisor2@gmail.com'),
            'rol' => Role::SUPERVISOR, // Cambio aquí
        ]);
        //Encargados
        $encargado = User::create([
            'name' => 'Brian Hernandez',
            'email' => 'Encargado1@gmail.com',
            'password' => bcrypt('Encargado1@gmail.com'),
            'rol' => Role::ENCARGADO, // Cambio aquí
        ]);
        $encargado = User::create([
            'name' => 'Encargado2',
            'email' => 'Encargado2@gmail.com',
            'password' => bcrypt('Encargado2@gmail.com'),
            'rol' => Role::ENCARGADO, // Cambio aquí
        ]);
        $encargado = User::create([
            'name' => 'Encargado3',
            'email' => 'Encargado3@gmail.com',
            'password' => bcrypt('Encargado3@gmail.com'),
            'rol' => Role::ENCARGADO, // Cambio aquí
        ]);
        //Contador
        $contador = User::create([
            'name' => 'Oscar Gustavo',
            'email' => 'Contador@gmail.com',
            'password' => bcrypt('Contador@gmail.com'),
            'rol' => Role::CONTADOR, // Cambio aquí
        ]);
        //Vendedores
        $vendedor = User::create([
            'name' => 'Vendedor1',
            'email' => 'Vendedor1@gmail.com',
            'password' => bcrypt('Vendedor1@gmail.com'),
            'rol' => Role::VENDEDOR, // Cambio aquí
        ]);
        $vendedor = User::create([
            'name' => 'Vendedor2',
            'email' => 'Vendedor2@gmail.com',
            'password' => bcrypt('Vendedor2@gmail.com'),
            'rol' => Role::VENDEDOR, // Cambio aquí
        ]);
        $vendedor = User::create([
            'name' => 'Vendedor3',
            'email' => 'Vendedor3@gmail.com',
            'password' => bcrypt('Vendedor3@gmail.com'),
            'rol' => Role::VENDEDOR, // Cambio aquí
        ]);
        $vendedor = User::create([
            'name' => 'Vendedor4',
            'email' => 'Vendedor4@gmail.com',
            'password' => bcrypt('Vendedor4@gmail.com'),
            'rol' => Role::VENDEDOR, // Cambio aquí
        ]);
        $vendedor = User::create([
            'name' => 'Vendedor5',
            'email' => 'Vendedor5@gmail.com',
            'password' => bcrypt('Vendedor5@gmail.com'),
            'rol' => Role::VENDEDOR, // Cambio aquí
        ]);
        //Clientes/compradores
        $cliente = User::create([
            'name' => 'Comprador1',
            'email' => 'Comprador1@gmail.com',
            'password' => bcrypt('Comprador1@gmail.com'),
            'rol' => Role::CLIENTE, // Cambio aquí
        ]);
        $cliente = User::create([
            'name' => 'Comprador2',
            'email' => 'Comprador2@gmail.com',
            'password' => bcrypt('Comprador2@gmail.com'),
            'rol' => Role::CLIENTE, // Cambio aquí
        ]);
        $cliente = User::create([
            'name' => 'Comprador3',
            'email' => 'Comprador3@gmail.com',
            'password' => bcrypt('Comprador3@gmail.com'),
            'rol' => Role::CLIENTE, // Cambio aquí
        ]);
        $cliente = User::create([
            'name' => 'Comprador4',
            'email' => 'Comprador4@gmail.com',
            'password' => bcrypt('Comprador4@gmail.com'),
            'rol' => Role::CLIENTE, // Cambio aquí
        ]);
        $cliente = User::create([
            'name' => 'Comprador5',
            'email' => 'Comprador5@gmail.com',
            'password' => bcrypt('Comprador5@gmail.com'),
            'rol' => Role::CLIENTE, // Cambio aquí
        ]);

        

      
        
        // También puedes usar el factory de usuarios para crear múltiples usuarios
        // factory(User::class, 10)->create();
    }
}
