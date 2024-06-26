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
        Schema::create('sis_modulos', function (Blueprint $table) {
            // id, sis_seccion_id, value, order, id_w, index, icon, app(ruta), status_alta
            $table->id();            
            $table->string('sis_seccion_id');
            $table->string('value');
            $table->string('icon');
            $table->string('ruta');
            $table->integer('order')->default(1);
            $table->integer('status_alta')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sis_modulos');
    }
};