<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachStatusFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attach_status_files', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('process');
            $table->string('status')->default(true);
            $table->text('comment')->nullable();
            $table->foreignId('id_campania')->constrained('campanias');
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
        Schema::dropIfExists('attach_status_files');
    }
}