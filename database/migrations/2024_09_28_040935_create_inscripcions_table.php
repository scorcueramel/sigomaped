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
        Schema::create('inscripcions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->onDelete('cascade');
            $table->foreignId('ciclo_id')->constrained('ciclos')->onDelete('cascade');
            $table->boolean('es_derivado')->default(false);
            $table->dateTime('fecha_derivacion')->nullable();
            $table->dateTime('fecha_derivada')->nullable();
            $table->string('estado_inscripcion',1)->default('I');
            $table->boolean('es_espera')->default(false);
            $table->dateTime('fecha_inscripcion');
            $table->string('usuario_actualiza',50)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('inscripcions');
    }
};
