<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call(CategoriaSeeder::class);
		$this->call(CargoSeeder::class);
		$this->call(ComisionSeeder::class);
		$this->call(NivelSeeder::class);
        $this->call(EventoSeeder::class);

		$this->call(RoleSeeder::class);
		$this->call(TipoSeeder::class);
		$this->call(UserSeeder::class);

        $this->call(TareaSeeder::class);
		$this->call(PostSeeder::class);
        $this->call(ComentarioSeeder::class);
	}
}
