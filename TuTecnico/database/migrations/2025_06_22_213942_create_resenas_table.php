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
    Schema::create('resenas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('cliente_id');
        $table->unsignedBigInteger('profesional_id');
        $table->tinyInteger('valoracion'); // del 1 al 5
        $table->text('comentario')->nullable();
        $table->timestamps();

        $table->foreign('cliente_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('profesional_id')->references('id')->on('profesionales')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resenas');
    }
};
