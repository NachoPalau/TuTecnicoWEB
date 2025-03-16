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
            $table->boolean('disponible')->default(true); 
            
            // Para que un profesional no puede ofrecer el mismo horario dos veces
            $table->unique(['profesional_id', 'fecha', 'hora']);
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
