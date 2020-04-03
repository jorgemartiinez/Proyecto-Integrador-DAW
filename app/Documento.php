<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = [
        'id_usuario', 'ruta', 'id_tipo'
    ];



    public function tipo(){
        return $this->belongsTo(Tipo::class, 'id_tipo');
    }

}
