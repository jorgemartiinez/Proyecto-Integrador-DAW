<?php

use Illuminate\Database\Seeder;
use App\Evento;
use App\Nivel;

class EventoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime('2019-10-05');
        for ($i = 1; $i <= 40; $i++) {
			$object = new Evento();
			$object->fecha = $date;
			$object->nombre = "Dia de Cau";
			$object->descripcion = "Descripcion";
			$object->save();

            $object->niveles()->attach(Nivel::findOrFail(2));
            $object->save();

			date_add($date, date_interval_create_from_date_string('1 week'));
		}
	}
}