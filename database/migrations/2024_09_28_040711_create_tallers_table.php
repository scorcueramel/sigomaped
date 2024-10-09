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
        Schema::create('tallers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programa_id')->constrained('programas')->onDelete('cascade');
            $table->foreignId('tipo_taller_id')->constrained('tipo_tallers')->onDelete('cascade');
            $table->string('nombre',100);
            $table->string('usuario_actualiza',50)->nullable();
            $table->boolean('estado')->default(true);
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
        Schema::dropIfExists('tallers');
    }
};
