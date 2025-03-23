<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profesional_id')->constrained('profesionals')->onDelete('cascade');
            $table->date('fecha'); 
            $table->time('hora_inicio'); 
            $table->time('hora_fin');
            $table->boolean('disponible')->default(true);
            $table->unique(['profesional_id', 'fecha', 'hora_inicio']); // Evita horarios duplicados
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horarios');
    }
};
