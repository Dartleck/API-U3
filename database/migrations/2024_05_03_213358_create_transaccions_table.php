<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('publicado')->default(false); // Columna para registrar si el producto ha sido publicado
            $table->boolean('interesado')->default(false); // Columna para registrar si alguien se ha interesado en el producto
            $table->boolean('comprado')->default(false); // Columna para registrar si alguien ha comprado el producto
            $table->integer('cantidad')->default(1);
            $table->string('voucher_path')->nullable(); // Columna para almacenar la ruta del voucher
            $table->integer('rating')->nullable();
            $table->boolean('validado')->default(false);
            $table->boolean('pagado')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('transacciones');
    }
};
