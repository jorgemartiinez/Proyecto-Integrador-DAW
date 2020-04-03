<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ['nombre' => 'Banner', 'descripcion' => 'descripcion'],
        	['nombre' => 'Reunión', 'descripcion' => 'descripcion'],
			['nombre' => 'Acampada', 'descripcion' => 'descripcion'],
			['nombre' => 'Campamento', 'descripcion' => 'descripcion'],
			['nombre' => 'Noticia', 'descripcion' => 'descripcion']
		];
		foreach ($array as $key) {
			$object = new Categoria();
			$object->nombre = $key['nombre'];
			$object->descripcion = $key['descripcion'];
            $object->save();
		}	
    }
}
