<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comentario;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $fillable = [
        'titulo', 'fecha', 'id_user', 'thumbnail', 'contenido', 'comentarios'
    ];

    public function niveles(){
        return $this->belongsToMany('App\Nivel', 'nivel_post', 'id_post', 'id_nivel')->withTimestamps();
    }

    public function nivelesID(){
        $id = [];
        $niveles = $this->belongsToMany('App\Nivel', 'nivel_post', 'id_post', 'id_nivel')->withTimestamps()->get();
        foreach ($niveles as $nivel) {
            $id[] = $nivel->id;
        }
        return $id;
    }

    public function categorias()
    {
        return $this->belongsToMany('App\Categoria')->withTimestamps();
    }

    public function categoriasID(){
        $id = [];
        $categorias = $this->belongsToMany('App\Categoria')->withTimestamps()->get();
        foreach ($categorias as $categoria) {
            $id[] = $categoria->id;
        }
        return $id;
    }

    public function comentarios()
    {
        return $this->hasMany('App\Comentario');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public static function postsWithNivel($nivel, $paginate, $perPages = 2)
    {
        if ($paginate) {
            return DB::table('posts')->join('nivel_post', 'posts.id', '=', 'nivel_post.id_post')->where('nivel_post.id_nivel', '=', $nivel)->paginate($perPages);
        } else {
            return DB::table('posts')->join('nivel_post', 'posts.id', '=', 'nivel_post.id_post')->where('nivel_post.id_nivel', '=', $nivel)->get();
        }
    }
}