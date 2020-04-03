<?php

use Illuminate\Database\Seeder;
use App\Monitor;
use App\User;
use App\Miembro;
use App\Padre;
use App\Role;
use App\Comision;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_hijo = Role::where('nombre', 'Hijo')->first();
        $role_padre = Role::where('nombre', 'Padre')->first();
        $role_monitor = Role::where('nombre', 'Monitor')->first();
        $role_admin = Role::where('nombre', 'Admin')->first();

        $array = [
            [
                'username' => 'Admin', 'nombre' => 'Administrador', 'apellidos' => 'apellido',
                'dni' => '12345678A', 'fec_nac' => '1999-08-17', 'curso_escolar' => 'Secundaria',
                'domicilio' => 'prueba', 'email' => 'admin@example.com', 'telefono' => '123456789',
                'role' => $role_admin, 'miembro' => true, 'hijo' => false
            ],
            [
                'username' => 'Monitor', 'nombre' => 'Monitor', 'apellidos' => 'apellido',
                'dni' => '12345678A', 'fec_nac' => '1999-08-17', 'curso_escolar' => 'Secundaria',
                'domicilio' => 'prueba', 'email' => 'monitor@example.com', 'telefono' => '123456789',
                'role' => $role_monitor, 'miembro' => true, 'hijo' => true
            ],
            [
                'username' => 'Padre', 'nombre' => 'Padre', 'apellidos' => 'apellido',
                'dni' => '87654321A', 'fec_nac' => '1999-08-17', 'curso_escolar' => 'Secundaria',
                'domicilio' => 'prueba', 'email' => 'padre@example.com', 'telefono' => '123456789',
                'role' => $role_padre, 'miembro' => false, 'hijo' => false
            ],
            [
                'username' => 'Hijo', 'nombre' => 'Hijo', 'apellidos' => 'apellido',
                'dni' => '12345678A', 'fec_nac' => '1999-08-17', 'curso_escolar' => 'Secundaria',
                'domicilio' => 'prueba', 'email' => 'hijo@example.com', 'telefono' => '123456789',
                'role' => $role_hijo, 'miembro' => true, 'hijo' => true
            ], [
                'username' => 'n1', 'nombre' => 'n1', 'apellidos' => 'n1',
                'dni' => '12345678A', 'fec_nac' => '1999-08-17', 'curso_escolar' => 'Secundaria',
                'domicilio' => 'prueba', 'email' => 'hijo@example.com', 'telefono' => '123456789',
                'role' => $role_hijo, 'miembro' => true, 'hijo' => true
            ], [
                'username' => 'n1-1', 'nombre' => 'n1-1', 'apellidos' => 'n1-1',
                'dni' => '12345678A', 'fec_nac' => '1999-08-17', 'curso_escolar' => 'Secundaria',
                'domicilio' => 'prueba', 'email' => 'hijo@example.com', 'telefono' => '123456789',
                'role' => $role_hijo, 'miembro' => true, 'hijo' => true
            ], [
                'username' => 'n2', 'nombre' => 'n2', 'apellidos' => 'n2',
                'dni' => '12345678A', 'fec_nac' => '1999-08-17', 'curso_escolar' => 'Secundaria',
                'domicilio' => 'prueba', 'email' => 'hijo@example.com', 'telefono' => '123456789',
                'role' => $role_hijo, 'miembro' => true, 'hijo' => true
            ], [
                'username' => 'n2-2', 'nombre' => 'n2-2', 'apellidos' => 'n2-2',
                'dni' => '12345678A', 'fec_nac' => '1999-08-17', 'curso_escolar' => 'Secundaria',
                'domicilio' => 'prueba', 'email' => 'hijo@example.com', 'telefono' => '123456789',
                'role' => $role_hijo, 'miembro' => true, 'hijo' => true
            ], [
                'username' => 'm1', 'nombre' => 'm1', 'apellidos' => 'm1',
                'dni' => '12345678A', 'fec_nac' => '1999-08-17', 'curso_escolar' => 'Secundaria',
                'domicilio' => 'prueba', 'email' => 'monitor1@example.com', 'telefono' => '123456789',
                'role' => $role_monitor, 'miembro' => true, 'hijo' => true
            ], [
                'username' => 'm2', 'nombre' => 'm2', 'apellidos' => 'm2',
                'dni' => '12345678A', 'fec_nac' => '1999-08-17', 'curso_escolar' => 'Secundaria',
                'domicilio' => 'prueba', 'email' => 'monitor2@example.com', 'telefono' => '123456789',
                'role' => $role_monitor, 'miembro' => true, 'hijo' => true
            ],
        ];
        $id = 1;
        foreach ($array as $key) {
            $object = new User();

            $object->username = $key['username'];
            $object->nombre = $key['nombre'];
            $object->apellidos = $key['apellidos'];
            $object->estado_registro = ($id < 5)? 1 : rand(0, 1);
            $object->dni = $key['dni'];
            $object->fec_nac = $key['fec_nac'];
            $object->password = bcrypt('secret');
            $object->save();

            $object->roles()->attach($key['role']);
            $object->save();

            if ($key['miembro']) {
                $object = new Miembro();

                $object->id = $id;
                if ($key['hijo']) {
                    $object->id_padre1 = 1;
                }
                $object->curso_escolar = $key['curso_escolar'];
                $object->id_nivel = rand(3, 9);

                $object->save();
                if ($id === 2 || $id === 9 || $id === 10) {
                    $object = new Monitor();
                    $object->id = $id;

                    $object->rango_monitor = "rangoX";
                    $object->domicilio = $key['domicilio'];
                    $object->email = $key['email'];
                    $object->telefono = $key['telefono'];
                    $object->id_cargo = rand(1, 12);

                    $object->save();

                    $object->id = $id;
                    $object->comisiones()->attach(Comision::findOrFail(rand(1, 12)));
                    $object->save();
                }
            } else {
                $object = new Padre();
                $object->id = $id;
                $object->domicilio = $key['domicilio'];
                $object->email = $key['email'];
                $object->telefono = $key['telefono'];

                $object->save();
            }
            $id = $id + 1;
        }
    }

}