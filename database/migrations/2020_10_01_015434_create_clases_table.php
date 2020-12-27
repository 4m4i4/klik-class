<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            $table->SET('dia',['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes']);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');             
            $table->unsignedBigInteger('sesion_id');
            $table->foreign('sesion_id')
                  ->references('id')
                  ->on('sesions');
            $table->unsignedBigInteger('materia_id');
            $table->foreign('materia_id')
                  ->references('id')
                  ->on('materias'); 
            $table->unsignedBigInteger('aula_id');                  
            $table->foreign('aula_id')
                  ->references('id')
                  ->on('aulas');             



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
        Schema::dropIfExists('clases');
    }
}
