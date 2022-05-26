<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->string('folio', 32);
            $table->boolean('estatus');
            $table->string('archivo');
            $table->integer('importe')->nullable()->default(0);
            $table->foreignId('tipo_contrato_id')->constrained('tipo_contrato');
            $table->foreignId('razon_social_id')->constrained('razon_social');
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
        Schema::dropIfExists('contratos');
    }
}