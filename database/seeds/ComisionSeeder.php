<?php

use Illuminate\Database\Seeder;
use App\Comision;

class ComisionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$array = [
			"Formación",
			"Liturgia",
			"Intendencia",
			"Vestuario",
			"Limpieza",
			"Prim. Auxilios",
			"Megafonia",
			"Albergues",
			"Cocina",
			"Secretaria",
			"Informática/Audiovisuales",
			"Merchandising"
		];
		foreach ($array as $key) {
			$object = new Comision();
	   		$object->nombre = $key;
			$object->save();
		}
	}
}
