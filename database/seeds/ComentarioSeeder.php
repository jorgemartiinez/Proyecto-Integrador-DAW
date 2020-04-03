<?php

use Illuminate\Database\Seeder;
use App\Comentario;

class ComentarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 15; $i++) {
            $object = new Comentario();

            $object->user_id = rand(1, 10);
            $object->post_id = rand(1, 4);
            $object->mensaje = ("Comentario ".$i);

            $object->save();
        }
    }
}
