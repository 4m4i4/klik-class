<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('botons', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('default');
            $table->unsignedTinyInteger('v_last');
            $table->string('bt_name',20);
            $table->string('descripcion',200)->nullable();
            $table->unsignedTinyInteger('pasos')->nullable();
            $table->string('items',255)->nullable();
            $table->unsignedBigInteger('botontipo_id');
            $table->foreign('botontipo_id')
                  ->references('id')
                  ->on('botontipos');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade'); 
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
        Schema::dropIfExists('botons');
    }
}
