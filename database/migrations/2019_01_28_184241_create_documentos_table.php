<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_usuario')->unsigned()->nullable();
            $table->foreign('id_usuario')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');

            $table->string('ruta', 100);

            $table->integer('id_tipo')->unsigned()->nullable();
            $table->foreign('id_tipo')->references('id')->on('tipos')->onUpdate('CASCADE')->onDelete('SET NULL');

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
        Schema::dropIfExists('documentos');
    }
}
