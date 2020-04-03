<?php

namespace App\Http\Controllers;

use App\Documento;
use App\Post;
use App\User;
use App\Miembro;
use App\Comision;
use App\Http\Request\StoreContacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MailController;
use App\Tipo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function getIndex()
    {
        $comisiones = [];
        if (Auth::user()->monitor) {
            $comisiones = Auth::user()->monitor->comisiones;
        }
        return view('admin.index', compact('comisiones'));
    }

    public function getPostsNew()
    {
        $post = false;
        $alert = false;
        return view('admin.newPost', compact('post', 'alert'));
    }

    public function getPostsUpdate($id)
    {
        $post = Post::findOrFail($id);
        $alert = false;
        return view('admin.newPost', compact('post', 'alert'));
    }

    public function updatePost(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->id_nivel = $request->nivel;
        $post->contenido = $request->editordata;
        $post->comentarios = ($request->comentarios) ? true : false;
        $post->save();
        return view('admin.newPost');
    }

    public function createPostsNew(Request $request)
    {
        $post = new Post;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->fecha = date('Y/m/d');
        $post->id_user = Auth::user()->id;
        $post->contenido = $request->editordata;
        $post->comentarios = ($request->comentarios) ? true : false;
        $post->save();
        foreach ($request->nivel as $nivel) {
            $post->niveles()->attach($nivel);
            $post->save();
        }
        $post = null;
        $alert = true;
        return view('admin.newPost', compact('post', 'alert'));
    }

    public function uploadImage()
    {
        $temp = explode(".", $_FILES["file"]["name"]);
        $newFileName = round(microtime(true)) . '.' . end($temp);
        $destinationFilePath = 'images/posts/' . $newFileName;
        if (!move_uploaded_file($_FILES['file']['tmp_name'], $destinationFilePath)) {
            echo "Se ha producido un error al subir el archivo";
        } else {
            echo $destinationFilePath;
        }
    }

    public function notFound()
    {
        $comisiones = [];
        if (Auth::user()->monitor) {
            $comisiones = Auth::user()->monitor->comisiones;
        }
        return view('admin.index', compact('comisiones'));
    }

    /*
     * Metodos que utiliza Vue Axios
     * */

    public function getUsuario($id)
    {
        $usuario = User::findOrFail($id);
        return $usuario;
    }

    public function getUsuarios()
    {
        $usuarios = User::all()->where('estado_registro', true);
        return $usuarios;
    }

    public function getUsuariosPeticion()
    {
        $usuarios = User::all()->where('estado_registro', false);
        return $usuarios;
    }

    public function putUser(Request $request)
    {

        $usuario = User::findOrFail($request->id);
        $usuario->estado_registro = $request->estado_registro;

        if ($usuario->estado_registro == 1) {
            $usuario->save();
            \App::call('App\Http\Controllers\MailController@sendAceptada');

        } else {
            $usuario->delete();
            \App::call('App\Http\Controllers\MailController@sendRechazada');
        }

        return $usuario;

    }


    public function sendContacto(StoreContacto $request)
    {
        \App::call('App\Http\Controllers\MailController@sendContacto');
    }

    public function getEventos()
    {

    }

    public function getComisiones()
    {
        $comisiones = Comision::all();
        return $comisiones;
    }

    public function getComision($id)
    {
        $comision = Comision::FindOrFail($id);
        return $comision;
    }



    public function getDocsUser($id)
    {

        $documentos = Documento::where('id_usuario', $id)->get();

        foreach ($documentos as $documento) {
            $documento->tipo;
        }

        return $documentos;
    }


    public function getDoc($nombre)
    {
        $ruta = storage_path('documentos/' . $nombre);
        return response()->file($ruta);
    }


    protected function createHijo(Request $request)
    {
        $request->password = Hash::make(str_random(10));
        $request->username = generarUsername($request->nombre, $request->apellido1, $request->apellido2);
        $user = User::create([
            'username' => $request->username,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellido1 . ' ' . $request->apellido2,
            'dni' => $request->DNI,
            'fec_nac' => $request->fecha_nac,
            'password' => $request->password,
        ]);

        $miembro = Miembro::create([
            'id' => $user->id,
            'curso_escolar' => $request->cursoEscolar,
            'id_padre1' => $request->id_padre,
            //'id_datos_med' => $user->id,
            'id_nivel' => calcularNivelPorDefecto($request->fec_nac),
        ]);


        $ruta = storage_path() . '/documentos/'; //ruta documentos


        //guardamos calendario de vacunas
        $calendarioDeVacunas = $request->file('calendarioDeVacunas');
        $temp_name_calendario = random_string() . '.pdf';
        $calendarioDeVacunas->move($ruta, $temp_name_calendario);

        $calendarioDeVacunas = Documento::create([

            'id_usuario' => $user->id,
            'ruta' => $temp_name_calendario,
            'id_tipo' => 9,
        ]);

        //guardamos fotocopia SIP
        $fotocopiaSIP = $request->file('fotocopiaDelSIP');
        $temp_name_fotocopiaSIP = random_string() . '.pdf';
        $fotocopiaSIP->move($ruta, $temp_name_fotocopiaSIP);

        $fotocopiaSIP = Documento::create([
            'id_usuario' => $user->id,
            'ruta' => $temp_name_fotocopiaSIP,
            'id_tipo' => 8,
        ]);


        //guardamos autorizacion de imagenes
        $autorizacionDeImagenes = $request->file('autorizacionDeImagenes');
        $temp_name_autorizacionDeImagenes = random_string() . '.pdf';
        $autorizacionDeImagenes->move($ruta, $temp_name_autorizacionDeImagenes);

        $autorizacionDeImagenes = Documento::create([
            'id_usuario' => $user->id,
            'ruta' => $temp_name_autorizacionDeImagenes,
            'id_tipo' => 11,
        ]);


        //guardamos funcionamiento interno
        $funcionamientoInterno = $request->file('funcionamientoInterno');
        $temp_name_funcionamientoInterno = random_string() . '.pdf';
        $funcionamientoInterno->move($ruta, $temp_name_funcionamientoInterno);

        $funcionamientoInterno = Documento::create([
            'id_usuario' => $user->id,
            'ruta' => $temp_name_autorizacionDeImagenes,
            'id_tipo' => 12,
        ]);


        return redirect('/espacio-personal');

    }
}