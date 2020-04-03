<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Usuario_evento extends Model
{
    protected $table = "usuario_evento";

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}