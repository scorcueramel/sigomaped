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
        Schema::create('datos_alumnos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->onDelete('cascade');
            $table->foreignId('genero_id')->constrained('generos')->onDelete('cascade');
            $table->foreignId('anio_ingreso_id')->constrained('anio_ingresos')->onDelete('cascade');
            $table->foreignId('tipo_seguro_id')->constrained('tipo_seguros')->onDelete('cascade');
            $table->foreignId('cond_socio_economica_id')->constrained('condicion_socio_economicas')->onDelete('cascade');
            $table->foreignId('manif_volunta_id')->constrained('manifestacion_voluntads')->onDelete('cascade');
            $table->foreignId('acred_resid_id')->constrained('acreditacion_residencias')->onDelete('cascade');
            $table->foreignId('tipo_discapacidad_id')->constrained('tipo_discapacidads')->onDelete('cascade');
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
        Schema::dropIfExists('datos_alumnos');
    }
};
