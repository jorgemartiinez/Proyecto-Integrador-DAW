<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Padre extends Model
{
    protected $fillable = [
        'id', 'domicilio', 'email', 'telefono',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function pareja()
    {
        $hijo = Miembro::where('id_padre1', $this->id)->first();
        if (!$hijo) {
            $hijo = Miembro::where('id_padre2', $this->id)->first();
        }
        if ($hijo) {
            if ($hijo->id_padre1 == $this->id) {
                return Padre::findOrFail($hijo->id_padre2);
            } else {
                return Padre::findOrFail($hijo->id_padre1);
            }
        }
        return null;
    }

    public function hijos()
    {
        return Miembro::where('id_padre1', $this->id)->orWhere('id_padre2', $this->id)->get();
    }
}