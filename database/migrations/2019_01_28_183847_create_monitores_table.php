<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonitoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitores', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->foreign('id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            //ESTO ES COMO LOS ROLES (MONITOR; PREMONITOR, ETC...)
            $table->string('rango_monitor', 50);
            $table->string('domicilio', 100);
            $table->string('email');
            $table->integer('telefono');

            $table->integer('id_cargo')->unsigned()->nullable();
            $table->foreign('id_cargo')->references('id')->on('cargos')->onUpdate('CASCADE')->onDelete('SET NULL');

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
        Schema::dropIfExists('monitores');
    }
}
