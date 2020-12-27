<?php

namespace App\Models;
use App\Models\Materia;
use App\Models\Aula;
use App\Models\Sesion;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'paso',
        'modo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function materias(){
        return $this->hasMany(Materia::class);
    }

    public function clases(){
        return $this->hasMany(Clase::class);
    }

    public function sesions(){
        return $this->hasMany(Sesion::class);
    }
    
    public function aulas(){
        return $this->hasMany(Aula::class);
    }
}
