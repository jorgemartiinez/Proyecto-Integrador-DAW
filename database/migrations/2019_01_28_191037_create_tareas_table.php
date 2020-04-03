<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nombre', 50);
            $table->string('descripcion', 200);
            $table->boolean('completada')->default(false);
            $table->date('vencimiento')->nullable();

            $table->integer('comision_id')->unsigned()->nullable();
            $table->foreign('comision_id')->references('id')->on('comisiones')->onUpdate('CASCADE')->onDelete('SET NULL');

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
        Schema::dropIfExists('tareas');
    }
}
