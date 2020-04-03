<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$array = [
			["nombre" => "Admin", "descripcion" => "Control Total"],
			["nombre" => "Hijo", "descripcion" => "Acceso restringido a Contenido de su nivel y general, solo lectura"],
			["nombre" => "Padre", "descripcion" => "Acceso restringido a Contenido y datos de su/s hijo/s"],
			["nombre" => "PadreJunta", "descripcion" => "Acceso al mismo contenido que el padre y además a la comisión a la que pertenece"],
			["nombre" => "Monitor", "descripcion" => "Acceso a todos los Posts y a la sección de monitores"],
			//Estos Roles estan pensados a futuro
			["nombre" => "PreMonitor1", "descripcion" => "Acceso a todos los Posts"],
			["nombre" => "PreMonitor2", "descripcion" => "Acceso a todos los Posts"],
			["nombre" => "PreMonitor3", "descripcion" => "Acceso a todos los Posts"],
		];
		foreach ($array as $key) {
			$object = new Role();
			$object->nombre = $key['nombre'];
			$object->descripcion = $key['descripcion'];
			$object->save();
		}
	}
}
