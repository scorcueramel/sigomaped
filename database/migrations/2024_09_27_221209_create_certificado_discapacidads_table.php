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
        Schema::create('certificado_discapacidads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('datos_alumno_id')->constrained('datos_alumnos')->onDelete('cascade');
            $table->string('emision_cert_discapacidad');
            $table->string('vigencia_cert_discapacidad');
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
        Schema::dropIfExists('certificado_discapacidads');
    }
};
