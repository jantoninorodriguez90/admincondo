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
        Schema::create('sis_modulo_usuarios', function (Blueprint $table) {
            //  id, usuario_id, sis_modulo_id, status_alta
            $table->id();
            $table->string('usuario_id');
            $table->string('sis_modulo_id');
            $table->integer('status_alta')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sis_modulo_usuarios');
    }
};