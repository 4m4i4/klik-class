<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesas', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('columna');
            $table->tinyInteger('fila');
            $table->boolean('is_ocupada')
                  ->default(false);
            $table->unsignedBigInteger('clase_id');
            $table->foreign('clase_id')
                  ->references('id')->on('clases');
            $table->unsignedBigInteger('aula_id');
            $table->foreign('aula_id')
                  ->references('id')->on('aulas');
            $table->unsignedBigInteger('estudiante_id');
            $table->foreign('estudiante_id')
                  ->references('id')->on('estudiantes');
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
        Schema::dropIfExists('mesas');
    }
}
