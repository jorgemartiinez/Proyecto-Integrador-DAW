<?php

use Illuminate\Database\Seeder;
use App\Cargo;

class CargoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$array = [
			"Presidente",
			"Vicepresidente",
			"Secretario",
			"Tesorero",
			"Vocal Inici",
			"Vocal Unió 1",
			"Vocal Unió 2",
			"Vocal Compromis",
			"Vocal Desició",
			"Vocal Acció 1",
			"Vocal Acció 2",
			"Conciliario"
		];
		foreach ($array as $key) {
			$object = new Cargo();
	   		$object->nombre = $key;
			$object->save();
		}
	}
}
