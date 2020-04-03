<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Evento;
use App\Usuario_evento;
use App\Miembro;
use Illuminate\Support\Facades\Auth;

class EventosController extends Controller {
    /* metodo que devuelve los todos los eventos */

    public function getEventos() {

        //Poner un were con el id del nivel porque asi solo los pertenecientes a ese nivel podran ver los eventos de ese nivel
        if (Auth::user()->hasRole('admin')) {
            $eventos = Evento::all();
        } else {
            //Primero buscamos los id que tienen el mismo nivel que el usuario y luego buscamos los eventos            
            $id_eventos = DB::table('nivel_evento')->where('id_nivel', Auth::user()->miembro->nivel->id)->pluck('id_evento');
            $eventos = Evento::whereIn('id', $id_eventos->toArray())->get();
        }

        foreach ($eventos as $evento) {

            $evento->niveles;
        }

        return $eventos;
    }

    /* metodo que revuelve un evento */

    public function getEvento($id) {

        $evento = Evento::findOrFail($id);
        return $evento;
    }

    /* metodo para modificar el usuario */

    public function putEvento(Request $request) {

        $evento = Evento::findOrFail($request->id);

        $evento->fecha = $request->fecha;
        $evento->nombre = $request->nombre;
        $evento->descripcion = $request->descripcion;
        $evento->created_at = $request->created_at;
        $evento->updated_at = $request->updated_at;
        $evento->save();

        $n = DB::table('nivel_evento')->where('id_evento', $request->id)->delete();

        foreach ($request->nivelesEvento as $nivel) {

            $evento->niveles()->attach($nivel);
            $evento->save();
        }

        return $evento;
    }

    /* Funcion que borra el evento que corresponda al id enviado */

    public function deleteEvento($id) {

        $e = Evento::findOrFail($id);
        $e->delete();
        $n = DB::table('nivel_evento')->where('id_evento', $id)->delete();
        $n = DB::table('usuario_evento')->where('evento_id', $id)->delete();
    }

    /* funcion que inserta un nuevo evento en la base de datos */

    public function postEvento(Request $request) {

        $evento = new Evento;
        $evento->fecha = $request->fecha;
        $evento->nombre = $request->nombre;
        $evento->descripcion = $request->descripcion;
        $evento->save();


        foreach ($request->nivelesEvento as $nivel) {

            $evento->niveles()->attach($nivel);
        }

        $miembros = Miembro::all()->whereIn('id_nivel', $request->nivelesEvento);

        foreach ($miembros as $miembro) {
            $miembro->apuntarAEvento($evento->id);
        }

        return $evento;
    }

    /* Funcion chunga para ver los usuarios de un nivel de un evento */

    public function getUsuarios($id) {

        $usuarios = [];

        //Primero cogo de la tabla de usuarios eventos los id de los usuarios que pertenecen al id del evento
        $id_usuarios = Usuario_evento::where('evento_id', '=', $id)->pluck('user_id');

        if (Auth::user()->hasRole('admin')) {

            $miembros = Miembro::all()->whereIn('id', $id_usuarios->toArray());
        } else {

            //Me voy a la tabla de miembros para saber que nivel tienen los id de los usuarios cogidos en la busqueda anterior
            $miembros = Miembro::all()->where('id_nivel', '=', Auth::user()->miembro->nivel->id)->whereIn('id', $id_usuarios->toArray());
        }

        //De esos miembros cogo el usuario
        foreach ($miembros as $miembro) {

            array_push($usuarios, $miembro->user);
        }

        foreach ($usuarios as $user) {

            $user->asistencia = $user->participa($id)->asistencia;
        }

        //Ordeno de forma alfabética los usuarios
        //usort($usuarios, object_sorter('nombre', 'ASC'));
        //Y los devuelvo
        return $usuarios;
    }

    public function putAsistenciaEvento(Request $request) {

        $user = Usuario_evento::where('user_id', $request->id)->where('evento_id', $request->id_nivel)->first();

        if ($user->asistencia) {
            $user->asistencia = false;
        } else {
            $user->asistencia = true;
        }

        $user->save();

        return $user;
    }

}
