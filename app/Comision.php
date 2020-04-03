<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comision extends Model
{
	protected $table = 'comisiones';

    protected $fillable = [
        'nombre',
    ];

    public function monitores()
    {
        return $this->belongsToMany('App\Monitor', 'monitor_comision', 'id_comision', 'id_monitor')->withTimestamps();
    }

    public function tareas()
    {
        return $this->hasMany('App\Tarea');
    }
}
