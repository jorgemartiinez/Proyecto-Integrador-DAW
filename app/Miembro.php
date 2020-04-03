<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Padre;
use App\Usuario_evento;
use App\Nivel;

class Miembro extends Model
{
    protected $fillable = [
        'id', 'curso_escolar', 'id_padre1', 'id_padre2', 'id_datos_med', 'id_nivel',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function padre1()
    {
        return $this->belongsTo(User::class, 'id_padre1');
    }

    public function padre2()
    {
        return $this->belongsTo(User::class, 'id_padre2');
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'id_nivel');
    }

    public function apuntarAEvento($idEvento)
    {
        $user_evento = new Usuario_evento;
        $user_evento->user_id = $this->id;
        $user_evento->evento_id = $idEvento;
        $user_evento->save();
    }
}
