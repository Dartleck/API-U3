<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\User;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener las categorías disponibles
        $categorias = Categoria::all();

        // Obtener todos los usuarios con rol de vendedor
        $vendedores = User::where('rol', 'Vendedor')->get();

        // Crear 30 productos con estado 'aceptado'
        for ($i = 0; $i < 30; $i++) {
            $categoria = $categorias->random();
            $vendedor = $vendedores->random();
            Producto::create([
                'name' => 'Producto ' . ($i + 1),
                'description' => 'Descripción del producto ' . ($i + 1),
                'price' => rand(10, 1000),
                'stock' => rand(1, 100),
                'state' => 'aceptado',
                'category_id' => $categoria->id,
                'user_id' => $vendedor->id,
            ]);
        }

        // Crear 10 productos con estado 'pendiente'
        for ($i = 31; $i < 50; $i++) {
            $categoria = $categorias->random();
            $vendedor = $vendedores->random();
            Producto::create([
                'name' => 'Producto ' . ($i + 1),
                'description' => 'Descripción del producto ' . ($i + 1),
                'price' => rand(10, 1000),
                'stock' => rand(1, 100),
                'state' => 'pendiente',
                'category_id' => $categoria->id,
                'user_id' => $vendedor->id,
            ]);
        }
    }
}
