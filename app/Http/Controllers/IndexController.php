<?php

/**
 * Created by PhpStorm.
 * User: vesprada
 * Date: 1/02/19
 * Time: 18:44
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use App\Comentario;

class IndexController extends Controller {

    public function getIndex() {
        $banner = DB::table('posts')->join('categoria_post', 'posts.id', '=', 'categoria_post.post_id')->where('categoria_post.categoria_id', '=', '1')->first();

        $numComentarios = count(Comentario::where('post_id', $banner->post_id)->get()); //obtener número de comentarios banner
        $noticias = Post::postsWithNivel('1', true, 2);

        return view('general.index', compact('banner', 'numComentarios', 'noticias'));
    }

    /* Función que devuelve la vista sobre nosotros */

    public function sobreNosotros() {

        return view('general.sobreNosotros');
    }

    public function getEspacioPersonal() {
        $error = false;
        $datos = [];

        
        if (Auth::user()->miembro != null) {

            //Esta sentencia consigue los id de los eventos a los cuales pertenece el usuario
            $id_eventos = DB::table('usuario_evento')->where('user_id', Auth::user()->miembro->nivel->id)->pluck('evento_id');
            //Saco los eventos de esos id
            $eventos = DB::table('eventos')->whereIn('id', $id_eventos->toArray())->get();
            //Hago una copia de eventos a datos para enviarlos a la vista
            $datos = $eventos;
                
        } else {
            /* Bien, vamos paso por paso
             * Primero lo que hago es conseguir los id de los hijos que tiene el padre
             * Segundo hago un foreach con esos id
             * Tercero busco a que usuario pertenece ese id y lo convierto en array para mas adelante juntarle los eventos
             * Cuarto busco los id de los eventos de los a los que pertenece el id del usuario
             * Quinto de esos id de eventos saco una coleccion de eventos que inserto en ninos con un array push
             * Sexto en nino tenemos el usuario al que pertenece y los eventos en los que está inscrito así que lo inserto dentro del array de datos
             */
            
            //Esto me da los id de usuario de los hijos que tenga ese padre
            $id_ninos = Auth::user()->padre->hijos()->pluck('id');
            
            foreach ($id_ninos->toArray() as $id) {

                $ninos = DB::table('users')->where('id', $id)->get()->toArray();
                $id_eventos = DB::table('usuario_evento')->where('user_id', $id)->pluck('evento_id');
                $eventos = DB::table('eventos')->whereIn('id', $id_eventos->toArray())->get();
                
                array_push($ninos, $eventos);
                array_push($datos, $ninos);
            }
        }

        $comisiones = [];
        if (Auth::user()->monitor) {
            $comisiones = Auth::user()->monitor->comisiones;
        }
       
        return view('general.espacioPersonal', compact('error', 'datos', 'comisiones'));
    }

    public function getRegistroHijo() {
        return view('auth.registerChild');
    }

    public function getContacto() {
        return view('general.contacto');
    }


    public function changeAvatar()
    {
        if (file_exists('images/avatars/'.Auth::id().'.png')) {
            unlink('images/avatars/'.Auth::id().'.png');
        } else if (file_exists('images/avatars/'.Auth::id().'.jpg')) {
            unlink('images/avatars/'.Auth::id().'.jpg');
        } else if (file_exists('images/avatars/'.Auth::id().'.jpeg')) {
            unlink('images/avatars/'.Auth::id().'.jpeg');
        }
        $temp = explode(".", $_FILES["avatar"]["name"]);
        $newFileName = Auth::id() . '.' . end($temp);
        $destinationFilePath = 'images/avatars/' . $newFileName;
        if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $destinationFilePath)) {
            $error = true;
            return view('general.espacioPersonal', compact('error'));
        }
        return redirect('/espacio-personal');
    }

}
