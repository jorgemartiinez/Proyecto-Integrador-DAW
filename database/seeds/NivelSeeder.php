<?php

use Illuminate\Database\Seeder;
use App\Nivel;

class NivelSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$array = [
			["nombre" => "Publico", "sector" => "Publico"],
			["nombre" => "Centro", "sector" => "Centro"],
			["nombre" => "Inici", "sector" => "Pequeño"],
			["nombre" => "Unió 1", "sector" => "Pequeño"],
			["nombre" => "Unió 2", "sector" => "Pequeño"],
			["nombre" => "Compromis", "sector" => "Mediano"],
			["nombre" => "Desició", "sector" => "Mediano"],
			["nombre" => "Acció 1", "sector" => "Mayor"],
			["nombre" => "Acció 2", "sector" => "Mayor"],
		];
		foreach ($array as $key) {
			$object = new Nivel();
			$object->nombre = $key["nombre"];
			$object->sector = $key["sector"];
			$object->save();
		}
	}
}