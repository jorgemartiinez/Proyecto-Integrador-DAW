<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    protected $table = "monitores";

    protected $fillable = [
        'id', 'rango_monitor', 'domicilio', 'email', 'telefono', 'id_cargo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function comisiones()
    {
        return $this->belongsToMany('App\Comision', 'monitor_comision', 'id_monitor', 'id_comision')->withTimestamps();
    }
}
