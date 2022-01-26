<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaniasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanias', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->enum('status', ['Solicitud', 'Challenge', 'Confirmado', 'Cerrado'])->default('Solicitud');
            $table->string('hold', 15);
            $table->string('display', 20)->nullable();
            $table->foreignId('id_user')->constrained('users');
            $table->foreignId('id_cliente')->constrained('clientes');
            $table->foreignId('id_medio')->constrained('medios');
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
        Schema::dropIfExists('campanias');
    }
}