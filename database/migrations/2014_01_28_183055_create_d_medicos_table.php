<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_medicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seguro_medico', 70);
            $table->integer('num_seguro');
            $table->string('centro_salud', 100);
            $table->string('aclaracion_vacuna', 200)->nullable();

            $table->boolean('calendario_V_actu')->default(false);

            $table->boolean('vacuna_tetanos')->default(false);
            $table->date('fecha_tetanos')->nullable();

            $table->string('alergia', 100)->nullable();
            $table->string('trat_alergia', 100)->nullable();

            $table->string('neumo', 100)->nullable();
            $table->string('trat_neumo', 100)->nullable();

            $table->string('cardio', 100)->nullable();
            $table->string('trat_cardio', 100)->nullable();

            $table->string('endocri_diges', 100)->nullable();
            $table->string('trat_endocri_diges', 100)->nullable();

            $table->string('neuro', 100)->nullable();
            $table->string('trat_neuro', 100)->nullable();

            $table->string('trauma', 100)->nullable();
            $table->string('trat_trauma', 100)->nullable();

            $table->string('otros', 100)->nullable();
            $table->string('trat_otros', 100)->nullable();

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
        Schema::dropIfExists('d_medicos');
    }
}
