<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->integer('stock');
            $table->enum('state', ['aceptado', 'pendiente', 'rechazado']);
            $table->unsignedBigInteger('category_id');
            $table->text('razon_rechazo')->nullable();
            $table->unsignedBigInteger('user_id'); // Nuevo campo para el usuario que agrega el producto
            $table->timestamps();
        
            $table->foreign('category_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Clave foránea al usuario
        });
        
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
