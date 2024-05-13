<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\User;

class PreguntaRespuestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener los primeros 5 productos
        $productos = Producto::take(5)->get();

        // Obtener un usuario para asignar como creador de preguntas y respuestas
        $user = User::first();

        // Iterar sobre los productos para agregar preguntas y respuestas
        foreach ($productos as $producto) {
            // Crear una pregunta para cada producto
            $pregunta = Pregunta::create([
                'contenido' => '¿Cuál es la calidad de este producto?',
                'producto_id' => $producto->id,
                'user_id' => $user->id,
            ]);

            // Crear tres respuestas para cada pregunta
            for ($i = 1; $i <= 3; $i++) {
                Respuesta::create([
                    'contenido' => 'Esta es la respuesta ' . $i . ' para la pregunta.',
                    'pregunta_id' => $pregunta->id,
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
