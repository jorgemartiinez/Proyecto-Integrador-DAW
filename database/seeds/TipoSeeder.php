<?php

use Illuminate\Database\Seeder;
use App\Tipo;

class TipoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$array = [
			"Avatar",
			"ImgBanner",
			"Portada",
			"Imagen",
			"Video",
			"DNI",
			"Acta",
			"SIP",
			"Vacunas",
			"Informe Medico",
            "Autorizacion Imagenes",
            "Funcionamiento Interno"
		];
		foreach ($array as $key) {
			$object = new Tipo();
	   		$object->nombre = $key;
			$object->save();
		}
	}
}
