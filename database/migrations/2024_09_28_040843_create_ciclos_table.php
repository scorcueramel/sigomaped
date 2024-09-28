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
        Schema::create('ciclos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('taller_id')->constrained('tallers')->onDelete('cascade');
            $table->string('anio',4);
            $table->string('periodo',1);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('cupos_maximos');
            $table->integer('cupos_actuales');
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
        Schema::dropIfExists('ciclos');
    }
};
