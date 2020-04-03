<?php

namespace App\Http\Controllers;

use App\Comentario;
use App\Http\Request\StoreComentario;
use App\Post;
use App\User;
use App\Usuario_evento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Nivel;
use App\Categoria;
use App\Miembro;

use Illuminate\Http\Request;

class PostsController extends Controller {

    public function getIndex() {

        /* Todos los usuarios pueden ver los post públicos
         *
         * Nivel 1 Todos 
         * Nivel 2 Todos los registrados
         * Nivel 3-9 Solo los pueden ver los que pertenecen a ese nivel
         * Monitor puede ver todos los post
         * Primero se tiene que buscar miembro al que pertenece ese usuario
         * Luego buscar mediante el id el nivel al que pertenece
         * 
         * Auth::user()->miembro->nivel->nombre Esto devuelve el nombre del nivel al que pertenece el usuario      
         */
        $post = Post::postsWithNivel(1, false);

        if (Auth::user() == null) {
            //Noticias de nivel 1
            return view('post.index', compact('post'));
        } else {
            if (Auth::user()->hasRole('Admin')) {
                $post = DB::table('posts')->join('nivel_post', 'posts.id', '=', 'nivel_post.id_post')->get();
            } else {
                //Noticias de nivel 2 + nivel al que pertenece el usuario
                $postNivel2 = Post::postsWithNivel(2, false);
                $post = $post->merge($postNivel2);

                $postNivelUser = null;
                if (Auth::user()->padre) {
                    //Si es un Padre
                    foreach (Auth::user()->padre->hijos() as $hijo) {
                        $post = $post->merge(Post::postsWithNivel($hijo->id_nivel, false));
                    }
                } else if (Auth::user()->miembro) {
                    //Si es un Miembro
                    $post = $post->merge(Post::postsWithNivel(Auth::user()->miembro->id_nivel, false));
                }
            }
            return view('post.index', compact('post'));
        }
    }

    public function show($id) {

        $post = Post::findOrFail($id);
        $comentarios = $post->comentarios()->get();
        $usuario = User::findOrFail($post->id_user);

        return view('post.show', compact('post', 'comentarios', 'usuario'));
    }


    public function sendComentario(StoreComentario $request){
        $request->validate([
            'mensaje' => 'required|max:255'
        ]);


        $comentario = new Comentario();

        $comentario->fill($request->toArray());

        $comentario->save();

        return redirect('/post/show/'.$request->post_id);

    }

    public function getPostsNew(){
        $post = false;
        $alert = false;
        return view('admin.newPost', compact('post', 'alert'));
    }

    public function getPostsUpdate($id){
        $post = Post::findOrFail($id);
        $alert = false;
        return view('admin.newPost', compact('post', 'alert'));
    }

    public function updatePost(Request $request, $id){
        $post = Post::findOrFail($id);
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->contenido = $request->editordata;
        $post->comentarios = ($request->comentarios)? true : false;
        $post->save();

        foreach ($post->niveles as $nivel) {
            $post->niveles()->detach($nivel->id);
        }
        foreach ($post->categorias as $categoria) {
            $post->categorias()->detach($categoria->id);
        }
        foreach ($request->nivel as $nivel) {
            $post->niveles()->attach($nivel);
            $post->save();
        }
        foreach ($request->categoria as $categoria) {
            $post->categorias()->attach($categoria);
            $post->save();
        }
        $alert = true;
        return view('admin.newPost', compact('post', 'alert'));
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
        foreach ($request->categoria as $categoria) {
            $post->categorias()->attach($categoria);
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

    public function getPosts(){
        $posts = Post::all();

        foreach ($posts as $post) {
            $post->niveles;
            $post->categorias;
            $post->usuario;
        }
        return $posts;
    }

    public function getPost($id){
        $post = Post::findOrFail($id);
        return $post;
    }

    public function deletePost($id){
        $post = Post::findOrFail($id);

        foreach ($post->niveles as $nivel) {
            $post->niveles()->detach($nivel->id);
        }

        foreach ($post->categorias as $categoria) {
            $post->categorias()->detach($categoria->id);
        }

        $post->delete();

        return "Post borrado con exito.";
    }

    public function getCategoria($id){

        $id_categoria = DB::table('categoria_post')->where('post_id', $id)->pluck('categoria_id');

        $categoria = Categoria::whereIn('id', $id_categoria)->pluck('nombre');
        
        return implode(', ', $categoria->toArray());
    }

}
