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
            $table->date('fecha_inscripcion');
            $table->string('ds_exp_inscripcion',25);
            $table->string('distrito',30);
            $table->string('sector',5);
            $table->string('subsector',5);
            $table->string('domicilio',150);
            $table->date('fecha_nacimiento');
            $table->string('ro_carnet_conadis',20);
            $table->boolean('solicitud_inscripcion')->default(false);
            $table->string('cons_empadronamiento_sisfoh',10);
            $table->boolean('copia_dni')->default(false);
            $table->boolean('informe_medico')->default(false);
            $table->boolean('recibo_serv')->default(false);
            $table->boolean('copia_carnet_conadis')->default(false);
            $table->boolean('documentacion_digital')->default(false);
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
        Schema::dropIfExists('datos_alumnos');
    }
};
