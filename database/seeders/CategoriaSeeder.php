<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    Categoria::create(['name' => 'Electrónicos']);
    Categoria::create(['name' => 'Ropa']);
    Categoria::create(['name' => 'Hogar']);
    Categoria::create(['name' => 'Mascotas']);
    Categoria::create(['name' => 'Juegos']);
}

}
