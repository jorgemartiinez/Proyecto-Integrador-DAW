<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitor_Comision extends Model
{
    protected $table='monitor_comision';

    public function monitor(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
