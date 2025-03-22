<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('profesionales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('telefono');
            $table->string('localidad');
            $table->text('especialidad');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('profesionales');
    }
};
