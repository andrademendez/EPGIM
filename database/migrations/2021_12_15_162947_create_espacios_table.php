<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspaciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('espacios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('referencia');
            $table->string('medidas');
            $table->integer('cantidad');
            $table->double('precio');
            $table->boolean('estatus');
            $table->foreignId('id_unidad_negocio')->constrained('unidades_negocios');
            $table->foreignId('id_tipo_espacio')->constrained('tipos_espacios');
            $table->foreignId('id_ubicacion')->constrained('ubicaciones_espacios');
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
        Schema::dropIfExists('espacios');
    }
}