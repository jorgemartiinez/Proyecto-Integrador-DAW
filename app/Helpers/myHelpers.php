<?php

use App\User;

function hazArray($elementos, $campo1, $campo2)
{
    $array = [];

    foreach ($elementos as $elemento) {
        $array[$elemento[$campo1]] = $elemento[$campo2];
    }
    return $array;
}

function Fecha()
{
    return date("Y/m/d");
}

function generarUsername($nombre, $ape1, $ape2)
{
    $n = substr($nombre, 0, 2);
    $a1 = substr($ape1, 0, 2);
    $a2 = substr($ape2, 0, 2);
    $username = $n . $a1 . $a2;
    $username = strtoupper($username);
    $buscarUsuarios = User::where('username', 'like', $username . '%')->count();
    $buscarUsuarios++;
    $username = $username . $buscarUsuarios;

    return $username;

}

function calcularNivelPorDefecto($fec_nac)
{
    $nacimiento = new DateTime($fec_nac);
    $nacimiento = $nacimiento->format('Y');
    $hoy = new DateTime();
    $hoy = $hoy->format('Y');
    $years = $hoy - $nacimiento;
    // $years = $years->y;
    switch ($years) {
        case 16:
            return 9;
        case 15:
            return 8;
        case 14:
            return 7;
        case 13:
            return 6;
        case 12:
            return 5;
        case 11:
            return 4;
        case 10:
            return 3;
    }
}

function object_sorter($clave, $orden = null)
{
    return function ($a, $b) use ($clave, $orden) {
        $result = ($orden == "DESC") ? strnatcmp($b->$clave, $a->$clave) : strnatcmp($a->$clave, $b->$clave);
        return $result;
    };
}

function enlaceActivo($pagina)
{
    return ($_SERVER['REQUEST_URI'] === $pagina)? 'active' : '';
}


function random_string()
{
    $key = '';
    $keys = array_merge( range('a','z'), range(0,9) );

    for($i=0; $i<10; $i++)
    {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}
