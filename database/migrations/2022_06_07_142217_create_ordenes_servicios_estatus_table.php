<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesServiciosEstatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes_servicios_estatus', function (Blueprint $table) {
            $table->id();
            $table->integer('usuario');
            $table->string('estatus')->default('Pendiente');
            $table->text('comentarios')->nullable();
            $table->foreignId('orden_servicio_id')->constrained('ordenes_servicios');
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
        Schema::dropIfExists('ordenes_servicios_estatus');
    }
}