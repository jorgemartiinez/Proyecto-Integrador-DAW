<?php

use Illuminate\Database\Seeder;
use App\Tarea;

class TareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 25; $i++) {
            $object = new Tarea();
            $object->nombre = "Tarea".$i;
            $object->descripcion = "Descripción";
            $object->vencimiento = "2019-02-22";

            $object->comision_id = rand(1, 12);
            $object->save();
        }
    }
}
