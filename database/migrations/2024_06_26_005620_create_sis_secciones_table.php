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
        Schema::create('sis_secciones', function (Blueprint $table) {
            // ['sistemas' => ['web', 'app']]
            $table->id();            
            $table->string('value');
            $table->string('icon');
            $table->string('sistema')->default('app');
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
        Schema::dropIfExists('sis_secciones');
    }
};