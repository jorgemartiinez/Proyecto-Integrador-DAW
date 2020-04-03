<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_evento', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->nullable();

            $table->integer('evento_id')->unsigned()->nullable();

            $table->boolean('asistencia')->default(false);

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
        Schema::dropIfExists('usuario_evento');
    }
}