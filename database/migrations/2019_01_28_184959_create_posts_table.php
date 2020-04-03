<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('titulo', 50);
            $table->date('fecha');

            $table->integer('id_user')->unsigned()->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->string('thumbnail', 100)->default('images/cau.jpeg');
            $table->string('descripcion', 250);

            $table->string('contenido', 4000);

            $table->boolean('comentarios')->default(false);

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
        Schema::dropIfExists('posts');
    }
}