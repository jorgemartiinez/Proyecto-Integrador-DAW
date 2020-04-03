<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Padre;
use App\Miembro;
use App\Monitor;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'nombre', 'apellidos', 'dni', 'fec_nac', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function padre()
    {
        return $this->hasOne(Padre::class, 'id');
    }

    public function miembro()
    {
        return $this->hasOne(Miembro::class, 'id');
    }

    public function monitor()
    {
        return $this->hasOne(Monitor::class, 'id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    public function participa($id)
    {
        return $this->hasMany('App\Usuario_evento', 'user_id')->where('evento_id', $id)->first();
    }

    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('nombre', $role)->first()) {
            return true;
        }
        return false;
    }

    public function getRoleAttribute()
    {
        return $this->roles->first()->name;
    }

    public function avatar()
    {
        if (file_exists('images/avatars/'.$this->id.'.png')) {
            return asset('images/avatars/'.$this->id.'.png');
        } else if (file_exists('images/avatars/'.$this->id.'.jpg')) {
            return asset('images/avatars/'.$this->id.'.jpg');
        } else if (file_exists('images/avatars/'.$this->id.'.jpeg')) {
            return asset('images/avatars/'.$this->id.'.jpeg');
        } else {
            return asset('images/avatars/default.png');
        }
    }
}