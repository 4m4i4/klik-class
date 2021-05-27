<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'apellidos',
        'nombre_completo',
        'check',
        'user_id'
    ];

    /**
     * Relaciones entre modelos
     */
    // One to many (inverse)
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    // Many to many
    public function materias(){
        return $this->belongsToMany('App\Models\Materia')->withTimestamps();
    }
    // Has many through
    public function clases(){
        return $this->hasManyThrough('App\Models\Clase','App\Models\Materia');
    }
    // One to One
    public function mesa(){
        return $this->hasOne('App\Models\Mesa');
    }
}