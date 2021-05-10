<?php

namespace App\Models;
// use App\Models\Materia;
// use App\Models\Aula;
// use App\Models\Sesion;

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

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'modo' => 'novel',
        'paso' => '0'
    ];

    /**
     * Relaciones entre modelos
     */

    // One to many
    public function materias(){
        return $this->hasMany('App\Models\Materia');
    }
    // One to many
    public function clases(){
        return $this->hasMany('App\Models\Clase');
    }
    // One to many
    public function sesions(){
        return $this->hasMany('App\Models\Sesion');
    }
    // One to many
    public function aulas(){
        return $this->hasMany('App\Models\Aula');
    }
}