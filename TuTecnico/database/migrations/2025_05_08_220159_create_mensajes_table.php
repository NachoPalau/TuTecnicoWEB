<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            
            // Relaciones correctamente definidas
            $table->foreignId('de_user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
                  
            $table->foreignId('para_user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            
            $table->text('mensaje');
            $table->boolean('leido')->default(false); // Campo importante para el chat
            $table->timestamps();
            
            // Índices para optimizar consultas
            $table->index(['de_user_id', 'para_user_id']);
            $table->index(['para_user_id', 'leido']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('mensajes'); // Nombre consistente
    }
};