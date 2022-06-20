<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes_servicios', function (Blueprint $table) {
            $table->id();
            $table->integer('ubicacion')->nullable();
            $table->date('fecha_inicio');
            $table->time('horario_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->time('horario_fin')->nullable();
            $table->boolean('estatus');
            $table->text('url')->nullable();
            $table->text('comentarios')->nullable();
            $table->string('archivo')->nullable();
            $table->foreignId('campania_id')->constrained('campanias');
            $table->foreignId('actividad_id')->constrained('actividades');
            $table->foreignId('tipo_orden_servicios_id')->constrained('tipo_orden_servicios');
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
        Schema::dropIfExists('ordenes_servicios');
    }
}