<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
    $table->foreignId('profesional_id')->constrained('profesionales')->onDelete('cascade');
    $table->dateTime('fecha');
    $table->string('estado', 255)->default('pendiente');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
