<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => Role::ENCARGADO, 'description' => 'Rol de Encargado']);
        Role::create(['name' => Role::CLIENTE, 'description' => 'Rol de Cliente']);
        Role::create(['name' => Role::CONTADOR, 'description' => 'Rol de Contador']);
        Role::create(['name' => Role::SUPERVISOR, 'description' => 'Rol de Supervisor']);
        Role::create(['name' => Role::VENDEDOR, 'description' => 'Rol de Vendedor']);
    }
}
