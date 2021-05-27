<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->string('materia_name', 25);
            $table->string('grupo', 20)->nullable();
            $table->boolean('check')->default(false);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->unsignedBigInteger('aula_id');
            $table->foreign('aula_id')
                  ->references('id')
                  ->on('aulas');
            $table->unsignedBigInteger('boton_izq')->default(1);
            $table->unsignedBigInteger('boton_dcha')->default(2);
            $table->unsignedBigInteger('boton_abajo')->default(3);
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
        Schema::dropIfExists('materias');
    }
}
