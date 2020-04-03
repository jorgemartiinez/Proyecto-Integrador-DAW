<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiembrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('miembros', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->foreign('id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');

            $table->string('curso_escolar', 20)->nullable();
            
            $table->integer('id_padre1')->unsigned()->nullable();
            $table->foreign('id_padre1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');

            $table->integer('id_padre2')->unsigned()->nullable();
            $table->foreign('id_padre2')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');

            $table->integer('id_datos_med')->unsigned()->nullable();
            $table->foreign('id_datos_med')->references('id')->on('d_medicos')->onUpdate('CASCADE')->onDelete('SET NULL');

            $table->integer('id_nivel')->unsigned()->nullable();
            $table->foreign('id_nivel')->references('id')->on('niveles')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('miembros');
    }
}
