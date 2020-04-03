<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    public function niveles(){
        
        return $this->belongsToMany('App\Nivel', 'nivel_evento', 'id_evento', 'id_nivel')->withTimestamps();
    }
}
